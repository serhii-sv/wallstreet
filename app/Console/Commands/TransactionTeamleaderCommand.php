<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
    {\Log::critical(self::class);
        $time = now();
        /** @var Transaction $transactions */
        $transactions = Transaction::whereNull('teamleader')
            ->whereIn('type_id', [TransactionType::getByName('withdraw')->id, TransactionType::getByName('enter')->id])
            ->orderBy('created_at', 'desc')
            ->get();

        $transactionsTotal = $transactions->count();

        $this->info('total transactions: ' . $transactionsTotal);

        $processed = 0;

        foreach ($transactions->chunk(5000) as $chunk) {

            $queries = '';

            foreach ($chunk as $transaction) {
                /** @var User $user */
                $user = $transaction->user;

                /** @var User $teamleader */
                $teamleader = cache()->remember('user.user_teamleader_' . $user->id, now()->addHours(3), function () use ($user) {
                    return $user->firstPartner($user);
                });

                /** @var User $upliner */
                $upliner = $user->partner;

                $teamleader = $transaction->teamleader = null !== $teamleader ? $teamleader->id : null;

                $upliner = ($transaction->upliner = null !== $upliner ? $upliner->id : null);

                $queries .= "UPDATE transactions SET teamleader = '{$teamleader}', upliner = '{$upliner}' WHERE `int_id` = {$transaction->int_id};";

                $processed++;

                $this->info('processed transactions: ' .  $processed . '/' . $transactionsTotal);
                $this->info('work time minutes: ' .  now()->diffInMinutes($time));
                $this->info('work time seconds: ' .  now()->diffInSeconds($time) . "\n");
            }

            if ($queries != '') {
                DB::unprepared($queries);
            }
        }

        $this->info('total time in minutes: ' .  now()->diffInMinutes($time));
        $this->info('work time seconds: ' .  now()->diffInSeconds($time));

        /** @var Transaction $transaction */
//        foreach ($transactions as $transaction) {
//            $this->info('work with transaction '.$transaction->id);
//
//            /** @var User $user */
//            $user = $transaction->user;
//
//            /** @var User $teamleader */
//            $teamleader = cache()->remember('user.user_teamleader_' . $user->id, now()->addHours(3), function () use ($user) {
//                return $user->firstPartner($user);
//            });
//
//            /** @var User $upliner */
//            $upliner = $user->partner;
//
//            $transaction->teamleader = null !== $teamleader
//                ? $teamleader->id
//                : null;
//
//            $transaction->upliner = null !== $upliner
//                ? $upliner->id
//                : null;
//
////            $transaction->save();
//
//            $processed++;
//
//            $this->info('processed transactions: ' .  $processed);
//            $this->info('work time minutes: ' .  now()->diffInMinutes($time));
//            $this->info('work time seconds: ' .  now()->diffInSeconds($time) . "\n");
//        }

//        $this->info('total time in minutes: ' .  now()->diffInMinutes($time));

        return Command::SUCCESS;
    }
}
