<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\DeviceStat;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use Illuminate\Support\Facades\Cache;


class DashboardController extends Controller
{
    public function __construct()
    {
        // ...
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
//        return redirect('/users');

        $id_withdraw = cache()->remember('dshb.id_withdraw', now()->addHours(3), function () {
            return TransactionType::where('name', 'withdraw')->first()->id;
        });

        $id_enter = cache()->remember('dshb.id_enter', now()->addHours(3), function () {
            return TransactionType::where('name', 'enter')->first()->id;
        });

        $weeks_period_enter_transactions = [];
        $weeks_period_withdraw_transactions = [];
        $month_period_enter_transactions = [];
        $month_period_withdraw_transactions = [];

        $dashboardController = $this;

        $month_period = cache()->remember('dshb.month_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getMonthPeriod();
        });
        $weeks_period = cache()->remember('dshb.weeks_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getWeeksPeriod();
        });

        $prev_month_period = cache()->remember('dshb.prev_month_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getPreviousMonthPeriod();
        });

        $prev_weeks_period = cache()->remember('dshb.prev_weeks_period', now()->addHours(3), function () use ($dashboardController) {
            return $dashboardController->getPreviousWeekPeriod();
        });

        $weeks_previous_period_enter_transactions = cache()->remember('dshb.weeks_previous_period_enter_transactions', now()->addHours(3), function () use ($prev_weeks_period, $id_enter) {
            return Transaction::where('approved', 1)
                ->where('dont_stat', false)
                ->where('is_real', 1)
                ->whereBetween('created_at', [
                $prev_weeks_period['start'],
                $prev_weeks_period['end'],
            ])->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        });
        $weeks_previous_period_withdraw_transactions = cache()->remember('dshb.weeks_previous_period_withdraw_transactions', now()->addHours(3), function () use ($prev_weeks_period, $id_withdraw) {
            return Transaction::where('approved', 1)
                ->where('dont_stat', false)
                ->where('is_real', 1)
                ->whereBetween('created_at', [
                $prev_weeks_period['start'],
                $prev_weeks_period['end'],
            ])->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        });

        foreach ($weeks_period as $week) {
            $weeks_period_enter_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = cache()->remember('dshb.main_currency_amount_enter_week_' . $week['start'], now()->addHours(3), function () use ($week, $id_enter) {
                return Transaction::where('approved', 1)
                    ->where('dont_stat', false)
                    ->where('is_real', 1)
                    ->whereBetween('created_at', [
                    $week['start'],
                    $week['end'],
                ])->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            });
            $weeks_period_withdraw_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = cache()->remember('dshb.main_currency_amount_withdraw_week_' . $week['start'], now()->addHours(3), function () use ($week, $id_withdraw) {
                return Transaction::where('approved', 1)
                    ->where('dont_stat', false)
                    ->where('is_real', 1)
                    ->whereBetween('created_at', [
                    $week['start'],
                    $week['end'],
                ])->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
            });
        }


        $payment_system = cache()->remember('dshb.payment_systems', now()->addHours(3), function () {
            return PaymentSystem::paginate(10);
        });

        $weeks_total_enter = array_sum($weeks_period_enter_transactions);
        $weeks_total_withdraw = array_sum($weeks_period_withdraw_transactions);
        $weeks_deposit_revenue = $weeks_total_enter - $weeks_total_withdraw;

        $curr_to_prev_week = $weeks_previous_period_enter_transactions - $weeks_previous_period_withdraw_transactions;
        $week_revenue_percent = number_format(($curr_to_prev_week / (!$weeks_deposit_revenue ? 1 : $weeks_deposit_revenue ?? 1)) * 100, 2, '.', ',');

        foreach ($month_period as $key => $month) {
            $month_period_enter_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = cache()->remember('dshb.main_currency_amount_enter_month_' . $month['start'], now()->addHours(3), function () use ($month, $id_enter) {
                return Transaction::where('approved', 1)
                    ->where('dont_stat', false)
                    ->where('is_real', 1)
                    ->whereBetween('created_at', [
                    $month['start'],
                    $month['end'],
                ])->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            });
            $month_period_withdraw_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = cache()->remember('dshb.main_currency_amount_withdraw_month_' . $month['start'], now()->addHours(3), function () use ($month, $id_withdraw) {
                return Transaction::where('approved', 1)->where('is_real', 1)->whereBetween('created_at', [
                    $month['start'],
                    $month['end'],
                ])->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
            });
        }

        $month_previous_period_enter_transactions = cache()->remember('dshb.month_previous_period_enter_transactions', now()->addHours(3), function () use ($prev_month_period, $id_enter) {
            return Transaction::where('approved', 1)
                ->where('dont_stat', false)
                ->where('is_real', 1)
                ->whereBetween('created_at', [
                $prev_month_period['start'],
                $prev_month_period['end'],
            ])->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        });
        $month_previous_period_withdraw_transactions = cache()->remember('dshb.month_previous_period_withdraw_transactions', now()->addHours(3), function () use ($prev_month_period, $id_withdraw) {
            return Transaction::where('approved', 1)
                ->where('dont_stat', false)
                ->where('is_real', 1)
                ->whereBetween('created_at', [
                $prev_month_period['start'],
                $prev_month_period['end'],
            ])->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        });

        $month_total_enter = array_sum($month_period_enter_transactions);
        $month_total_withdraw = array_sum($month_period_withdraw_transactions);
        $month_deposit_revenue = $month_total_enter - $month_total_withdraw;
        $count_countries = 5;
        $count_cities = 10;
        $countries_stat = cache()->remember('dshb.countries_stat_all', now()->addHours(3), function () {
            return User::where('country', '!=', null)->select(['country as name'])->groupBy(['country'])->get();
        });

        $curr_to_prev_month = $month_previous_period_enter_transactions - $month_previous_period_withdraw_transactions;
        $month_revenue_percent = number_format(($curr_to_prev_month / ($month_deposit_revenue ? $month_deposit_revenue : 1)) * 100, 2, '.', ',');

        $countries_stat->map(function ($country) use ($id_enter) {
            $country->count = cache()->remember('dshb.countries_stat_count_' . $country->name, now()->addHours(3), function () use ($country) {
                return User::where('country', $country->name)->count();
            });
        });

        $countries_stat = cache()->remember('dshb.countries_stat', now()->addHours(3), function () use ($countries_stat, $count_countries) {
            return $countries_stat->sortByDesc('count')->take($count_countries);
        });

        $countries_stat->map(function ($country) use ($id_enter) {
            $country->invested = 0;
            cache()->remember('dshb.country_invested_' . $country['id'], now()->addHours(3), function () use (&$country, $id_enter) {
                User::where('country', $country->name)->get()->map(function ($user) use (&$country, $id_enter) {
                    $country->invested +=  cache()->remember('dshb.countries_stat_invested_' . $user->id, now()->addHours(3), function () use ($country, $id_enter, $user) {
                        return $user->transactions()
                            ->where('dont_stat', false)
                            ->where('is_real', 1)
                            ->where('type_id', $id_enter)
                            ->sum('main_currency_amount');
                    });
                });
            });
        });

        $device_stat = cache()->remember('dshb.device_stat', now()->addHours(3), function () {
            return DeviceStat::orderBy('count', 'desc')->limit(5)->get();
        });

        $cities_stat = cache()->remember('dshb.cities_stat_all', now()->addHours(3), function () {
            return User::where('city', '!=', null)->select(['city as name'])->groupBy(['city'])->get();
        });
        $cities_stat->map(function ($city) use ($id_enter) {
            $city->count = cache()->remember('dshb.city_stat_count_' . $city->name, now()->addHours(3), function () use ($city) {
                return User::where('city', $city->name)->count();
            });
        });

        $cities_stat = cache()->remember('dshb.cities_stat', now()->addHours(3), function () use ($cities_stat, $count_cities) {
            return $cities_stat->sortByDesc('count')->take($count_cities);
        });

        $enter_transactions_for_24h_sum = Cache::remember('dshb.transactions.enter.for_24h', now()->addHours(3), function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))
                ->where('dont_stat', false)
                ->where('approved', '=', 1)
                ->where('is_real', 1)
                ->whereNotNull('payment_system_id')
                ->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->sum('main_currency_amount');
        });

        $withdraw_transactions_for_24h_sum = Cache::remember('dshb.transactions.withdraw.for_24h', now()->addHours(3), function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))
                ->where('dont_stat', false)
                ->where('approved', '=', 1)
                ->where('is_real', 1)
                ->whereNotNull('payment_system_id')
                ->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->sum('main_currency_amount');
        });

        /** @var PaymentSystem $payment_systems */
        $payment_systems_paginate = Cache::remember('dshb.payment_systems', now()->addHours(3), function () {
            return PaymentSystem::paginate(10);
        });

        $depositTotal = Cache::remember('dshb.transactions.enter.total', now()->addHours(3), function () {
            return Transaction::where('approved', '=', 1)
                ->where('dont_stat', false)
                ->where('is_real', true)
                ->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->sum('main_currency_amount');
        });

        $withdrawTotal = Cache::remember('dshb.transactions.withdraw.total', now()->addHours(3), function () {
            return Transaction::where('approved', '=', 1)
                ->where('dont_stat', false)
                ->where('is_real', true)
                ->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->sum('main_currency_amount');
        });

        $salaryLeft = \cache()->has('total_users_salary_left') ? cache()->get('total_users_salary_left') : 0;

//        dd(Transaction::count());

        return view('pages.dashboard', [
            'week_revenue_percent' => $week_revenue_percent,
            'month_revenue_percent' => $month_revenue_percent,
            'weeks_period_enter_transactions' => $weeks_period_enter_transactions,
            'weeks_period_withdraw_transactions' => $weeks_period_withdraw_transactions,
            'month_period_enter_transactions' => $month_period_enter_transactions,
            'month_period_withdraw_transactions' => $month_period_withdraw_transactions,
            'month_total_enter' => $month_total_enter,
            'month_total_withdraw' => $month_total_withdraw,
            'month_deposit_revenue' => Transaction::sidebarIndicatorsFormatting($month_deposit_revenue),
            'weeks_deposit_revenue' => Transaction::sidebarIndicatorsFormatting($weeks_deposit_revenue),
            'weeks_total_enter' => $weeks_total_enter,
            'weeks_total_withdraw' => $weeks_total_withdraw,
            'weeks_period' => $weeks_period,
            'month_period' => $month_period,
            'last_operations' => cache()->remember('dshb.last_operations', now()->addMinutes(5), function () {
                return Transaction::with('user')->orderByDesc('created_at')->limit(10)->get();
            }),
            'currencies' => cache()->remember('dshb.currencies', now()->addHours(3), function () {
                return Currency::all();
            }),
            'payment_system' => $payment_system,
            'countries_stat' => $countries_stat,
            'device_stat' => $device_stat,
            'cities_stat' => $cities_stat,
            'payment_systems_paginate' => $payment_systems_paginate,
            'enter_transactions_for_24h_sum' => $enter_transactions_for_24h_sum,
            'withdraw_transactions_for_24h_sum' => $withdraw_transactions_for_24h_sum,
            'profit_total' => $depositTotal - $withdrawTotal,
            'salaryLeft' => $salaryLeft,
            'users' => [
                'online' => cache()->remember('dshb.users_online', now()->addMinutes(5), function () {
                    return User::where('last_activity_at', '>', now()->subSeconds(config('chats.max_idle_sec_to_be_online'))->format('Y-m-d H:i:s'))->get();
                }),
                'total' => cache()->remember('dshb.users_total', now()->addMinutes(5), function () {
                    return User::count();
                }),
                'today' => cache()->remember('dshb.users_today', now()->addMinutes(5), function () {
                    return User::where('created_at', '>', now()->subDay()->format('Y-m-d H:i:s'))->get()->count();
                }),
            ],
            'deposit_total_sum' => $depositTotal,
            'deposit_total_withdraw' => $withdrawTotal,
        ]);
    }

    public function getMonthPeriod() {
        $period = [];
        $current_week_count = now()->weekNumberInMonth;
        for ($i = 0; $i < $current_week_count; $i++) {
            if (now()->startOfMonth()->addWeek($i)->startOfWeek() < now()) {
                if (now()->startOfMonth()->addWeek($i)->startOfWeek() < now()->startOfMonth()) {
                    $period[$i]['start'] = now()->startOfMonth();
                } else {
                    $period[$i]['start'] = now()->startOfMonth()->addWeek($i)->startOfWeek();
                }
                if (now()->startOfMonth()->addWeek($i)->endOfWeek() > now()) {
                    $period[$i]['end'] = now();
                } else {
                    $period[$i]['end'] = now()->startOfMonth()->addWeek($i)->endOfWeek();
                }
            }
        }
        return $period;
    }

    public function getPreviousMonthPeriod() {
        $period = [];
        $period['start'] = now()->subMonth()->startOfMonth();
        $period['end'] = now()->subMonth()->endOfMonth();
        return $period;
    }

    public function getPreviousWeekPeriod() {
        $period = [];
        $period['start'] = now()->subWeek()->startOfWeek();
        $period['end'] = now()->subWeek()->endOfWeek();
        return $period;
    }

    public function getWeeksPeriod() {
        $period = [];
        $days = now()->dayOfWeekIso;
        if (now()->startOfWeek()->addDay() < now()) {
            for ($i = 0; $i < $days; $i++) {
                if (now()->startOfWeek()->addDay($i) < now()) {
                    $period[$i]['start'] = now()->startOfWeek()->addDay($i);
                    if (now()->startOfWeek()->addDay($i)->endOfDay() > now()) {
                        $period[$i]['end'] = now();
                    } else {
                        $period[$i]['end'] = now()->startOfWeek()->addDay($i)->endOfDay();
                    }
                }
            }
        } else {
            $period[0]['start'] = now()->startOfWeek();
            $period[0]['end'] = now();
        }
        return $period;
    }

}
