<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestDashboardBonusUser;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        /** @var PaymentSystem $payment_systems */
        $payment_systems = PaymentSystem::all();

        /** @var Currency $currencies */
        $currencies = Currency::all();

        return view('pages.bonus.index', [
            'payment_systems' => $payment_systems,
            'currencies' => $currencies,
        ]);
    }

    /**
     * @param RequestDashboardBonusUser $request
     */
    public function addUserBonus(RequestDashboardBonusUser $request) {
        /** @var Currency $currency */
        $currency = Currency::findOrFail($request->currency);

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = PaymentSystem::findOrFail($request->payment_system);

        /** @var User $user */
        $user = User::where(function ($q) use ($request) {
            $q->where('email', $request->login)->orWhere('login', $request->login);
        })->first();

        if (null === $user) {
            return back()->with('error_short', 'Пользователь не найден')->withInput();
        }

        $type = $request->type;

        $currencyPaymentSystem = $currency->paymentSystems()->where('payment_system_id', $paymentSystem->id)->first();

        if (null === $currencyPaymentSystem) {
            return back()->with('error_short', 'Эта платежная система не поддерживает валюту ' . $currency->code)->withInput();
        }

        /** @var TransactionType $transactionType */
        $transactionType = TransactionType::where('name', $type)->firstOrFail();

        /** @var Wallet $wallet */
        $wallet = $user->wallets()->where('currency_id', $currency->id)->first();

        if (null === $wallet) {
            $wallet = $user->wallets()->create([
                'currency_id' => $currency->id,
            ]);
        }

        $amount = abs((float) str_replace(',', '.', $request->amount));

        if ($amount <= 0) {
            return back()->with('error_short', 'Сумма должна быть больше нуля')->withInput();
        }

        $data = [
            'type_id' => $transactionType->id,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'rate_id' => null,
            'deposit_id' => null,
            'wallet_id' => $wallet->id,
            'payment_system_id' => $paymentSystem->id,
            'amount' => $amount,
            'source' => auth()->user()->email,
            'result' => null,
            'batch_id' => null,
            'approved' => 1,
            'is_real' => $request->is_real == 1,
        ];

        $transactionTypeString = '';

        DB::transaction(function () use ($data, $wallet, $type, $amount) {
            $transaction = Transaction::create($data);

            switch ($type) {
                case "enter":
                    $wallet->balance += $transaction->amount;
                    break;

                case "withdraw":
                    $wallet->balance -= $transaction->amount;
                    break;
            }

            $wallet->save();
        });

        switch ($type) {
            case "enter":
                $transactionTypeString = 'бонус';
                break;

            case "withdraw":
                $transactionTypeString = 'вывод';
                break;
        }

        return back()->with('success_short', 'Пользователю ' . $user->login . ' добавлен ' . $transactionTypeString . ' на сумму ' . $currency->symbol . $amount . ' через платежную систему ' . $currencyPaymentSystem->name . '. Тип операции: ' . ($request->is_real == 1 ? 'Реальный' : 'Фейковый'));
    }
}
