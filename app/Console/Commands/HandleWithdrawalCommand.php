<?php

namespace App\Console\Commands;

use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class HandleWithdrawalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:withdrawals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically handle withdrawals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var Transaction $transactions */
        $transactions = Transaction::where('withdraw_waiting', true)
            ->orderBy('created_at')
            ->get();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            DB::transaction(function () use($transaction) {
                if ($transaction->withdraw_action == 'approve') {
                    $this->approve($transaction);
                } else if ($transaction->withdraw_action == 'reject') {
                    $this->reject($transaction);
                } else if ($transaction->withdraw_action == 'approveManually') {
                    $this->approveManually($transaction);
                } else if ($transaction->withdraw_action == 'approveFake') {
                    $this->approveFake($transaction);
                }

                $this->info('transaction '.$transaction->id.' handled. Amount '.$transaction->amount.'. '.$transaction->withdraw_action.'. '.$transaction->withdraw_reason);
            });
        }

        return Command::SUCCESS;
    }

    /**
     * @param Transaction $transaction
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Http\RedirectResponse|string|null
     * @throws \Exception
     */
    public function reject(Transaction $transaction)
    {
        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();
        $wallet->returnFromRejectedWithdrawal($transaction);
        $transaction->update(['approved' => Transaction::TRANSACTION_REJECTED]);
    }

    /**
     * @param Transaction $transaction
     */
    public static function approve(Transaction $transaction) {
        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = $transaction->paymentSystem;

        $ps = $paymentSystem->getClassName();

        if (empty($ps)) {
            $transaction->withdraw_reason = 'Платежная система не поддерживает автоплатежи';
            $transaction->withdraw_waiting = false;
            $transaction->save();
            return;
        }

        if (empty($wallet->external)) {
            $transaction->withdraw_reason = 'кошелек пуст';
            $transaction->withdraw_waiting = false;
            $transaction->save();
            return;
        }

        try {
            $batchId = $ps::transfer($transaction);
        } catch (\Exception $e) {
            $transaction->withdraw_reason = $e->getMessage();
            $transaction->withdraw_waiting = false;
            $transaction->save();
            return;
        }

        $transaction->batch_id = $batchId;
        $transaction->save();

        if (empty($batchId)) {
            $transaction->withdraw_reason = 'батч айди не найден';
            $transaction->withdraw_waiting = false;
            $transaction->save();
            return;
        }

        $transaction->update([
            'approved' => true,
            'withdraw_finish' => true,
            'withdraw_reason' => null,
        ]);
    }

    /**
     * @param Transaction $transaction
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Http\RedirectResponse|string|null
     * @throws \Exception
     */
    public function approveManually(Transaction $transaction) {
        $transaction->update([
            'approved' => true,
            'withdraw_finish' => true,
            'withdraw_reason' => null,
        ]);
    }

    /**
     * @param Transaction $transaction
     */
    public function approveFake(Transaction $transaction) {
        $transaction->update([
            'approved' => true,
            'withdraw_finish' => true,
            'withdraw_reason' => null,
            'is_real' => false,
        ]);
    }
}
