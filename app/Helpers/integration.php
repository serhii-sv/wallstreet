<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

/**
 * Check if user is authorized.
 * @return bool
 */
function isUserAuthorized(): bool
{
    return (boolean)\Auth::user();
}

/**
 * @return \App\Models\User
 *
 */

function user()
{

    return \Auth::user();
}


function rate($first,$last)
{
    if ($first == "RUR") $first = 'RUB';
    if ($last == "RUR") $last = 'RUB';
    if($first==$last)
    {
        return 1;
    }
    $rate = \App\Models\Setting::getValue(strtolower($first).'_to_'.strtolower($last));
    return (float)$rate;
}

/**
 * @return \App\Models\Wallet
 *
 */
function mainWallet()
{
    /**
     * @var \App\Models\Wallet $wallet
     */
    $mainPs  = \App\Models\Setting::getValue('main_ps') ?? '';
    $mainCur = \App\Models\Setting::getValue('main_currency') ?? '';
    $psId    = null != \App\Models\PaymentSystem::getByCode($mainPs) ? \App\Models\PaymentSystem::getByCode($mainPs)->id : null;
    $curId   = null != \App\Models\Currency::getByCode($mainCur) ? \App\Models\Currency::getByCode($mainCur)->id : null;
    $wallet  = user()
        ->wallets()
        ->where('payment_system_id', $psId)
        ->where('currency_id', $curId)
        ->first();

    return $wallet;
}

/*
 * Non-authorized user part of helpers
 */

/**
 * How long project is active.
 *
 * @return int
 * @throws
 */
function getRunningDays(): int
{
    return cache()->remember('i.runningDays', getCacheILifetime('runningDays'), function () {
        $flag = 'created_at';
        $firstUser = \App\Models\User::select($flag)->orderBy($flag)->first();
        return \Carbon\Carbon::parse($firstUser->$flag)->diffInDays();
    });
}

/**
 * How much users was registered.
 *
 * @param \Carbon\Carbon $date
 * @return int
 * @throws
 */
function getTotalAccounts(\Carbon\Carbon $date = null): int
{
    return cache()->tags('totalAccounts')->remember('i.totalAccounts.date-' . $date, getCacheILifetime('totalAccounts'), function () use ($date) {
        if (null !== $date) {
            return \App\Models\User::where('created_at', '<=', $date->format('Y-m-d') . '00:00:01')
                ->where('created_at', '>=', $date->format('Y-m-d') . '23:59:29')
                ->count();
        }
        return \App\Models\User::count();
    });
}

/**
 * How many customers has deposits.
 *
 * @param \Carbon\Carbon $date
 * @return int
 * @throws
 */
function getActiveAccounts(\Carbon\Carbon $date = null): int
{
    return cache()->remember('i.activeAccounts', getCacheILifetime('activeAccounts'), function () use ($date) {
        $active = \App\Models\User::join('deposits', function ($join) {
            $join->on('deposits.user_id', '=', 'users.id');
        });

        if (null !== $date) {
            $active = $active->where('users.created_at', '>=', $date->format('Y-m-d') . '00:00:01')
                ->where('users.created_at', '<=', $date->format('Y-m-d') . '23:59:29');
        }

        return $active->where('deposits.active', 1)
            ->groupBy('users.id')
            ->count();
    });
}

/**
 * How much customers have invested to this project.
 *
 * @param boolean $useSymbols
 * @return array
 * @throws
 */
function getTotalDeposited($useSymbols = false)
{
    return cache()->remember('i.totalDeposited.useSymbols-' . ($useSymbols ? 'y' : 'n'), getCacheILifetime('totalDeposited'), function () use ($useSymbols) {
        $totalDeposited = [];
        $currencies = getCurrencies();
        $type = \App\Models\TransactionType::getByName('enter');

        foreach ($currencies as $currency) {
            $invested = \App\Models\Transaction::where('currency_id', $currency['id'])
                ->where('type_id', $type->id)
                ->where('approved', true)
                ->sum('amount');
            $arrayKey = true === $useSymbols ? $currency['symbol'] : $currency['code'];

            if (!isset($totalDeposited[$arrayKey])) {
                $totalDeposited[$arrayKey] = 0;
            }

            $totalDeposited[$arrayKey] += round($invested, $currency['precision']);
        }
        return $totalDeposited;
    });
}

/**
 * How much was withdrew from the project.
 *
 * @param boolean $useSymbols
 * @return array
 * @throws
 *
 * 
 */
function getTotalWithdrew($useSymbols = false)
{
    return cache()->remember('i.totalWithdrew.useSymbols-' . ($useSymbols ? 'y' : 'n'), getCacheILifetime('totalWithdrew'), function () use ($useSymbols) {
        $totalWithdrew = [];
        $currencies = getCurrencies();

        foreach ($currencies as $currency) {
            $amount = \App\Models\Transaction::join('transaction_types', function ($join) {
                $join->on('transactions.type_id', '=', 'transaction_types.id');
            });

            $amount = $amount->where('transaction_types.name', 'withdraw')
                ->where('transactions.approved', 1)
                ->where('transactions.currency_id', $currency['id'])
                ->sum('amount');

            $arrayKey = true === $useSymbols ? $currency['symbol'] : $currency['code'];

            if (!isset($totalWithdrew[$arrayKey])) {
                $totalWithdrew[$arrayKey] = 0;
            }

            $totalWithdrew[$arrayKey] += round($amount, $currency['precision']);
        }
        return $totalWithdrew;
    });
}

/**
 * All system currencies.
 *
 * @return array
 * @throws Exception
 */
function getCurrencies()
{
    return cache()->remember('i.currencies', getCacheILifetime('currencies'), function () {
        return \App\Models\Currency::get()->map(function($item) {
            return $item->toArray();
        });
    });
}

/**
 * Get all tariff plans.
 *
 * @return array
 * @throws Exception
 */
function getTariffPlans()
{
    return cache()->remember('i.tariffPlans', getCacheILifetime('tariffPlans'), function () {
        return \App\Models\Rate::with([
            'currency'
        ])
            ->orderBy('min')
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * Get all tariff plans.
 *
 * @return array
 * @throws Exception
 */
function getTariffPlansOrderByName()
{
    return cache()->remember('i.tariffPlansOrderByName', getCacheILifetime('tariffPlans'), function () {
        return \App\Models\Rate::with([
            'currency'
        ])
            ->where('active',1)
            ->orderBy('currency_id')
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * Get all tariff plans.
 *
 * @return array
 * @throws Exception
 */
function getUniqueTariffPlans()
{
    return cache()->remember('i.tariffPlans.unique', getCacheILifetime('tariffPlans'), function () {
        return \App\Models\Rate::with([
            'currency'
        ])->select([
            'name',
            'daily',
            'overall',
            'duration',
            'payout',
            'reinvest',
            'autoclose',
            'active',
            'sort_id',
        ])
            ->where('active',1)
            ->distinct()
            ->orderBy('sort_id')
            ->get()
            ->map(function($item) {
                $item = $item->toArray();

                /** @var \App\Models\Rate $getId */
                $getId = \App\Models\Rate::where('name', $item['name'])->limit(1)->first();

                if (null !== $getId) {
                    $item['id'] = $getId->id;
                }

                return $item;
            });
    });
}

/**
 * Get tariff plans with currency rate.
 *
 * @return array
 * @throws Exception
 */
function getUniqueTariffPlansWithMinMax()
{
    return cache()->remember('i.tariffPlansWithMinMax.unique', getCacheILifetime('tariffPlans'), function () {

        $allRates = \App\Models\Rate::with('currency')->where('active',1)->orderBy('created_at')->get();
        $uniqueRates = [];

        foreach ($allRates as $rate) {
            if (isset($uniqueRates[$rate->name]['rates'])) {
                $uniqueRates[$rate->name]['rates'] = array_merge($uniqueRates[$rate->name]['rates'],
                    [
                        $rate->currency->code => [
                            'min' => $rate->min,
                            'max' => $rate->max,
                        ],
                    ]
                );
            } else {
                $uniqueRates[$rate->name] = [
                    'name' => $rate->name,
                    'daily' => $rate->daily,
                    'overall' => $rate->overall,
                    'duration' => $rate->duration,
                    'payout' => $rate->payout,
                    'reinvest' => $rate->reinvest,
                    'autoclose' => $rate->autoclose,
                    'active' => $rate->active,

                    'rates' => [
                        $rate->currency->code => [
                            'min' => $rate->min,
                            'max' => $rate->max,
                        ],
                    ],
                ];
            }
        }

        return $uniqueRates;

    });
};

/**
 * Get information about all affiliate levels.
 *
 * @return array
 * @throws Exception
 */
function getAffiliateLevels()
{
    return cache()->remember('i.affiliateLevels', getCacheILifetime('affiliateLevels'), function () {
        return \App\Models\Referral::get()->map(function($item) {
            return $item->toArray();
        });
    });
}

/**
 * Get online users with some period.
 *
 * @return int
 * @throws Exception
 */
function getVisitorsOnline(): int
{
    return cache()->remember('i.visitorsOnline', getCacheILifetime('visitorsOnline'), function () {
        $onlinePeriod = 10; // minutes
        return \App\Models\PageViews::select('user_ip')
            ->distinct()
            ->where('created_at', '>', now()->subMinutes($onlinePeriod))
            ->count(['user_ip']);
    });
}

/**
 * Get online authorized users for some period.
 *
 * @return int
 * @throws Exception
 */
function getMembersOnline(): int
{
    return cache()->remember('i.membersOnline', getCacheILifetime('membersOnline'), function () {
        $onlinePeriod = 10; // minutes
        return \App\Models\PageViews::select('user_ip')
            ->distinct()
            ->where('created_at', '>', now()->subMinutes($onlinePeriod))
            ->where('user_id', '!=', '')
            ->count(['user_ip']);
    });
}

/**
 * Last transaction datetime of update.
 *
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getLastUpdate(): \Carbon\Carbon
{
    return cache()->remember('i.lastUpdate', getCacheILifetime('lastUpdate'), function () {
        $lastUpdate = \App\Models\Transaction::select('updated_at')->orderBy('created_at', 'desc')
            ->limit(1)
            ->first();
        return !empty($lastUpdate->craeted_at) ? \Carbon\Carbon::parse($lastUpdate->created_at) : \Carbon\Carbon::now();
    });
}

/**
 * @return array
 * @throws Exception
 */
function getAllNews()
{
    return cache()->remember('i.allNews', getCacheILifetime('allNews'), function () {
        $languages = getLanguagesArray();
        $allNews = [];

        foreach ($languages as $language) {
            $allNews[$language['code']] = \App\Models\NewsLang::where('lang_id', $language['id'])->get()->map(function($item) {
                return $item->toArray();
            });
        }
        return $allNews;
    });
}

/**
 * @param int $limit
 * @return array
 * @throws Exception
 */
function getLastEarnings(int $limit = 10)
{
    return cache()->tags('lastEarnings')->remember('i.lastEarnings.limit-' . $limit, getCacheILifetime('lastEarnings'), function () use ($limit) {
        return \App\Models\Transaction::join('transaction_types', function ($join) {
            $join->on('transactions.type_id', '=', 'transaction_types.id');
        })
            ->with([
                'wallet',
                'currency',
                'paymentSystem',
                'type',
                'user',
            ])
            ->where('transaction_types.name', 'dividend')
            ->orderBy('transactions.created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @param int $limit
 * @return array
 * @throws Exception
 */
function getLastWithdraws(int $limit = 10)
{
    return cache()->tags('lastWithdrawals')->remember('i.lastWithdraws.limit-' . $limit, getCacheILifetime('lastWithdraws'), function () use ($limit) {
        return \App\Models\Transaction::join('transaction_types', function ($join) {
            $join->on('transactions.type_id', '=', 'transaction_types.id');
        })
            ->with([
                'wallet',
                'currency',
                'paymentSystem',
                'type',
                'user',
            ])
            ->where('transaction_types.name', 'withdraw')
            ->where('transactions.approved', 1)
            ->orderBy('transactions.created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @param int $limit
 * @return array
 * @throws Exception
 */
function getLastCreatedDeposits(int $limit = 10)
{
    return cache()->tags('lastCreatedDeposits')->remember('i.lastCreatedDeposits.limit-' . $limit, getCacheILifetime('lastCreatedDeposits'), function () use ($limit) {
        return \App\Models\Deposit::where('active', 1)
            ->with([
                'transactions',
                'user',
                'rate',
                'wallet',
                'paymentSystem'
            ])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @param int $limit
 * @return array
 * @throws Exception
 */
function getLastCreatedMembers(int $limit = 10)
{
    return cache()->tags('lastCreatedMembers')->remember('i.lastCreatedMembers.limit-' . $limit, getCacheILifetime('lastCreatedMembers'), function () use ($limit) {
        return \App\Models\User::with([
            'transactions',
            'wallets',
            'deposits',
        ])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @return string
 * @throws Exception
 */
function getSupportEmail()
{
    \App\Models\Setting::getValue('email');
}

/**
 * @return string
 * @throws Exception
 */
function getAdminEmail(): string
{
    return cache()->remember('i.adminEmail', getCacheILifetime('adminEmail'), function () {
        $admin = \App\Models\User::select('email')
            ->orderBy('created_at')
            ->limit(1)
            ->first();
        return isset($admin->email) && !empty($admin->email) ? $admin->email : '';
    });
}

/**
 * @return array
 * @throws Exception
 */
function getLanguagesArray()
{
    return cache()->remember('i.languagesArray', getCacheILifetime('languagesArray'), function () {
        return \App\Models\Language::get()->map(function($item) {
            return $item->toArray();
        });
    });
}

/**
 * @param \App\Models\Rate $plan
 * @param int $amount
 * @param int $duration
 * @return float|int
 */
function calculateInvestment(\App\Models\Rate $plan, $amount=0, $duration=0)
{
    $duration = $duration > 0 ? $duration : $plan->duration;
    return $amount / 100 * $plan->daily *  $duration;
}

/**
 * @return string
 * @throws Exception
 */
function getDateOfLaunch(): string
{
    return cache()->remember('i.dateOfLaunch', getCacheILifetime('dateOfLaunch'), function () {
        $flag = 'created_at';
        $firstUser = \App\Models\User::select($flag)->orderBy($flag)->first();
        return isset($firstUser->created_at) && !empty($firstUser->created_at) ? $firstUser->created_at : '';
    });
}

/**
 * Customer FAQs
 *
 * @return array
 * @throws Exception
 */
function getFaqsList()
{
    return cache()->tags('i.faqsList')->remember('i.faqsList.'.session('lang'), getCacheILifetime('faqsList'), function () {
        $lang = session()->has('lang')
            ? \App\Models\Language::where('code', session('lang'))->first()
            : \App\Models\Language::getDefault();

        return \App\Models\Faq::where('lang_id', $lang->id)
            ->with([
                'lang'
            ])
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * Customer Reviews
 *
 * @return array
 * @throws Exception
 */
function getCustomerReviews()
{
    return cache()->remember('i.customerReviews', getCacheILifetime('customerReviews'), function () {
        $lang = session()->has('lang')
            ? \App\Models\Language::where('code', session('lang'))->first()
            : \App\Models\Language::getDefault();

        return \App\Models\Reviews::where('lang_id', $lang->id)
            ->with([
                'lang'
            ])
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * Get partner information, by id which stored in the cookies.
 *
 * @return array
 * @throws
 */
function getPartnerInfoFromCookies()
{
    return cache()->remember('i.partnerInfoFromCookies.' . $_SERVER['REMOTE_ADDR'], getCacheILifetime('partnerInfoFromCookies'), function () {
        $partnerId = isset($_COOKIE['partner_id']) ? $_COOKIE['partner_id'] : null;

        if (null === $partnerId) {
            return [];
        }

        return \App\Models\User::where('my_id', $partnerId)->first()->toArray();
    });
}

/**
 * @return array
 * @throws Exception
 */
function getPaymentSystems()
{
    return cache()->remember('i.paymentSystems', getCacheILifetime('paymentSystems'), function () {
        return \App\Models\PaymentSystem::where('connected', 1)->with([
            'currencies'
        ])->get()->map(function($item) {
            return $item->toArray();
        });
    });
}

/**
 * @return float
 * @throws Exception
 */
function getEnterCommission(): float
{
    return cache()->remember('i.enterCommission', getCacheILifetime('enterCommission'), function () {
        $commission = \App\Models\TransactionType::getByName('enter')->commission;
        return null === $commission ? 0 : $commission;
    });
}

/**
 * @return bool
 * @throws Exception
 */
function loginCaptchaCanBeShown(): bool
{
    $attempts = session()->get('login_attempts');
    return $attempts >= intval(\App\Models\User::MAX_LOGIN_ATTEMPTS / 2);
}

/**
 * @param \Carbon\Carbon $date
 * @param int $active
 * @return int
 * @throws Exception
 */
function getDepositsCount($active = null, \Carbon\Carbon $date = null): int
{
    return cache()->tags('depositsCount')->remember('depositsCount.' . ($active ? $active : 'd') . '.date-' . $date, getCacheILifetime('depositsCount'), function () use ($active, $date) {
        $deposits = \App\Models\Deposit::select('*');

        if (null != $active) {
            $deposits = $deposits->where('active', $active == 'yes' ? 1 : 0);
        }

        if (null !== $date) {
            $deposits = $deposits->where('created_at', '>=', $date->format('Y-m-d') . '00:00:01')
                ->where('created_at', '<=', $date->format('Y-m-d') . '23:59:59');
        }

        return $deposits->count();
    });
}

/**
 * @param \Carbon\Carbon $date
 * @return int
 * @throws Exception
 */
function getActiveDepositsCount(\Carbon\Carbon $date = null): int
{
    return getDepositsCount('yes', $date);
}

/**
 * @param \Carbon\Carbon $date
 * @return int
 * @throws Exception
 */
function getClosedDepositsCount(\Carbon\Carbon $date = null): int
{
    return getDepositsCount('no', $date);
}

/**
 * @return array
 * @throws Exception
 */
function getTopPartner()
{
    return cache()->remember('topPartner', getCacheILifetime('topPartner'), function () {
        $top = \App\Models\User::topPartner();

        if (null == $top) {
            return [];
        }

        return $top->toArray();
    });
}

/**
 * @return mixed
 * @throws Exception
 */
function getTelegramBots()
{
    return cache()->remember('telegramBots', getCacheILifetime('telegramBots'), function () {
        return \App\Models\Telegram\TelegramBots::get()->map(function($item) {
            return $item->toArray();
        });
    });
}

/*
 * Authorized user part of helpers
 */

/**
 * @return string
 */
function getUserId()
{
    return \Auth::user()->id;
}

/**
 * @return string
 */
function getUserName()
{
    return \Auth::user()->name;
}

/**
 * @return string
 */
function getUserEmail(): string
{
    return \Auth::user()->email;
}

/**
 * @return int
 */
function getPartnerId()
{
    return \Auth::user()->partner_id;
}

/**
 * @return array
 * @throws Exception
 */
function getPartnerArray()
{
    return cache()->remember('i.' . \Auth::user()->id . '.partnerArray', getCacheILifetime('partnerArray'), function () {
        $partnerId = getPartnerId();

        if ($partnerId > 0) {
            return \App\Models\User::where('my_id', $partnerId)->first()->toArray();
        }
        return [];
    });
}

/**
 * @return string
 */
function getUserPhone()
{
    return \Auth::user()->phone;
}

/**
 * @return string
 */
function getUserSkype()
{
    return \Auth::user()->skype;
}

/**
 * @return string
 */
function getUserLogin()
{
    return \Auth::user()->login;
}

/**
 * @return string
 */
function getUserCreatedAt(): string
{
    return \Auth::user()->created_at;
}

/**
 * @return string
 */
function getUserUpdatedAt(): string
{
    return \Auth::user()->updated_at;
}

/**
 * @return string
 */
function getUserTfaToken()
{
    return \Auth::user()->tfa_token;
}

/**
 * @return string
 */
function getUserRememberToken()
{
    return \Auth::user()->remember_token;
}

/**
 * @return array
 * @throws Exception
 */
function getUserAllDeposits()
{
    return cache()->tags('userDeposits.' . getUserId())->remember('i.' . getUserId() . '.userAllDeposits', getCacheILifetime('userAllDeposits'), function () {
        return \App\Models\Deposit::where('user_id', \Auth::user()->id)
            ->with([
                'transactions',
                'user',
                'rate',
                'wallet',
                'paymentSystem'
            ])
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @return array
 * @throws Exception
 */
function getUserActiveDeposits()
{
    return cache()->tags('userDeposits.' . getUserId())->remember('i.' . getUserId() . '.userActiveDeposits', getCacheILifetime('userActiveDeposits'), function () {
        return \App\Models\Deposit::where('user_id', getUserId())
            ->with([
                'transactions',
                'user',
                'rate',
                'wallet',
                'paymentSystem'
            ])
            ->where('active', 1)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @return array
 * @throws Exception
 */
function getUserClosedDeposits()
{
    return cache()->tags('userDeposits.' . getUserId())->remember('i.' . getUserId() . '.userClosedDeposits', getCacheILifetime('userClosedDeposits'), function () {
        return \App\Models\Deposit::where('user_id', getUserId())
            ->with([
                'transactions',
                'user',
                'rate',
                'wallet',
                'paymentSystem'
            ])
            ->where('active', 0)
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @param string $type
 * @param int $approved
 * @return array
 * @throws Exception
 */
function getUserAllOperations(string $type = null, int $approved = null)
{
    return cache()->tags('userAllOperations.' . getUserId())->remember('i.' . getUserId() . '.userAllOperations.type-' . ($type != null ? $type : 'all') . '.approved-' . ($approved != null ? $approved : 'all'), getCacheILifetime('userAllOperations'), function () use ($type, $approved) {
        $userAllOperations = \App\Models\Transaction::where('transactions.user_id', \Auth::user()->id)
            ->with([
                'wallet',
                'currency',
                'paymentSystem',
                'deposit',
                'type',
                'user'
            ]);

        if (null !== $type) {
            $userAllOperations = $userAllOperations->join('transaction_types', function ($join) {
                $join->on('transactions.type_id', '=', 'transaction_types.id');
            })->where('transaction_types.name', $type);
        }

        if (null !== $approved) {
            $userAllOperations = $userAllOperations->where('approved', $approved);
        }

        return $userAllOperations->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}


function getUserAllOperationsSum(string $type = null, int $approved = null, $user_id = null)
{
    return cache()->tags('userAllOperationsSum.' . $user_id ?? getUserId())->remember('i.' . $user_id ?? getUserId() . '.userAllOperationsSum.type-' . ($type != null ? $type : 'all') . '.approved-' . ($approved != null ? $approved : 'all'), getCacheILifetime('userAllOperations'), function () use ($type, $approved, $user_id) {
        $userAllOperations = \App\Models\Transaction::where('transactions.user_id', $user_id ?? \Auth::user()->id)
            ->with([
                'wallet',
                'currency',
                'paymentSystem',
                'deposit',
                'type',
                'user'
            ]);

        if (null !== $type) {
            $userAllOperations = $userAllOperations->join('transaction_types', function ($join) {
                $join->on('transactions.type_id', '=', 'transaction_types.id');
            })->where('transaction_types.name', $type);
        }

        if (null !== $approved) {
            $userAllOperations = $userAllOperations->where('approved', $approved);
        }

        $sum = 0;

        foreach ($userAllOperations->get() as $operation)
        {
            $sum = $sum+$operation->amount*rate($operation->currency->code,'USD');

        }

        return number_format($sum,2);
    });
}

/**
 * @return array
 * @throws Exception
 */
function getUserPartnerOperations()
{
    return getUserAllOperations('partner');
}

/**
 * @param string $currencyId
 * @return array
 * @throws Exception
 */
function getUserWallets($currencyId = null)
{
    return cache()->remember('i.' . getUserId() . '.userWallets.currency-'.$currencyId, getCacheILifetime('userWallets'), function () use ($currencyId) {
        $userWallets = \App\Models\Wallet::with([
            'currency',
            'paymentSystem'
        ])->where('user_id', getUserId());

        if (null !== $currencyId) {
            $userWallets = $userWallets->where('currency_id', $currencyId);
        }

        return $userWallets->get()->map(function($item) {
            return $item->toArray();
        });
    });
}


function getUserWalletsBalancesInUSD()
{
    return cache()->remember('i.' . getUserId() . '.userWallets.balance', getCacheILifetime('userWallets'), function () {
        $balance = 0;

        $wallets = user()->wallets()->with('currency')->get();
        foreach ($wallets as $wallet) {
            $balance = $balance + $wallet->balance * rate($wallet->currency->code, 'USD');
        }

        return number_format($balance, 2);
    });
}

/**
 * @return array
 * @throws Exception
 */
function getUserWithdrawRequests()
{
    return getUserAllOperations('withdraw', 0);
}

/**
 * @return array
 * @throws Exception
 */
function getUserIps()
{
    return cache()->remember('i.' . getUserId() . '.userIps', getCacheILifetime('userIps'), function () {
        return \App\Models\PageViews::select('user_ip')
            ->distinct()
            ->where('user_id', getUserId())
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @return array
 * @throws Exception
 */
function getUserPageViews()
{
    return cache()->remember('i.' . getUserId() . '.userPagesViews', getCacheILifetime('userPagesViews'), function () {
        return \App\Models\PageViews::where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($item) {
                return $item->toArray();
            });
    });
}

/**
 * @param int $level
 * @param bool $json
 * @return array|string
 * @throws Exception
 */
function getUserReferrals(int $level = 1, bool $json = false)
{
    return cache()->tags('userReferrals.' . getUserId())->remember('i.' . getUserId() . '.' . $level . '.' . (true === $json ? 'json' : 'array') . '.userReferrals', getCacheILifetime('userReferrals'), function () use ($level, $json) {
        return \Auth::user()->getReferralsOnLevel($level, $json);
    });
}

/**
 * @param int $level
 * @param bool $json
 * @return array|string
 * @throws Exception
 */
function getUserActiveReferrals(int $level = 1, bool $json = false)
{
    return cache()->tags('userReferrals.active.' . getUserId())->remember('i.' . getUserId() . '.' . $level . '.' . (true === $json ? 'json' : 'array') . '.userReferrals', getCacheILifetime('userReferrals'), function () use ($level, $json) {
        return \Auth::user()->getReferralsOnLevel($level, $json, true);
    });
}

/**
 * @param bool $json
 * @return array
 * @throws Exception
 */
function getUserReferralsTree(bool $json = false)
{
    return cache()->tags('userReferrals.' . getUserId())->remember('i.' . getUserId() . '.' . (true === $json ? 'json' : 'array') . '.userReferralsTree', getCacheILifetime('userReferralsTree'), function () use ($json) {
        return \App\Models\User::getReferralsTree(\Auth::user(), $json);
    });
}

/**
 * Get all user balances by currency
 *
 * @param boolean $useSymbols
 * @param string $currencyId
 * @return array
 * @throws Exception
 */
function getUserBalancesByCurrency($useSymbols = false, $currencyId = null)
{
    return cache()->tags('userBalancesByCurrency.' . getUserId())->remember('i.' . getUserId() . '.useSymbols-' . ($useSymbols ? 'y' : 'n') . '.currencyId-' . ($currencyId != null ? $currencyId : 'all') . '.userBalancesByCurrency', getCacheILifetime('userBalancesByCurrency'), function () use ($useSymbols, $currencyId) {
        return \Auth::user()->getBalancesByCurrency($useSymbols, $currencyId);
    });
}

/**
 * @param \App\Models\User $user
 * @param int $level
 * @return mixed
 * @throws Exception
 */
function getUserLevels(\App\Models\User $user, int $level=1)
{
    return cache()->tags('i.getLevels')->remember('i.getLevels.user-'.$user->id, getCacheILifetime('getLevels'), function () use ($user, $level) {
        return $user->getLevels($level);
    });
}

/**
 * @param \App\Models\User $user
 * @param int $level
 * @return mixed
 * @throws Exception
 */
function getUserLevels24h(\App\Models\User $user, int $level=1)
{
    return cache()->tags('i.getLevels24h')->remember('i.getLevels24h.user-'.$user->id, getCacheILifetime('getLevels24h'), function () use ($user, $level) {
        return $user->getLevels24h($level);
    });
}

/*
 * Total function is not collapsed in one, because for the integration we have to separate it. Comfort first.
 */

/**
 * How much was invested to the project by user.
 *
 * @param boolean $useSymbols
 * @return array
 * @throws
 */
function getUserTotalDeposited($useSymbols = false)
{
    return cache()->tags('userTotalDeposited.' . getUserId())->remember('i.' . getUserId() . '.userTotalDeposited.useSymbols-' . ($useSymbols ? 'y' : 'n'), getCacheILifetime('userTotalDeposited'), function () use ($useSymbols) {
        return \Auth::user()->getTotalByTransactions($useSymbols, 'enter', 1);
    });
}

/**
 * How much was withdrawn from the project by user.
 *
 * @param boolean $useSymbols
 * @return array
 * @throws
 */
function getUserTotalWithdrawn($useSymbols = false)
{
    return cache()->tags('userTotalWithdrawn.' . getUserId())->remember('i.' . getUserId() . '.userTotalWithdrawn.useSymbols-' . ($useSymbols ? 'y' : 'n'), getCacheILifetime('userTotalWithdrawn'), function () use ($useSymbols) {
        return \Auth::user()->getTotalByTransactions($useSymbols, 'withdraw', 1);
    });
}

/**
 * How much was earned in the project by user.
 *
 * @param boolean $useSymbols
 * @return array
 * @throws
 */
function getUserTotalEarned($useSymbols = false)
{
    return cache()->tags('userTotalEarned')->remember('i.' . getUserId() . '.userTotalEarned.useSymbols-' . ($useSymbols ? 'y' : 'n'), getCacheILifetime('userTotalEarned'), function () use ($useSymbols) {
        return \Auth::user()->getTotalByTransactions($useSymbols, 'dividend', 1);
    });
}

/**
 * @return string
 */
function getUserReferralLink(): string
{
    return route('partner', [
        \Auth::user()->my_id
    ]);
}

/**
 * @return null|string
 * @throws Exception
 */
function getD3V3ReferralsTree()
{
    return getAdminD3V3ReferralsTree(getUserId());
}

