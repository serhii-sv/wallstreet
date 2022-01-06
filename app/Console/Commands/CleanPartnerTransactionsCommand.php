<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Console\Command;

class CleanPartnerTransactionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:partner_transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean old partner transactions';

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
        $transactions = Transaction::where('created_at', '<=', now()->subDays(7))
            ->where('type_id', TransactionType::getByName('partner')->id)
            ->get();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $this->info('transaction '.$transaction->id.' deleted');
            $transaction->delete();
        }

        return Command::SUCCESS;
    }
}
