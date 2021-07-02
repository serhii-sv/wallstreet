<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Payment;

use App\Console\Commands\Automatic\ScriptCheckerCommand;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Modules\PaymentSystems\EnpayModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class EnpayController
 * @package App\Http\Controllers\Payment
 */
class EnpayController extends Controller
{
    /**
     * EnpayController constructor.
     */
    function __construct()
    {
        if (false === checkLicence())
        {
            die('licence error');
        }

        if (ScriptCheckerCommand::checkClassExists() != 'looks ok') {
            die('code corrupted');
        }

        if (LoginController::checkClassExists() != 'auth looks ok') {
            die('code corrupted');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function topUp()
    {
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = session('topup.payment_system');

        /** @var Currency $currency */
        $currency = session('topup.currency');

        if (empty($paymentSystem) || empty($currency)) {
            return redirect()->route('profile.topup')->with('error', __('Can not process your request, try again.'));
        }

        $amount = abs(session('topup.amount'));
        $user          = Auth::user();
        $wallet        = $user->wallets()->where([
            ['currency_id', $currency->id],
            ['payment_system_id', $paymentSystem->id],
        ])->first();

        if (empty($wallet)) {
            $wallet = Wallet::newWallet($user, $currency, $paymentSystem);
        }

        $transaction = Transaction::enter($wallet, $amount);
        $comment     = config('money.enpay_memo');
        $merchantId  = config('money.enpay_merchant_id');

        return view('ps.enpay', [
            'currency'      => $currency,
            'user'          => $user,
            'wallet'        => $wallet,
            'transaction'   => $transaction,
            'paymentSystem' => $paymentSystem,
            'comment'       => $comment,
            'merchantId'    => $merchantId,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Exception
     *
     * TODO: check in production mode, didn't checked before.
     */
    public function status(Request $request)
    {
        if (!isset($request->amount)
            || !isset($request->description)
            || !isset($request->datetime)
            || !isset($request->payment_id)
            || !isset($request->merchant)
            || !isset($request->order_id)
            || !isset($request->sign)) {
            \Log::info('Enpay. Strange request from: '.$request->ip().'. Entire request is: '.print_r($request->all(),true));
            return redirect(route('profile.topup.payment_message', ['result' => 'error']), 400);
        }

        $secretkey = config('money.enpay_secret_word');
        $hash      = md5($secretkey.':'.$request->amount.':'.$request->payment_id.':'.$request->order_id.':'.$request->merchant);

        if ($hash != $request->sign) {
            \Log::info('Enpay. Strange request from: '.$request->ip().'. Entire request is: '.print_r($request->all(),true));
            return redirect(route('profile.topup.payment_message', ['result' => 'error']), 400);
        }

        $paymentSystem = PaymentSystem::where('code', 'enpay')->first();
        $transaction   = Transaction::where('id', $request->order_id)
            ->where('payment_system_id', $paymentSystem->id)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->first();

        if (null == $transaction) {
            \Log::info('Enpay. Transaction not found. Entire request is: '.print_r($request->all(),true));
            return redirect(route('profile.topup.payment_message', ['result' => 'error']), 400);
        }

        if ($transaction->result == 'complete') {
            \Log::info('Enpay. Transaction already completed. Entire request is: '.print_r($request->all(),true));
            return redirect(route('profile.topup.payment_message', ['result' => 'error']), 400);
        }

        $transaction->batch_id = $request->payment_id;
        $transaction->result   = 'complete';
        $transaction->save();

        $commission = $transaction->amount * 0.01 * $transaction->commission;
        $transaction->wallet->refill(($transaction->amount - $commission), $transaction->source);
        $transaction->update(['approved' => true]);
        EnpayModule::getBalances(); // обновляем баланс нашего внешнего кошелька в БД
        return redirect(route('profile.topup.payment_message', ['result' => 'success']), 200);
    }
}
