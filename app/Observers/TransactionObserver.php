<?php

namespace App\Observers;

use App\Jobs\SendTelegramMessage;
use App\Models\Currency;
use App\Models\TelegramChat;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Notifications\NewReplenishmentRequest;
use App\Notifications\NewWithdrawalRequest;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramUpdates;

class TransactionObserver
{
    /**
     * @param $transaction
     */
    public function created($transaction)
    {
        $transactionTypes = TransactionType::where('name', 'withdraw')
            ->orWhere('name', 'enter')
            ->pluck('id', 'name')
            ->toArray();

        if (in_array($transaction->type_id, $transactionTypes)) {
            dispatch(new SendTelegramMessage($transaction, $transactionTypes));
        }
    }

    /**
     * @param Transaction $transaction
     */
    public function creating(Transaction $transaction)
    {
        $amount     = $transaction->amount;
        $currency   = $transaction->currency;

        /** @var Currency $mainCurrency */
        $mainCurrency = Currency::where('code', 'USD')->first();

        if (null !== $currency && null !== $mainCurrency && $amount > 0) {
            if ($currency->code == $mainCurrency->code) {
                $transaction->main_currency_amount = $amount;
            } else {
                $transaction->main_currency_amount = $transaction->convertToCurrency($currency, $mainCurrency, $amount);
            }
        }else{
            $transaction->main_currency_amount = $amount;
        }
    }
}
