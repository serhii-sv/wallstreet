<?php

namespace App\Observers;

use App\Jobs\SendTelegramMessage;
use App\Models\TelegramChat;
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
     * @param $transaction
     */
    public function updated($transaction)
    {
        $transactionTypes = TransactionType::where('name', 'withdraw')
            ->orWhere('name', 'enter')
            ->pluck('id', 'name')
            ->toArray();

        if (in_array($transaction->type_id, $transactionTypes)) {
            dispatch(new SendTelegramMessage($transaction, $transactionTypes, auth()->user()));
        }
    }
}
