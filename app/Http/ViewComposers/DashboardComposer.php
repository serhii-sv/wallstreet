<?php

namespace App\Http\ViewComposers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\View\View;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var User
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param User $users
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->users = $users;
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
        $view->with('admins', $this->users
            ->whereHas('roles', function ($query) {
                $query->where(function ($query) {
                    $query->where('roles.name', '=', 'root');
                    $query->orWhere('roles.name', '=', 'admin');
                });
            })
            ->orderBy('last_activity_at', 'desc')
            ->get())
            ->with('online_users', $this->users->doesnthave('roles')->where('last_activity_at', '>=', now()->subHour(4))
                ->orderBy('last_activity_at', 'desc')
                ->get());

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
                })->get()->reduce(function ($carry, $item) {
                    return $carry + $item->main_currency_amount;
                }, 0);

            $withdrawals[$date] = Transaction::where('created_at', '>=', $date . ' 00:00:00')
                ->where('created_at', '<=', $date . ' 23:59:59')
                ->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);

            $profit[$date] = $enterTransactions[$date] - $withdrawals[$date];
        }

        $view->with('usersCountPeriod', array_values($usersCounts));
        $view->with('enterTransactionsPeriod', array_values($enterTransactions));
        $view->with('withdrawalsPeriod', array_values($withdrawals));
        $view->with('profitPeriod', array_values($profit));
    }
}
