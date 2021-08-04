<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ReplenishmentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $transactionWithdrawType = TransactionType::getByName('withdraw');

        $transactions = Transaction::select('transactions.*')->with([
            'user',
        ])
            ->where('type_id', $transactionWithdrawType->id)
            ->where('approved', $request->only('type') ?? 0);

        $transactions = $transactions->get();

        return view('pages.replenishments.index', compact('transactions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveMany(Request $request)
    {
        $messages = [];
        if ($request->type == 'approveManually') {
            foreach ($request->list as $item) {
                $messages[] = $this->approveManually($item, true);
            }
        }

        return back()->with('success', __('List of withdrawal requests processed.').implode(', ', $messages));
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
            return back()->with('error', __('This request already processed.'));
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
            return back()->with('error', __('ERROR:').' wallet is empty');
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
            return back()->with('error', __('ERROR:').' ' . $e->getMessage());
        }

        if (true === $massMode) {
            return $transaction->amount.$currency->symbol.' - '.__('Request approved.');
        }
        return back()->with('success', $transaction->amount.$currency->symbol.' - '.__('Request approved.'));
    }
}