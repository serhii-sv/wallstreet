<?php

namespace App\Jobs;

use App\Models\TelegramChat;
use App\Models\Transaction;
use App\Notifications\NewReplenishmentRequest;
use App\Notifications\NewWithdrawalRequest;
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
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, $transactionTypes = [])
    {
        $this->transaction = $transaction;
        $this->transactionTypes = $transactionTypes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (TelegramChat::where('active', true)->pluck('chat_id')->toArray() as $chat_id) {
            try {
                if ($this->transaction->type_id == $this->transactionTypes['withdraw']) {
                    $notification =  new NewWithdrawalRequest($this->transaction);
                } else {
                    $notification = new NewReplenishmentRequest($this->transaction);
                }

                Notification::route('telegram', $chat_id)->notify($notification);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
                Log::info($exception->getFile());
                Log::info($exception->getLine());
            }
            sleep(2);
        }
    }
}
