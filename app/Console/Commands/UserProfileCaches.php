<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\User;
use Illuminate\Console\Command;

class UserProfileCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile-cache:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $transaction_type_invest = TransactionType::getByName('enter');
        $transaction_type_withdrew = TransactionType::getByName('withdraw');
        foreach (User::all() as $user) {
            cache()->remember('users.referral.count.' . $user->my_id, now()->subHours(3), function () use ($user) {
                return $user->userReferrals->count();
            });

            $all_referrals = cache()->remember('user.referrals_' . $user->id, 60, function () use ($user) {
                return $user->getAllReferralsInArray(1, 1000);
            });

            $referralIds = collect($all_referrals)->pluck('id')->toArray();

            cache()->remember('referrals.total_invested_' . $user->id, now()->addHours(3), function () use ($transaction_type_invest, $referralIds) {
                return Transaction::whereIn('user_id', $referralIds)->where('type_id', $transaction_type_invest->id)
                    ->where('is_real', true)
                    ->where('approved', true)
                    ->sum('main_currency_amount');
            });

            cache()->remember('referrals.total_withdrew_' . $user->id, now()->addHours(3), function () use ($transaction_type_withdrew, $referralIds) {
                return Transaction::whereIn('user_id', $referralIds)
                    ->where('type_id', $transaction_type_withdrew->id)
                    ->where('is_real', true)
                    ->where('approved', 1)
                    ->sum('main_currency_amount');
            });

            if ($user->activities()->count()) {
                foreach (['day', 'week', 'month'] as $period) {
                    ActivityLog::getActivityLog($user, $period, null, null, true);
                }
            }
        }
        return Command::SUCCESS;
    }
}
