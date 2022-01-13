<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class WithdrawalRequestsController
 *
 * @package App\Http\Controllers
 */
class WithdrawalRequestsController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        if (request()->ajax()) {
            $transactionWithdrawType = TransactionType::getByName('withdraw');

            $transactions = Transaction::select('transactions.*')->with([
                'user',
            ])->where('withdraw_waiting', false)
                ->where('type_id', $transactionWithdrawType->id)
                ->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            /*
             * Фильтрация, если выбрано
             */
            if (!is_null($request->field) && !is_null($request->sort)) {
                $transactions = $transactions->with('paymentSystem')->orderBy($request->field, $request->sort);
            }

            /*
             * Получаем всех рефералов и их транзакции
             */
            if (!is_null($request->user)) {
                /** @var User $user */
                $user = User::where('id', $request->user)->first();
                $transactions->where('teamleader', $user->id);
            }

            if (!is_null($request->fake)) {
                $transactions->where('is_real', 0);
            } elseif (!is_null($request->real)) {
                $transactions->where('is_real', 1);
            } else {
                $transactions->where('approved', $request->only('type') ?? 0);
            }

            if (($request->has('fake') || $request->has('real')) && $request->has('type')) {
                $transactions->where('approved', $request->only('type') ?? 0);
            }

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $transactions->where(function ($query) use ($request) {
                    $query->where('id', $request->search['value'])
                        ->orWhereHas('user', function($q) use($request) {
                            $q->where('login', 'like', '%'.$request->search['value'].'%')
                                ->orWhere('email', 'like', '%'.$request->search['value'].'%');
                        });
                });
            }

            $recordsFiltered = $transactions->count();
            $transactions->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($transactions->get() as $transaction) {
                $data[] = [
                    'empty' => '',
                    'empty2' => '',
                    'id' => $transaction->id,
                    'request_id' => view('pages.withdrawals.partials.request-id', compact('transaction'))->render(),
                    'email' => view('pages.withdrawals.partials.user-item', compact('transaction'))->render(),
//                    'login' => view('pages.withdrawals.partials.login', compact('transaction'))->render(),
                    'teamlead' => view('pages.withdrawals.partials.teamlead', compact('transaction'))->render(),
                    'partner' => view('pages.withdrawals.partials.upliner', compact('transaction'))->render(),
                    'amount' => view('pages.withdrawals.partials.amount', compact('transaction'))->render(),
                    'created_at' => $transaction->created_at->format('d-m-Y H:i'),
                    'approved' => view('pages.withdrawals.partials.external', compact('transaction'))->render(),
                    'actions' => view('pages.withdrawals.partials.actions', compact('transaction'))->render(),
                    'empty3' => '',
                    'color' => $transaction->user->getRoleColor() ?? '',
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
                $q->where("name", "Фаундер")->orWhere("name", "Тимлидер");
            })->orderBy('int_id', 'asc')->get();
            UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop','withdrawals_amount')->update(['sb_val' => 0]);
            return view('pages.withdrawals.index', compact('filter_users'));
        }
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($transaction) {
        $transaction = Transaction::find($transaction);

        return view('pages.withdrawals.show', compact('transaction'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveMany(Request $request) {
        $messages = [];

        foreach ($request->list as $item) {
            /** @var Transaction $item */
            $transaction = Transaction::find($item);

            $transaction->withdraw_waiting = true;
            $transaction->withdraw_action = $request->type;
            $transaction->save();

            $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$request->type.' - УСПЕХ!';
        }

        return back()->with('info', __('Список обработанных запросов на вывод.') .'<hr>'. implode('<hr>', $messages))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return array|\Illuminate\Http\RedirectResponse|null|string
     * @throws \Exception
     */
    public function reject($transaction, $massMode = false) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->update([
            'withdraw_action' => 'reject',
            'withdraw_waiting' => true,
        ]);

        return back()->with('success', $transaction->amount . ' - ' . __('По заявке сделан отказ!'))->withInput(\request()->all());
    }

    /**
     * @param       $transaction
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Http\RedirectResponse|string|null
     */
    public function remove($transaction) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);
        $transaction->delete();

        return back()->with('success', __('Вывод удален'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public static function approve($transaction) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->update([
            'withdraw_action' => 'approve',
            'withdraw_waiting' => true,
        ]);

        return back()->with('success', $transaction->amount . ' - ' . __('Заявка будет автоматически оплачена!'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveManually($transaction) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->update([
            'withdraw_action' => 'approveManually',
            'withdraw_waiting' => true,
        ]);

        return back()->with('success', $transaction->amount . ' - ' . __('Заявка обработана вручную.'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveFake($transaction) {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->update([
            'withdraw_action' => 'approveFake',
            'withdraw_waiting' => true,
        ]);

        return back()->with('success', $transaction->amount . ' - ' . __('Фейковый вывод одобрен.'))->withInput(\request()->all());
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($transaction) {
        $transaction = Transaction::findOrFail($transaction);

        if ($transaction->delete()) {
            return redirect()->to(route('withdrawals.index'));
        }

        return back()->with('error', __('ERROR:') . ' Вывод не был удален')->withInput(\request()->all());
    }
}
