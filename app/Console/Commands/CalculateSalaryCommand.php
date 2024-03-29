<?php

namespace App\Console\Commands;

use App\Models\SalaryLog;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Console\Command;

class CalculateSalaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:salaries {login?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate salaries';

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
        $login = $this->argument('login');
        $users = User::where('stat_salary_percent', '>', 0);

        if (!empty($login)) {
            $users = $users->where('login', $login);
        }

        $users = $users->get();

        $total_users_salary_left = 0;

        /** @var User $user */
        foreach ($users as $user) {
            $this->info('checking user ' . $user->login);

//            $all_referrals = cache()->remember('user.referrals_' . $user->id, 180, function () use ($user) {
            $all_referrals = $user->getAllReferralsInArray(1, 50);
//            });

            $this->info('got refs');

            $transaction_type_invest = TransactionType::getByName('enter');
            $transaction_type_withdrew = TransactionType::getByName('withdraw');
            $total_referral_invested = 0;
            $total_referral_withdrew = 0;

            $this->info('referrals '.count($all_referrals));

            foreach ($all_referrals as $referral) {
                $this->line('============');
                $this->info('check referral ' . $referral->id);

//                $invested = cache()->remember('referrals.total_invested_' . $referral->id, 60, function () use ($referral, $transaction_type_invest) {
                    $invested = $referral->transactions()
                        ->where('type_id', $transaction_type_invest->id)
                        ->where('is_real', true)
                        ->where('approved', 1)
                        ->sum('main_currency_amount');
//                });

                $total_referral_invested += $invested;
                $this->info('invested ' . $invested);

                // ------

//                $withdrew = cache()->remember('referrals.total_withdrew_' . $referral->id, 60, function () use ($referral, $transaction_type_withdrew) {
                $withdrew = $referral->transactions()
                        ->where('type_id', $transaction_type_withdrew->id)
                        ->where('is_real', true)
                        ->where('approved', 1)
                        ->sum('main_currency_amount');
//                });

                $total_referral_withdrew += $withdrew;
                $this->info('withdrew ' . $withdrew);
            }

            $this->info('$total_referral_invested: ' . $total_referral_invested);
            $this->info('$total_referral_withdrew: ' . $total_referral_withdrew);

            $stat_different = $total_referral_invested - $total_referral_withdrew;
            $stat_salary = $stat_different / 100 * $user->stat_salary_percent;
            $stat_left = $stat_salary - $user->stat_worker_withdraw;

            $user->stat_deposits = round($total_referral_invested, 0);
            $user->stat_withdraws = round($total_referral_withdrew, 0);
            $user->stat_different = round($stat_different, 0);
            $user->stat_salary = round($stat_salary, 0);
            $user->stat_left = round($stat_left, 0);
            $user->save();

            $total_users_salary_left += $user->stat_left;
            $this->info('left : ' . $user->stat_left);

            $logRow = SalaryLog::orderBy('created_at', 'desc')->first();

            if (is_null($logRow) || $this->checkLogNeeded($user, $logRow)) {
                SalaryLog::create([
                    'stat_deposits' => $user->stat_deposits,
                    'stat_withdraws' => $user->stat_withdraws,
                    'stat_different' => $user->stat_different,
                    'stat_salary' => $user->stat_salary,
                    'stat_left' => $user->stat_left,
                    'stat_worker_withdraw' => $user->stat_worker_withdraw,
                    'stat_salary_percent' => $user->stat_salary_percent,
                    'user_id' => $user->id
                ]);
            }
        }


        if (empty($login)) {
            cache()->forget('total_users_salary_left');
            cache()->remember('total_users_salary_left', now()->addHours(1), function () use ($total_users_salary_left) {
                return $total_users_salary_left;
            });
        }
    }

    /**
     * @param $user
     * @param $logRow
     * @return bool
     */
    public function checkLogNeeded($user, $logRow)
    {
        $fields = [
            'stat_deposits',
            'stat_withdraws',
            'stat_different',
            'stat_salary',
            'stat_left',
            'stat_worker_withdraw',
            'stat_salary_percent'
        ];

        foreach ($fields as $field) {
            if ($user->$field != $logRow->$field) {
                return true;
            }
        }
        return false;
    }
}
