<?php

namespace App\Jobs;

use App\Enums\Permissions;
use App\Models\TelegramChat;
use App\Models\Transaction;
use App\Notifications\NewReplenishmentRequest;
use App\Notifications\NewWithdrawalRequest;
use App\Notifications\TransactionAccepted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendTelegramMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * @var
     */
    private $transactionTypes;

    /**
     * @var
     */
    private $approver;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, $transactionTypes = [], $approver = null)
    {
        $this->transaction = $transaction;
        $this->transactionTypes = $transactionTypes;
        $this->approver = $approver;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (TelegramChat::where('active', true)->get() as $telegram_chat) {
            try {
                if ($this->transaction->type_id == $this->transactionTypes['withdraw']
                    && $telegram_chat->user->hasPermissionTo(Permissions::$data[Permissions::WITHDRAWALS_INDEX])) {
                    if ($this->transaction->approved) {
                        Notification::route('telegram', $telegram_chat->chat_id)
                            ->notify(new TransactionAccepted($this->transaction, 'withdrawals', $this->approver));
                    } else {
                        Notification::route('telegram', $telegram_chat->chat_id)
                            ->notify(new NewWithdrawalRequest($this->transaction));
                    }
                } elseif ($this->transaction->type_id == $this->transactionTypes['enter']
                    && $telegram_chat->user->hasPermissionTo(Permissions::$data[Permissions::REPLENISHMENTS_INDEX])) {
                    if ($this->transaction->approved) {
                        Notification::route('telegram', $telegram_chat->chat_id)
                            ->notify(new TransactionAccepted($this->transaction, 'replenishments', $this->approver));
                    } else {
                        Notification::route('telegram', $telegram_chat->chat_id)
                            ->notify(new NewReplenishmentRequest($this->transaction));
                    }
                }
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                Log::info($exception->getFile());
                Log::info($exception->getLine());
            }
            sleep(2);
        }
    }
}
