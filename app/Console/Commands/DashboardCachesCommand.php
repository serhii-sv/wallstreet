<?php

namespace App\Console\Commands;

use App\Http\Controllers\DashboardController;
use App\Models\DeviceStat;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class DashboardCachesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:dashboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache dashboard';

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
        cache()->forget('dshb.id_withdraw');
        $id_withdraw = cache()->remember('dshb.id_withdraw', now()->addHours(3), function () {
            return TransactionType::where('name', 'withdraw')->first()->id;
        });
        cache()->forget('dshb.id_enter');
        $id_enter = cache()->remember('dshb.id_enter', now()->addHours(3), function () {
            return TransactionType::where('name', 'enter')->first()->id;
        });

        $weeks_period_enter_transactions = [];
        $weeks_period_withdraw_transactions = [];
        $month_period_enter_transactions = [];
        $month_period_withdraw_transactions = [];

        $dashboardController = new DashboardController(User::get());

        cache()->forget('dshb.month_period');
        $month_period = cache()->remember('dshb.month_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getMonthPeriod();
        });
        cache()->forget('dshb.weeks_period');
        $weeks_period = cache()->remember('dshb.weeks_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getWeeksPeriod();
        });
        cache()->forget('dshb.prev_month_period');
        $prev_month_period = cache()->remember('dshb.prev_month_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getPreviousMonthPeriod();
        });
        cache()->forget('dshb.prev_weeks_period');
        $prev_weeks_period = cache()->remember('dshb.prev_weeks_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getPreviousWeekPeriod();
        });
        cache()->forget('dshb.last_prev_transactions');
        $prev_week_transactions = cache()->remember('dshb.last_prev_transactions' . $prev_weeks_period['start'], now()->addHours(3), function () use ($prev_weeks_period) {
            return Transaction::where('approved', 1)->where('is_real', 1)->whereBetween('updated_at', [
                $prev_weeks_period['start'],
                $prev_weeks_period['end'],
            ])->get();
        });

        cache()->forget('dshb.weeks_previous_period_enter_transactions');
        cache()->remember('dshb.weeks_previous_period_enter_transactions', now()->addHours(3), function () use ($prev_week_transactions, $id_enter) {
            return $prev_week_transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        });
        cache()->forget('dshb.weeks_previous_period_withdraw_transactions');
        cache()->remember('dshb.weeks_previous_period_withdraw_transactions', now()->addHours(3), function () use ($prev_week_transactions, $id_withdraw) {
            return $prev_week_transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        });

        foreach ($weeks_period as $week) {
            cache()->forget('dshb.last_transactions' . $week['start']);
            $transactions = cache()->remember('dshb.last_transactions' . $week['start'], now()->addHours(3), function () use ($week) {
                return Transaction::where('approved', 1)->where('is_real', 1)->whereBetween('updated_at', [
                    $week['start'],
                    $week['end'],
                ])->get();
            });
            $weeks_period_enter_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = $transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            $weeks_period_withdraw_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }

        cache()->forget('dshb.payment_systems');
        cache()->remember('dshb.payment_systems', now()->addHours(3), function () {
            return PaymentSystem::all();
        });

        foreach ($month_period as $key => $month) {
            cache()->forget('dshb.last_transactions');
            $transactions = cache()->remember('dshb.last_transactions' . $month['start'], now()->addHours(3), function () use ($month) {
                return Transaction::where('approved', 1)->where('is_real', 1)->whereBetween('updated_at', [
                    $month['start'],
                    $month['end'],
                ])->get();
            });
            $month_period_enter_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = $transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            $month_period_withdraw_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }
        cache()->forget('dshb.last_prev_transactions');
        $prev_month_transactions = cache()->remember('dshb.last_prev_transactions' . $prev_month_period['start'], now()->addHours(3), function () use ($prev_month_period) {
            return Transaction::where('approved', 1)->where('is_real', 1)->whereBetween('updated_at', [
                $prev_month_period['start'],
                $prev_month_period['end'],
            ])->get();
        });

        cache()->forget('dshb.month_previous_period_enter_transactions');
        cache()->remember('dshb.month_previous_period_enter_transactions', now()->addHours(3), function () use ($prev_month_transactions, $id_enter) {
            return $prev_month_transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        });
        cache()->forget('dshb.month_previous_period_withdraw_transactions');
        cache()->remember('dshb.month_previous_period_withdraw_transactions', now()->addHours(3), function () use ($prev_month_transactions, $id_withdraw) {
            return $prev_month_transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        });

        $count_countries = 5;
        $count_cities = 10;

        cache()->forget('dshb.countries_stat_all');
        $countries_stat = cache()->remember('dshb.countries_stat_all', now()->addHours(3), function () {
            return User::where('country', '!=', null)->select(['country as name'])->groupBy(['country'])->get();
        });

        $countries_stat->map(function ($country) use ($id_enter) {
            cache()->forget('dshb.countries_stat_count_' . $country->name);
            $country->count = cache()->remember('dshb.countries_stat_count_' . $country->name, now()->addHours(3), function () use ($country) {
                return User::where('country', $country->name)->count();
            });
        });

        cache()->forget('dshb.countries_stat');
        $countries_stat = cache()->remember('dshb.countries_stat', now()->addHours(3), function () use ($countries_stat, $count_countries) {
            return $countries_stat->sortByDesc('count')->take($count_countries);
        });

        $countries_stat->map(function ($country) use ($id_enter) {
            $country->invested = 0;
            User::where('country', $country->name)->get()->map(function ($user) use ($country, $id_enter) {
                cache()->forget('dshb.countries_stat_invested_' . $user->id);
                $country->invested += cache()->remember('dshb.countries_stat_invested_' . $user->id, now()->addHours(3), function () use ($country, $id_enter, $user) {
                    return $user->transactions()->where('is_real', 1)->where('type_id', $id_enter)->sum('main_currency_amount');
                });
            });
        });

        cache()->forget('dshb.device_stat');
        cache()->remember('dshb.device_stat', now()->addHours(3), function () {
            return DeviceStat::orderBy('count', 'desc')->limit(5)->get();
        });

        cache()->forget('dshb.cities_stat_all');
        $cities_stat = cache()->remember('dshb.cities_stat_all', now()->addHours(3), function () {
            return User::where('city', '!=', null)->select(['city as name'])->groupBy(['city'])->get();
        });
        $cities_stat->map(function ($city) use ($id_enter) {
            cache()->forget('dshb.city_stat_count_' . $city->name);
            $city->count = cache()->remember('dshb.city_stat_count_' . $city->name, now()->addHours(3), function () use ($city) {
                return User::where('city', $city->name)->count();
            });
        });

        cache()->forget('dshb.cities_stat');
        cache()->remember('dshb.cities_stat', now()->addHours(3), function () use ($cities_stat, $count_cities) {
            return $cities_stat->sortByDesc('count')->take($count_cities);
        });

        cache()->forget('dshb.transactions.enter.for_24h');
        Cache::remember('dshb.transactions.enter.for_24h', now()->addHours(3), function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->where('is_real', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);
        });

        cache()->forget('dshb.transactions.withdraw.for_24h');
        Cache::remember('dshb.transactions.withdraw.for_24h', now()->addHours(3), function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->where('is_real', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->sum('main_currency_amount');
        });

        /** @var PaymentSystem $payment_systems */
        cache()->forget('dshb.payment_systems');
        cache()->remember('dshb.payment_systems', now()->addHours(3), function () {
            return PaymentSystem::paginate(10);
        });

        cache()->forget('dshb.transactions.enter.total');
        Cache::remember('dshb.transactions.enter.total', now()->addHours(3), function () {
            return Transaction::where('approved', '=', 1)->where('is_real', true)->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->sum('main_currency_amount');
        });

        cache()->forget('dshb.transactions.withdraw.total');
        Cache::remember('dshb.transactions.withdraw.total', now()->addHours(3), function () {
            return Transaction::where('approved', '=', 1)->where('is_real', true)->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->sum('main_currency_amount');
        });
    }
}
