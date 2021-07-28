<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestDashboardBonusUser;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $count_main_graph = 12;
        $weeks_main_graph = $this->getWeeksFirstDayArray($count_main_graph);
        $months = $this->getMonthsFirstDayArray($count_main_graph);
        $id_withdraw = TransactionType::where('name', 'withdraw')->first()->id;
        $id_enter = TransactionType::where('name', 'enter')->first()->id;
        $id_drawn = TransactionType::where('name', 'bonus')->first()->id;

        $transactions_deposit_sum = [];
        $transactions_withdraw_sum = [];
        foreach ($weeks_main_graph as $key => $week) {
            $transactions = cache()->remember('dshb.last_transactions' . $key, 60, function () use ($week) {
                return Transaction::where('approved', 1)->whereBetween('created_at', [
                    $week->format('Y-m-d H:i:s'),
                    $week->endOfWeek(),
                ])->get();
            });
            $transactions_deposit_sum[$key] = $transactions->where('type_id', '!=', $id_enter)->sum('main_currency_amount');
            $transactions_withdraw_sum[$key] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
            $transactions_drawn_sum[$key] = $transactions->where('type_id', '=', $id_drawn)->sum('main_currency_amount');
        }
        $deposit_total_sum = array_sum($transactions_deposit_sum);
        $deposit_total_withdraw = array_sum($transactions_withdraw_sum);
        $deposit_total_drawn = array_sum($transactions_drawn_sum);
        $deposit_diff = $deposit_total_sum - $deposit_total_withdraw;

        $payment_system = PaymentSystem::all();
        foreach ($payment_system as $item) {
            $item->transaction_sum = cache()->remember('dshb.payment_transactions_sum' . $item->id, 60, function () use ($item) {
                return $item->transactions_enter()->sum('main_currency_amount');
            });
            $item->transaction_minus = cache()->remember('dshb.payment_transaction_minus' . $item->id, 60, function () use ($item) {
                return $item->transactions_withdraw()->sum('main_currency_amount');
            });
        }
        $transactions_month = [];
        foreach ($months as $key => $month) {
            $transactions_month[$key]['month'] = $month;
            $last_month_transactions = cache()->remember('dshb.last_month_transactions' . $key, 60 * 24, function () use ($month) {
                return Transaction::where('approved', 1)->whereBetween('created_at', [
                    $month->format('Y-m-d H:i:s'),
                    $month->endOfMonth(),
                ])->select('type_id', 'main_currency_amount')->get();
            });
            $transactions_month[$key]['enter'] = $last_month_transactions->where('type_id', '!=', $id_enter)->sum('main_currency_amount');
            $transactions_month[$key]['withdraw'] = $last_month_transactions->where('type_id', '!=', $id_withdraw)->sum('main_currency_amount');
            $transactions_month[$key]['drawn'] = $last_month_transactions->where('type_id', '!=', $id_drawn)->sum('main_currency_amount');
        }
        $count_countries = 5;
        $count_cities = 10;
        $countries_stat = User::where('country', '!=', null)->select(['country as name'])->groupBy(['country'])->get();

        $countries_stat->map(function ($country) use ($id_enter) {
            $country->count = cache()->remember('dshb.countries_stat_count_' . $country->name, 60, function () use ($country) {
                return User::where('country', $country->name)->count();
            });
        });
        $countries_stat = $countries_stat->sortByDesc('count')->take($count_countries);
        $countries_stat->map(function ($country) use ($id_enter) {
            $country->invested = 0;
            User::where('country', $country->name)->get()->map(function ($user) use ($country, $id_enter) {
                $country->invested += cache()->remember('dshb.countries_stat_invested_' . $user->id, 60, function () use ($country, $id_enter, $user) {
                   return $user->transactions()->where('type_id', $id_enter)->sum('main_currency_amount');
                });
            });

        });

        $cities_stat = User::where('city', '!=', null)->select(['city as name'])->groupBy(['city'])->get();
        $cities_stat->map(function ($city) use ($id_enter) {
            $city->count = cache()->remember('dshb.city_stat_count_' . $city->name, 60, function () use ($city) {
                return User::where('city', $city->name)->count();
            });
        });
        $cities_stat = $cities_stat->sortByDesc('count')->take($count_cities);

        return view('admin.dashboard', [
            'weeks_main_graph' => $this->getWeeksFirstDayArray($count_main_graph),
            'transactions_deposit_sum' => $transactions_deposit_sum,
            'transactions_withdraw_sum' => $transactions_withdraw_sum,
            'deposit_diff' => $deposit_diff,
            'deposit_total_drawn' => $deposit_total_drawn,
            'deposit_total_sum' => $deposit_total_sum,
            'deposit_total_withdraw' => $deposit_total_withdraw,
            'last_operations' => Transaction::orderByDesc('created_at')->limit(10)->get(),
            'currencies' => Currency::all(),
            'payment_system' => $payment_system,
            'user_auth_logs' => UserAuthLog::where('is_admin', true)->orderByDesc('created_at')->limit(10)->get(),
            'transactions_month' => $transactions_month,
            'countries_stat' => $countries_stat,
            'cities_stat' => $cities_stat,
            'online_users' => $this->users->where('last_activity_at', '>', Carbon::now()
                ->subSeconds(config('chats.max_idle_sec_to_be_online'))
                ->format('Y-m-d H:i:s')
            )->get()
        ]);
    }

    public function addUserBonus(RequestDashboardBonusUser $request) {
        $user = User::where('name', $request->post('user'))->orWhere('login', $request->post('user'))->orWhere('email', $request->post('user'))->first();
        if (empty($user)) {
            return back()->withErrors([__('User not found!')])->withInput();
        }
        $currency_id = $request->post('currency_id');
        $payment_system_id = $request->post('payment_system_id');
        $wallet = Wallet::where('user_id', $user->id)->where('currency_id', $currency_id)->where('payment_system_id', $payment_system_id)->first();
        if (empty($wallet)) {
            $wallet = new Wallet();
            $wallet->user_id = $user;
            $wallet->currency_id = $currency_id;
            $wallet->payment_system_id = $payment_system_id;
        }
        $wallet = $wallet->addBonus(intval($request->post('amount')));
        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->post('amount'),
                'currency' => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance' => $wallet->balance,
            ];
            $wallet->user->sendNotification('bonus_accrued', $data);
            return back()->with('success', __('Bonus accrued'))->withInput();
        }
        return back()->with('error', __('Unable to accrue bonus'))->withInput();
    }

    public function getWeeksFirstDayArray($count = 1) {
        $weeks = [];
        for ($i = 1, $j = 1; $count >= $i; $j++, $count--) {
            $weeks[$j] = now()->startOfWeek()->subWeek($count - 1);
        }
        return $weeks;
    }

    public function getMonthsFirstDayArray($count) {
        $months = [];
        for ($i = 1, $j = 1; $count >= $i; $j++, $count--) {
            $months[$j] = now()->startOfMonth()->subMonth($count - 1);
        }
        return $months;
    }
}
