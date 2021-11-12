<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ReplenishmentController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        if (request()->ajax()) {
            $transactionWithdrawType = TransactionType::getByName('enter');

            $transactions = Transaction::select('transactions.*')->with([
                'user',
            ])->where('type_id', $transactionWithdrawType->id);

            if ($request->has('type')) {
                $transactions->where('approved', $request->type);
            }

            //->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir'])
            /*
            * Фильтрация, если выбрано
            */
            if (!is_null($request->field) && !is_null($request->sort)) {
                $transactions = $transactions->orderBy($request->field, $request->sort);
            }
            /*
            * Получаем всех рефералов и их транзакции
            */
            if (!is_null($request->user)) {
                $user = User::where('id', $request->user)->first();
                $referrals = $user->referrals()->distinct('id')->pluck('id')->toArray();
                $transactions->whereIn('user_id', $referrals);
            }

            if (!is_null($request->fake)) {
                $transactions->where('is_real', 0)->where('approved', 1);
            }

            if (!is_null($request->real)) {
                $transactions->where('is_real', 1)->where('approved', 1);
            }

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $transactions->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $transactions->count();
            $transactions->limit($request->length)->offset($request->start)->orderBy('created_at','desc');
            $data = [];

            foreach ($transactions->get() as $transaction) {
                $data[] = [
                    'empty' => '',
                    'empty2' => '',
                    'id' => $transaction->id,
                    'email' => view('pages.replenishments.partials.user-item', compact('transaction'))->render(),
                    'login' => view('pages.withdrawals.partials.login', compact('transaction'))->render(),
                    'partner' => view('pages.withdrawals.partials.upliner', compact('transaction'))->render(),
                    'amount' => view('pages.withdrawals.partials.amount', compact('transaction'))->render(),
                    'created_at' => $transaction->created_at->format('d-m-Y H:i'),
                    'approved' => view('pages.replenishments.partials.transaction-status', compact('transaction'))->render(),
                    'actions' => view('pages.replenishments.partials.actions', compact('transaction'))->render(),
                    'empty3' => '',
                    'color' => $transaction->user->roles->first()->color ?? '',
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Transaction::select('transactions.*')->where('type_id', $transactionWithdrawType->id)->where('approved', $request->only('type') ?? 0)->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        } else {
            $filter_users = User::whereHas("roles", function ($q) {
                $q->where("name", "root")->orWhere("name", "teamlead");
            })->orderBy('int_id', 'asc')->get();
            UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop','replenishments_amount')->update(['sb_val' => 0]);
            return view('pages.replenishments.index', compact('filter_users'));
        }
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($transaction) {
        $transaction = Transaction::find($transaction);

        return view('pages.replenishments.show', compact('transaction'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveMany(Request $request) {
        $messages = [];
        if ($request->type == 'approveManually') {
            foreach ($request->list as $item) {
                $messages[] = $this->approveManually($item, true);
            }
        }

        return back()->with('info', __('List of withdrawal requests processed.') . implode(', ', $messages));
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveManually($transaction, $massMode = false) {

        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error', __('This request already processed.'));
        }

        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();
        /** @var User $user */
        $user = $wallet->user()->first();
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = $wallet->paymentSystem()->first();
        /** @var Currency $currency */
        $currency = $wallet->currency()->first();

        if (null === $wallet || null === $user || null === $paymentSystem || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

        if (empty($wallet->external)) {
            if (true === $massMode) {
                return __('ERROR:') . ' wallet is empty';
            }
            return back()->with('error', __('ERROR:') . ' wallet is empty');
        }

        $transaction->update([
            'approved' => true,
        ]);

        $data = [
            'withdraw_amount' => $transaction->amount,
            'currency' => $currency,
            'payment_system' => $paymentSystem,
        ];
        //        $user->sendNotification('approved_withdrawal', $data);

        $ps = $paymentSystem->getClassName();

        try {
            $ps::getBalances();
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:') . ' ' . $e->getMessage();
            }
            return back()->with('error', __('ERROR:') . ' ' . $e->getMessage());
        }

        if (true === $massMode) {
            return $transaction->amount . $currency->symbol . ' - ' . __('Request approved.');
        }
        return back()->with('success', $transaction->amount . $currency->symbol . ' - ' . __('Request approved.'));
    }

    /**
     * @param       $transaction
     * @param false $massMode
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Http\RedirectResponse|string|null
     */
    public function remove($transaction, $massMode = false) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->delete();

        if (true === $massMode) {
            return __('Пополнение удалено');
        }
        return back()->with('success', __('Попоплнение удалено'));
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($transaction) {
        $transaction = Transaction::find($transaction);
        if ($transaction->delete()) {
            return redirect()->to(route('replenishments.index'));
        }
        return back()->with('error', __('ERROR:') . ' Пополнение не было удалено');
    }
}
