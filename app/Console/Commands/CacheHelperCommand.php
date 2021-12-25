<?php

namespace App\Console\Commands;

use App\Http\Controllers\DashboardController;
use App\Models\DeviceStat;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache helper';

    protected $users;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        parent::__construct();

        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->salaryLeft();
        $this->referralsCache();
    }

    private function salaryLeft()
    {
        $total_users_salary_left = 0;
        foreach(User::where('stat_salary_percent', '>', 0)->get() as $user) {
            $this->info('checking user '.$user->login);

            $left = cache()->remember('user_salary_left.'.$user->id, now()->addMinutes(30), function() use($user) {
                $all_referrals = cache()->remember('user.referrals_' . $user->id, 180, function () use ($user) {
                    return $user->getAllReferralsInArray(1, 1000);
                });

                $transaction_type_invest = TransactionType::getByName('enter');
                $transaction_type_withdrew = TransactionType::getByName('withdraw');
                $total_referral_invested = 0;
                $total_referral_withdrew = 0;

                foreach ($all_referrals as $referral) {
                    $invested = cache()->remember('referrals.total_invested_' . $referral->id, 60, function () use ($referral, $transaction_type_invest) {
                        return $referral->transactions()
                            ->where('type_id', $transaction_type_invest->id)
                            ->where('is_real', true)
                            ->where('approved', true)
                            ->sum('main_currency_amount');
                    });

                    $total_referral_invested += $invested;

                    // ------

                    $withdrew = cache()->remember('referrals.total_withdrew_' . $referral->id, 60, function () use ($referral, $transaction_type_withdrew) {
                        return $referral->transactions()
                            ->where('type_id', $transaction_type_withdrew->id)
                            ->where('is_real', true)
                            ->where('approved', 1)
                            ->sum('main_currency_amount');
                    });

                    $total_referral_withdrew += $withdrew;
                }

                $stat_different = $total_referral_invested - $total_referral_withdrew;
                $stat_salary = $stat_different / 100 * $user->stat_salary_percent;
                $stat_left = $stat_salary - $user->stat_worker_withdraw;

                $user->stat_deposits = round($total_referral_invested, 0);
                $user->stat_withdraws = round($total_referral_withdrew, 0);
                $user->stat_different = round($stat_different, 0);
                $user->stat_salary = round($stat_salary, 0);
                $user->stat_left = round($stat_left, 0);
                $user->save();

                return $user->stat_left;
            });

            $total_users_salary_left += $left;

            $this->info('left : '.$left);
        }

        cache()->remember('total_users_salary_left', now()->addHours(1), function() use($total_users_salary_left) {
            return $total_users_salary_left;
        });
    }

    private function referralsCache()
    {
        /** @var User $user */
        foreach (\App\User::orderBy('referrals_invested_total', 'desc')->get() as $user) {
            $this->info('cache for '.$user->login);

            cache()->remember('user.referrals_' . $user->id, 180, function () use ($user) {
                return $user->getAllReferralsInArray(1, 1000);
            });
        }
    }
}
