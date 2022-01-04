<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Console\Command;

class UpdateZeroAmountTransactionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:zero_transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update zero amount transactions';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException|\Exception
     */
    public function handle()
    {
        /** @var TransactionType $transactions */
        $transactions = Transaction::where('main_currency_amount', 0)
            ->where('amount', '>', 0)
            ->get();

        /** @var Currency $usd */
        $usd = Currency::where('code', 'USD')->first();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $this->info('work with transaction '.$transaction->id.', amount '.$transaction->amount);

            $transaction->main_currency_amount = $transaction->convertToCurrency($transaction->currency, $usd, $transaction->amount);
            $transaction->save();

            $this->info('new amount '.$transaction->main_currency_amount);
            $this->info('----------------');
        }
    }
}
