<?php

namespace App\Http\ViewComposers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAuthLog;
use Illuminate\View\View;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var User
     */
//    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param User $users
     *
     * @return void
     */
    public function __construct()
    {
//        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('admins', cache()->remember('dshb.admin_users', now()->addMinutes(5), function () {
            return User::whereHas('roles', function ($query) {
                $query->where(function ($query) {
                    $query->where('roles.name', '=', 'root');
                    $query->orWhere('roles.name', '=', 'admin');
                });
            })
                ->orderBy('last_activity_at', 'desc')
                ->get();
        }));

        $view->with('online_users', cache()->remember('dshb.online_users', now()->addMinutes(5), function () {
            return User::doesnthave('roles')->where('last_activity_at', '>=', now()->subHour(4))
                ->orderBy('last_activity_at', 'desc')
                ->get();
        }));

        $view->with('user_auth_logs', cache()->remember('dshb.user_auth_logs', now()->addMinutes(5), function () {
            return User::whereHas('roles', function ($query) {
                $query->where(function ($query) {
                    $query->where('roles.name', '=', 'teamlead');
                });
            })
                ->orderBy('last_activity_at', 'desc')
                ->get();
        }));

        $data = cache()->remember('dshb.dashboard_composer_data', now()->addHours(3), function () {

            $fromDate = strtotime('- 22 day');
            $usersCounts = [];
            $enterTransactions = [];
            $withdrawals = [];
            $profit = [];
            while (true) {
                $fromDate = strtotime(date('Y-m-d', $fromDate) . ' + 1 day');

                if ($fromDate > date('U')) {
                    break;
                }

                $date = date('Y-m-d', $fromDate);

                $usersCounts[$date] = User::where('created_at', '>=', $date . ' 00:00:00')
                    ->where('created_at', '<=', $date . ' 23:59:59')
                    ->count();

                $enterTransactions[$date] = Transaction::where('created_at', '>=', $date . ' 00:00:00')
                    ->where('created_at', '<=', $date . ' 23:59:59')
                    ->where('approved', '=', 1)->whereNotNull('payment_system_id')
                    ->whereHas('type', function ($query) {
                        $query->where('name', 'enter');
                    })->sum('main_currency_amount');

                $withdrawals[$date] = Transaction::where('created_at', '>=', $date . ' 00:00:00')
                    ->where('created_at', '<=', $date . ' 23:59:59')
                    ->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                        $query->where('name', 'withdraw');
                    })->sum('main_currency_amount');

                $profit[$date] = $enterTransactions[$date] - $withdrawals[$date];
            }

            return [
                'usersCounts' => $usersCounts,
                'enterTransactions' => $enterTransactions,
                'withdrawals' => $withdrawals,
                'profit' => $profit
            ];
        });

        $view->with('usersCountPeriod', array_values($data['usersCounts']));
        $view->with('enterTransactionsPeriod', array_values($data['enterTransactions']));
        $view->with('withdrawalsPeriod', array_values($data['withdrawals']));
        $view->with('profitPeriod', array_values($data['profit']));
    }
}
