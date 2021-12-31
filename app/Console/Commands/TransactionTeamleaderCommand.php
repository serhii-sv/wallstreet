<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class TransactionTeamleaderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:teamleaders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attach transaction teamleaders';

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
        $transactions = Transaction::whereNull('teamleader')
            ->orderBy('created_at', 'desc')
            ->get();

        /** @var Transaction $transaction */
        foreach ($transactions as $transaction) {
            $this->info('work with transaction '.$transaction->id);

            /** @var User $user */
            $user = $transaction->user;

            /** @var User $teamleader */
            $teamleader = $user->firstPartner($user);

            /** @var User $upliner */
            $upliner = $user->partner;

            $transaction->teamleader = null !== $teamleader
                ? $teamleader->id
                : null;

            $transaction->upliner = null !== $upliner
                ? $upliner->id
                : null;

            $transaction->save();
        }

        return Command::SUCCESS;
    }
}
