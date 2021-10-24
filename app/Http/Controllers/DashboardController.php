<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Enums\Permissions;
use App\Http\Requests\RequestDashboardBonusUser;
use App\Models\Currency;
use App\Models\DeviceStat;
use App\Models\ExchangeRateLog;
use App\Models\PaymentSystem;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserSidebarProperties;
use App\Models\UserThemeSetting;
use App\Models\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    protected $users;
    
    public function __construct(User $users) {
        
        $this->users = $users;
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        
        $id_withdraw = TransactionType::where('name', 'withdraw')->first()->id;
        $id_enter = TransactionType::where('name', 'enter')->first()->id;
        
        $weeks_period_enter_transactions = [];
        $weeks_period_withdraw_transactions = [];
        $month_period_enter_transactions = [];
        $month_period_withdraw_transactions = [];
        
        $month_period = $this->getMonthPeriod();
        $weeks_period = $this->getWeeksPeriod();
        
        $prev_month_period = $this->getPreviousMonthPeriod();
        $prev_weeks_period = $this->getPreviousWeekPeriod();
        
        $prev_week_transactions = cache()->remember('dshb.last_prev_transactions' . $prev_weeks_period['start'], 60, function () use ($prev_weeks_period) {
            return Transaction::where('approved', 1)->whereBetween('created_at', [
                $prev_weeks_period['start'],
                $prev_weeks_period['end'],
            ])->get();
        });
        $weeks_previous_period_enter_transactions = $prev_week_transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        $weeks_previous_period_withdraw_transactions = $prev_week_transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        
        foreach ($weeks_period as $key => $week) {
            $transactions = cache()->remember('dshb.last_transactions' . $week['start'], 60, function () use ($week) {
                return Transaction::where('approved', 1)->whereBetween('created_at', [
                    $week['start'],
                    $week['end'],
                ])->get();
            });
            $weeks_period_enter_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = $transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            $weeks_period_withdraw_transactions[$week['start']->format('d M') . '-' . $week['end']->format('d M')] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }
    
   
        $payment_system = PaymentSystem::all();
        foreach ($payment_system as $item) {
            $item->transaction_sum = cache()->remember('dshb.payment_transactions_sum' . $item->id, 60, function () use ($item) {
                return $item->transactions_enter()->sum('main_currency_amount');
            });
            $item->transaction_minus = cache()->remember('dshb.payment_transaction_minus' . $item->id, 60, function () use ($item) {
                return $item->transactions_withdraw()->sum('main_currency_amount');
            });
        }
       
        $weeks_total_enter = array_sum($weeks_period_enter_transactions);
        $weeks_total_withdraw = array_sum($weeks_period_withdraw_transactions);
        $weeks_deposit_revenue = $weeks_total_enter - $weeks_total_withdraw;
        
        $curr_to_prev_week = $weeks_previous_period_enter_transactions - $weeks_previous_period_withdraw_transactions;
        $week_revenue_percent = number_format(($curr_to_prev_week / (!$weeks_deposit_revenue ? 1 : $weeks_deposit_revenue ?? 1)) * 100, 2, '.', ',');
        
        foreach ($month_period as $key => $month) {
            $transactions = cache()->remember('dshb.last_transactions' . $month['start'], 60, function () use ($month) {
                return Transaction::where('approved', 1)->whereBetween('created_at', [
                    $month['start'],
                    $month['end'],
                ])->get();
            });
            $month_period_enter_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = $transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
            $month_period_withdraw_transactions[$month['start']->format('d M') . '-' . $month['end']->format('d M')] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }
        $prev_month_transactions = cache()->remember('dshb.last_prev_transactions' . $prev_month_period['start'], 60, function () use ($prev_month_period) {
            return Transaction::where('approved', 1)->whereBetween('created_at', [
                $prev_month_period['start'],
                $prev_month_period['end'],
            ])->get();
        });
        
        $month_previous_period_enter_transactions = $prev_month_transactions->where('type_id', '=', $id_enter)->sum('main_currency_amount');
        $month_previous_period_withdraw_transactions = $prev_month_transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        
        $month_total_enter = array_sum($month_period_enter_transactions);
        $month_total_withdraw = array_sum($month_period_withdraw_transactions);
        $month_deposit_revenue = $month_total_enter - $month_total_withdraw;
        $count_countries = 5;
        $count_cities = 10;
        $countries_stat = User::where('country', '!=', null)->select(['country as name'])->groupBy(['country'])->get();
    
        $curr_to_prev_month = $month_previous_period_enter_transactions - $month_previous_period_withdraw_transactions;
        $month_revenue_percent = number_format(($curr_to_prev_month / ($month_deposit_revenue ? $month_deposit_revenue : 1)) * 100, 2, '.', ',');
        
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
        
        $device_stat = DeviceStat::orderBy('count', 'desc')->limit(5)->get();
        
        $cities_stat = User::where('city', '!=', null)->select(['city as name'])->groupBy(['city'])->get();
        $cities_stat->map(function ($city) use ($id_enter) {
            $city->count = cache()->remember('dshb.city_stat_count_' . $city->name, 60, function () use ($city) {
                return User::where('city', $city->name)->count();
            });
        });
        $cities_stat = $cities_stat->sortByDesc('count')->take($count_cities);
        
        $enter_transactions_for_24h_sum = Cache::remember('dshb.transactions.enter.for_24h', 60, function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);
        });
        
        $enter_transactions_for_today_sum = Cache::remember('dshb.transactions.enter.for_today', 60, function () {
            return Transaction::where('created_at', '>=', now()->startOfDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'enter');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);
        });
        
        $withdraw_transactions_for_24h_sum = Cache::remember('dshb.transactions.withdraw.for_24h', 60, function () {
            return Transaction::where('created_at', '>=', now()->subDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);
        });
        
        $withdraw_transactions_for_today_sum = Cache::remember('dshb.transactions.withdraw.for_today', 60, function () {
            return Transaction::where('created_at', '>=', now()->startOfDay()->format('Y-m-d H:i:s'))->where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                $query->where('name', 'withdraw');
            })->get()->reduce(function ($carry, $item) {
                return $carry + $item->main_currency_amount;
            }, 0);
        });
        
        
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
            'last_operations' => Transaction::orderByDesc('created_at')->limit(10)->get(),
            'currencies' => Currency::all(),
            'payment_system' => $payment_system,
            'user_auth_logs' => UserAuthLog::where('is_admin', true)->orderByDesc('created_at')->limit(5)->get(),
            'countries_stat' => $countries_stat,
            'device_stat' => $device_stat,
            'cities_stat' => $cities_stat,
            'enter_transactions_for_24h_sum' => $enter_transactions_for_24h_sum,
            'withdraw_transactions_for_24h_sum' => $withdraw_transactions_for_24h_sum,
            'profit_transactions_for_24h_sum' => $enter_transactions_for_24h_sum - $withdraw_transactions_for_24h_sum,
            'profit_transactions_for_today_sum' => $enter_transactions_for_today_sum - $withdraw_transactions_for_today_sum,
            'users' => [
                'online' => $this->users->where('last_activity_at', '>', now()->subSeconds(config('chats.max_idle_sec_to_be_online'))->format('Y-m-d H:i:s'))->get(),
                'total' => $this->users->all()->count(),
                'today' => $this->users->where('created_at', '>', now()->subDay()->format('Y-m-d H:i:s'))->get()->count(),
            ],
            'deposit_total_sum' => Cache::remember('dshb.transactions.enter.total', 60, function () {
                return Transaction::where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                    $query->where('name', 'enter');
                })->get()->reduce(function ($carry, $item) {
                    return $carry + $item->main_currency_amount;
                }, 0);
            }),
            'deposit_total_withdraw' => Cache::remember('dshb.transactions.withdraw.total', 60, function () {
                return Transaction::where('approved', '=', 1)->whereNotNull('payment_system_id')->whereHas('type', function ($query) {
                    $query->where('name', 'withdraw');
                })->get()->reduce(function ($carry, $item) {
                    return $carry + $item->main_currency_amount;
                }, 0);
            }),
        ]);
    }
    
    /**
     * @param RequestDashboardBonusUser $request
     */
    public function addUserBonus(RequestDashboardBonusUser $request) {
        /** @var Currency $currency */
        $currency = Currency::findOrFail($request->currency);
        
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = PaymentSystem::findOrFail($request->payment_system);
        
        /** @var User $user */
        $user = User::where(function ($q) use ($request) {
            $q->where('email', $request->login)->orWhere('login', $request->login);
        })->first();
        
        if (null === $user) {
            return back()->with('error', 'Пользователь не найден')->withInput();
        }
        
        $type = $request->type;
        
        $currencyPaymentSystem = $currency->paymentSystems()->where('payment_system_id', $paymentSystem->id)->first();
        
        if (null === $currencyPaymentSystem) {
            return back()->with('error', 'Эта платежная система не поддерживает валюту ' . $currency->code)->withInput();
        }
        
        /** @var TransactionType $transactionType */
        $transactionType = TransactionType::where('name', $type)->firstOrFail();
        
        /** @var Wallet $wallet */
        $wallet = $user->wallets()->where('currency_id', $currency->id)->where('payment_system_id', $paymentSystem->id)->first();
        
        if (null === $wallet) {
            return back()->with('error', 'Кошелек пользователя не найден')->withInput();
        }
        
        $amount = abs((float)$request->amount);
        
        $data = [
            'type_id' => $transactionType->id,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'rate_id' => null,
            'deposit_id' => null,
            'wallet_id' => $wallet->id,
            'payment_system_id' => $paymentSystem->id,
            'amount' => $amount,
            'source' => auth()->user()->email,
            'result' => null,
            'batch_id' => null,
            'approved' => 1,
            'is_real' => $request->is_real == 1,
        ];
        
        DB::transaction(function () use ($data, $wallet, $type) {
            Transaction::create($data);
            
            switch ($type) {
                case "enter":
                    $wallet->balance += $data['amount'];
                    break;
                
                case "withdraw":
                    $wallet->balance -= $data['amount'];
                    break;
            }
            
            $wallet->save();
        });
        
        return back()->with('success', 'Операция успешно проведена');
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
