<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

/**
 * Class WithdrawalRequestsController
 * @package App\Http\Controllers
 */
class WithdrawalRequestsController extends Controller
{

    public function index(Request $request)
    {
        if (request()->ajax()) {
            $transactionWithdrawType = TransactionType::getByName('withdraw');

            $transactions = Transaction::select('transactions.*')->with([
                'user',
            ])
                ->where('type_id', $transactionWithdrawType->id)
                ->where('approved', $request->only('type') ?? 0);

            if (!is_null($request->field) && !is_null($request->sort)) {
                $transactions = $transactions->orderBy($request->field, $request->sort);
            }

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $transactions->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            if ($column['data'] == 'email'){
                                $query->where('user.' . $column["data"], 'like', '%' . $request->search['value'] . '%');
                            } else {
                                $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                            }
                        }
                    }
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
                    'email' => $transaction->user->email,
                    'amount' => view('pages.withdrawals.partials.amount', compact('transaction'))->render(),
                    'created_at' => $transaction->created_at->format('d-m-Y H:i'),
                    'appliner' => $transaction->user->partner->email ?? 'Без аплайнера',
                    'approved' => view('pages.withdrawals.partials.transaction-status', compact('transaction'))->render(),
                    'actions' => view('pages.withdrawals.partials.actions', compact('transaction'))->render(),
                    'empty3' => ''
//                    'broker_main_contact' => '',
//                    'broker_email' => $broker->email,
//                    'broker_phone' => $broker->phone_number,
//                    'employer_count' => 0,
//                    'ach' => '<input type="checkbox" class="checkbox-blue margin-auto">',
//                    'action' => view('admin.brokers.action-list', ['broker' => $broker])->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Transaction::select('transactions.*')->where('type_id', $transactionWithdrawType->id)->where('approved', $request->only('type') ?? 0)->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.withdrawals.index');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataTable()
    {
//        /** @var TransactionType $transactionWithdrawType */
//        $transactionWithdrawType    = TransactionType::getByName('withdraw');
//        $wrs                        = Transaction::select('transactions.*')->with([
//            'currency',
//            'paymentSystem',
//            'wallet',
//            'user',
//        ])
//            ->where('approved', 0)
//            ->where('type_id', $transactionWithdrawType->id);
//
//        return Datatables::of($wrs)->editColumn('status', function ($wr) {
//            return $wr->approved == 1 ? __('approved') : __('new');
//        })->editColumn('amount', function (Transaction $wr) {
//            return number_format($wr->amount, $wr->wallet->currency->precision, '.', '');
//        })->addColumn('external', function (Transaction $wr) {
//            return $wr->wallet->external;
//        })->make(true);
    }

    /**
     * @param $transaction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($transaction)
    {
        $transaction = Transaction::find($transaction);

        return view('pages.withdrawals.show', compact('transaction'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveMany(Request $request)
    {
        $messages = [];

        if ($request->type == 'approve') {
            foreach ($request->list as $item) {
                $messages[] = $this->approve($item, true);
            }
        } elseif ($request->type == 'approveManually') {
            foreach ($request->list as $item) {
                $messages[] = $this->approveManually($item, true);
            }
        } elseif ($request->type == 'reject') {
            foreach ($request->list as $item) {
                $messages[] = $this->reject($item, true);
            }
        }

        return back()->with('success_short', __('List of withdrawal requests processed.').implode(', ', $messages));
    }

    /**
     * @param $transaction
     * @param bool $massMode
     * @return array|\Illuminate\Http\RedirectResponse|null|string
     * @throws \Exception
     */
    public function reject($transaction, $massMode=false)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error_short', __('This request already processed.'));
        }

        /** @var Wallet $wallet */
        $wallet         = $transaction->wallet()->first();
        /** @var User $user */
        $user           = $wallet->user()->first();
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem  = $wallet->paymentSystem()->first();
        /** @var Currency $currency */
        $currency       = $wallet->currency()->first();
        $amount         = $transaction->amount;

        if (null === $wallet || null === $user || null === $paymentSystem || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal reject.');
        }

        $wallet->returnFromRejectedWithdrawal($transaction);
        $transaction->update(['approved' => Transaction::TRANSACTION_REJECTED]);

        $data = [
            'withdraw_amount' => $amount,
            'currency'        => $currency,
            'payment_system'  => $paymentSystem
        ];
//        $user->sendNotification('rejected_withdrawal', $data);

        if (true === $massMode) {
            return __('Request rejected');
        }
        return back()->with('success_short', __('Request rejected'));
    }

    /**
     * @param $transaction
     * @param bool $massMode
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public static function approve($transaction, $massMode=false)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error_short', __('This request already processed.'));
        }

        /** @var Wallet $wallet */
        $wallet         = $transaction->wallet()->first();
        /** @var User $user */
        $user           = $wallet->user()->first();
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem  = $wallet->paymentSystem()->first();
        /** @var Currency $currency */
        $currency       = $wallet->currency()->first();

        if (null === $wallet || null === $user || null === $paymentSystem || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

        $ps = $paymentSystem->getClassName();

        if (empty($wallet->external)) {
            if (true === $massMode) {
                return __('ERROR:').' wallet is empty';
            }
            return back()->with('error_short', __('ERROR:').' wallet is empty');
        }

        try {
            $batchId = $ps::transfer($transaction);
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:').' ' . $e->getMessage();
            }
            return back()->with('error_short', __('ERROR:').' ' . $e->getMessage());
        }

        if (empty($batchId)) {
            $batchErr = __('Unable to approve request, payment system transfer is failed ..');

            if (true === $massMode) {
                return __($batchErr);
            }
            return back()->with('error_short', __($batchErr));
        }

        $transaction->update([
            'batch_id' => $batchId,
            'approved' => true,
        ]);

        $data = [
            'withdraw_amount' => $transaction->amount,
            'currency'        => $currency,
            'payment_system'  => $paymentSystem
        ];
//        $user->sendNotification('approved_withdrawal', $data);

        try {
            $ps::getBalances();
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:').' ' . $e->getMessage();
            }
            return back()->with('error_short', __('ERROR:').' ' . $e->getMessage());
        }

        if (true === $massMode) {
            return $transaction->amount.$currency->symbol.' - '.__('Request approved, money transferred to user wallet');
        }
        return back()->with('success_short', $transaction->amount.$currency->symbol.' - '.__('Request approved, money transferred to user wallet'));
    }

    /**
     * @param $transaction
     * @param bool $massMode
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveManually($transaction, $massMode=false)
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error_short', __('This request already processed.'));
        }

        /** @var Wallet $wallet */
        $wallet         = $transaction->wallet()->first();
        /** @var User $user */
        $user           = $wallet->user()->first();
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem  = $wallet->paymentSystem()->first();
        /** @var Currency $currency */
        $currency       = $wallet->currency()->first();

        if (null === $wallet || null === $user || null === $paymentSystem || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

        if (empty($wallet->external)) {
            if (true === $massMode) {
                return __('ERROR:').' wallet is empty';
            }
            return back()->with('error_short', __('ERROR:').' wallet is empty');
        }

        $transaction->update([
            'approved' => true
        ]);

        $data = [
            'withdraw_amount'   => $transaction->amount,
            'currency'          => $currency,
            'payment_system'    => $paymentSystem
        ];
//        $user->sendNotification('approved_withdrawal', $data);

        $ps = $paymentSystem->getClassName();

        try {
            $ps::getBalances();
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:').' ' . $e->getMessage();
            }
            return back()->with('error_short', __('ERROR:').' ' . $e->getMessage());
        }

        if (true === $massMode) {
            return $transaction->amount.$currency->symbol.' - '.__('Request approved.');
        }
        return back()->with('success_short', $transaction->amount.$currency->symbol.' - '.__('Request approved.'));
    }

    /**
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->delete()) {
            return redirect()->to(route('withdrawals.index'));
        }
        return back()->with('error_short', __('ERROR:').' Вывод не был удален');
    }
}
