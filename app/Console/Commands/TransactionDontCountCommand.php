<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class TransactionDontCountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:dont_count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transactions dont count';

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
        $transactions = Transaction::where('dont_stat_checked', false)
            ->orderBy('amount', 'desc')
            ->get();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $this->info('work with transaction '.$transaction->id);

            $transaction->dont_stat_checked = true;

            /** @var User $user */
            $user = $transaction->user;

            /** @var Role $role */
            $role = $user->roles()->first();

            if (null !== $role && $role->name == 'Конвершн') {
                $transaction->dont_stat = true;
            }

            $transaction->save();
        }

        return Command::SUCCESS;
    }
}
