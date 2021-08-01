<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;

use Config;
use Illuminate\Support\Str;

class Helper
{
    public static function applClasses()
    {
        // default data value
        $dataDefault = [
            'mainLayoutType' => 'vertical-modern-menu',
            'pageHeader' => false,
            'bodyCustomClass' => '',
            'navbarLarge' => true,
            'navbarBgColor' => '',
            'isNavbarDark' => null,
            'isNavbarFixed' => true,
            'activeMenuColor' => '',
            'isMenuDark' => null,
            'isMenuCollapsed' => false,
            'activeMenuType' => '',
            'isFooterDark' => null,
            'isFooterFixed' => false,
            'templateTitle' => '',
            'isCustomizer' => true,
            'defaultLanguage'=>'en',
            'largeScreenLogo' => 'images/logo/materialize-logo-color.png',
            'smallScreenLogo' => 'images/logo/materialize-logo.png',
            'isFabButton'=>false,
            'direction' => env('MIX_CONTENT_DIRECTION', 'rlt'),
        ];
        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($dataDefault, config('custom.custom'));
        // all available option of materialize template
        $allOptions = [
            'mainLayoutType' => array('vertical-modern-menu', 'vertical-menu-nav-dark', 'vertical-gradient-menu', 'vertical-dark-menu', 'horizontal-menu'),
            'pageHeader' => array(true, false),
            'navbarLarge' => array(true, false),
            'isNavbarDark' => array(null, true, false),
            'isNavbarFixed' => array(true, false),
            'isMenuDark' => array(null, true, false),
            'isMenuCollapsed' => array(true, false),
            'activeMenuType' => array('sidenav-active-square'=>'sidenav-active-square', 'sidenav-active-rounded'=>'sidenav-active-rounded', 'sidenav-active-fullwidth'=>'sidenav-active-fullwidth'),
            'isFooterDark' => array(null, true, false),
            'isFooterFixed' => array(false, true),
            'isCustomizer' => array(true, false),
            'isFabButton'=> array(false, true),
            'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
            'direction' => array('ltr'=>'ltr', 'rtl'=>'rtl'),
        ];
        //if any options value empty or wrong in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (gettype($data[$key]) === gettype($dataDefault[$key])) {
                if (is_string($data[$key])) {
                    $result = array_search($data[$key], $value);
                    if (empty($result)) {
                        $data[$key] = $dataDefault[$key];
                    }
                }
            } else {
                if (is_string($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_bool($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_null($dataDefault[$key])) {
                    is_string($data[$key]) ? $data[$key] = $dataDefault[$key] : '';
                }
            }
        }
        // if any of template logo is not set or empty is set to default logo
        if (empty($data['largeScreenLogo'])) {
            $data['largeScreenLogo'] = $dataDefault['largeScreenLogo'];
        }
        if (empty($data['smallScreenLogo'])) {
            $data['smallScreenLogo'] = $dataDefault['smallScreenLogo'];
        }
        //mainLayoutTypeClass array contain default class of body element
        $mainLayoutTypeClass = [
            'vertical-modern-menu' => 'vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns',
            'vertical-menu-nav-dark' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark 2-columns',
            'vertical-gradient-menu' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu 2-columns',
            'vertical-dark-menu' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns',
            'horizontal-menu' => 'horizontal-layout page-header-light horizontal-menu 2-columns',
        ];
        //sidenavMain array contain default class of sidenav
        $sidenavMain = [
            'vertical-modern-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible',
            'vertical-menu-nav-dark' => 'sidenav-main nav-expanded nav-lock nav-collapsible navbar-full',
            'vertical-gradient-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible gradient-45deg-deep-purple-blue sidenav-gradient ',
            'vertical-dark-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible',
            'horizontal-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible sidenav-fixed hide-on-large-only',
        ];
        //sidenavMainColor array contain sidenav menu's color class according to layout types
        $sidenavMainColor = [
            'vertical-modern-menu' => 'sidenav-light',
            'vertical-menu-nav-dark' => 'sidenav-light',
            'vertical-gradient-menu' => 'sidenav-dark',
            'vertical-dark-menu' => 'sidenav-dark',
            'horizontal-menu' => '',
        ];
        //activeMenuTypeClass array contain active menu class of sidenav according to layout types
        $activeMenuTypeClass = [
            'vertical-modern-menu' => 'sidenav-active-square',
            'vertical-menu-nav-dark' => 'sidenav-active-rounded',
            'vertical-gradient-menu' => 'sidenav-active-rounded',
            'vertical-dark-menu' => 'sidenav-active-rounded',
            'horizontal-menu' => '',
        ];
        //navbarMainClass array contain navbar's default classes
        $navbarMainClass = [
            'vertical-modern-menu' => 'navbar-main navbar-color nav-collapsible no-shadow nav-expanded sideNav-lock',
            'vertical-menu-nav-dark' => 'navbar-main navbar-color nav-collapsible sideNav-lock gradient-shadow',
            'vertical-gradient-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
            'vertical-dark-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
            'horizontal-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
        ];
        //navbarMainColor array contain navabar's color classes according to layout types
        $navbarMainColor = [
            'vertical-modern-menu' => 'navbar-dark gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'navbar-dark gradient-45deg-purple-deep-orange',
            'vertical-gradient-menu' => 'navbar-light',
            'vertical-dark-menu' => 'navbar-light',
            'horizontal-menu' => 'navbar-dark gradient-45deg-light-blue-cyan',
        ];
        //navbarLargeColor array contain navbarlarge's default color classes
        $navbarLargeColor = [
            'vertical-modern-menu' => 'gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'blue-grey lighten-5',
            'vertical-gradient-menu' => 'blue-grey lighten-5',
            'vertical-dark-menu' => 'blue-grey lighten-5',
            'horizontal-menu' => 'blue-grey lighten-5',
        ];
        //mainFooterClass array contain Footer's default classes
        $mainFooterClass = [
            'vertical-modern-menu' => 'page-footer footer gradient-shadow',
            'vertical-menu-nav-dark' => 'page-footer footer gradient-shadow',
            'vertical-gradient-menu' => 'page-footer footer',
            'vertical-dark-menu' => 'page-footer footer',
            'horizontal-menu' => 'page-footer footer gradient-shadow',
        ];
        //mainFooterColor array contain footer's color classes
        $mainFooterColor = [
            'vertical-modern-menu' => 'footer-dark gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'footer-dark gradient-45deg-purple-deep-orange',
            'vertical-gradient-menu' => 'footer-light',
            'vertical-dark-menu' => 'footer-light',
            'horizontal-menu' => 'footer-dark gradient-45deg-light-blue-cyan',
        ];
        //  above arrary override through dynamic data
        $layoutClasses = [
            'mainLayoutType' => $data['mainLayoutType'],
            'mainLayoutTypeClass' => $mainLayoutTypeClass[$data['mainLayoutType']],
            'sidenavMain' => $sidenavMain[$data['mainLayoutType']],
            'navbarMainClass' => $navbarMainClass[$data['mainLayoutType']],
            'navbarMainColor' => $navbarMainColor[$data['mainLayoutType']],
            'pageHeader' => $data['pageHeader'],
            'bodyCustomClass' => $data['bodyCustomClass'],
            'navbarLarge' => $data['navbarLarge'],
            'navbarLargeColor' => $navbarLargeColor[$data['mainLayoutType']],
            'navbarBgColor' => $data['navbarBgColor'],
            'isNavbarDark' => $data['isNavbarDark'],
            'isNavbarFixed' => $data['isNavbarFixed'],
            'activeMenuColor' => $data['activeMenuColor'],
            'isMenuDark' => $data['isMenuDark'],
            'sidenavMainColor' => $sidenavMainColor[$data['mainLayoutType']],
            'isMenuCollapsed' => $data['isMenuCollapsed'],
            'activeMenuType' => $data['activeMenuType'],
            'activeMenuTypeClass' => $activeMenuTypeClass[$data['mainLayoutType']],
            'isFooterDark' => $data['isFooterDark'],
            'isFooterFixed' => $data['isFooterFixed'],
            'templateTitle' => $data['templateTitle'],
            'isCustomizer' => $data['isCustomizer'],
            'largeScreenLogo' => $data['largeScreenLogo'],
            'smallScreenLogo' => $data['smallScreenLogo'],
            'defaultLanguage'=>$allOptions['defaultLanguage'][$data['defaultLanguage']],
            'mainFooterClass' => $mainFooterClass[$data['mainLayoutType']],
            'mainFooterColor' => $mainFooterColor[$data['mainLayoutType']],
            'isFabButton'=>$data['isFabButton'],
            'direction' => $data['direction'],
        ];
         // set default language if session hasn't locale value the set default language
         if(!session()->has('locale')){
            app()->setLocale($layoutClasses['defaultLanguage']);
        }
        return $layoutClasses;
    }
    // updatesPageConfig function override all configuration of custom.php file as page requirements.
    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        $custom = 'custom';
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set($demo . '.' . $custom . '.' . $config, $val);
                }
            }
        }
    }
}


/**
 * @param $userId |null
 *
 * @return string|null
 * @throws Exception
 */
function getAdminD3V3ReferralsTree($userId = null) {
    if (null === $userId) {
        return null;
    }

    return cache()->remember('a.' . $userId . '.d3v3ReferralsTree', now()->addHour(), function () use ($userId) {
        return json_encode(\App\Models\User::getD3V3ReferralsTree(\App\Models\User::find($userId)));
    });
}

/**
 * @return int
 * @throws Exception
 */
function getAdminWithdrawRequestsCount()
: int {
    return cache()->remember('a.withdrawRequestsCount', now()->addHour(), function () {
        /** @var \App\Models\TransactionType $transactionWithdrawalType */
        $transactionWithdrawalType = \App\Models\TransactionType::getByName('withdraw');

        return \App\Models\Transaction::where('type_id', $transactionWithdrawalType->id)->where('approved', 0)->count();
    });
}

/**
 * @param string|null $typeId
 *
 * @return int
 * @throws Exception
 */
function getAdminTransactionsCount($typeId = null)
: int {
    return cache()->remember('a.transactionsCount', getCacheALifetime('transactionsCount'), function () use ($typeId) {
        if (null !== $typeId) {
            return \App\Models\Transaction::where('type_id', $typeId)->count();
        }
        return \App\Models\Transaction::count();
    });
}

/**
 * @return array
 *
 * :)
 */
function getAdminMergeDepositedAndWithdrew()
: array {
    return [
        'deposited' => getTotalDeposited(),
        'withdrew' => getTotalWithdrew(),
    ];
}

/**
 * @param \Carbon\Carbon $date
 * @param int            $limit
 *
 * @return array
 * @throws Exception
 */
function getAdminDepositsSumClosingAtDate($date = null, $limit = 100)
: array {
    if (null == $date || (false == $date instanceof \Carbon\Carbon)) {
        return [];
    }

    return cache()->tags('depositsSumClosingAtDate')->remember('a.depositsSumClosingAtDate.' . $date . '.limit-' . $limit, getCacheALifetime('depositsSumClosingAtDate'), function () use ($date, $limit) {
        $depositsAtDate = \App\Models\Deposit::where('datetime_closing', 'like', \Carbon\Carbon::parse($date)->toDateString() . '%');
        $closingDeposits = [];
        $closingDepositsSum = [];

        foreach ($depositsAtDate as $deposit) {
            if (!isset($closingDepositsSum[$deposit->currency->code])) {
                $closingDepositsSum[$deposit->currency->code] = 0;
            }

            $closingDeposits[] = $deposit;
            $closingDepositsSum[$deposit->currency->code] += $deposit->invested;
        }
        return [
            'deposits' => $closingDeposits,
            'total' => $closingDepositsSum,
        ];
    });
}

/**
 * @return array
 * @throws Exception
 */
function getAdminPlanPopularity()
: array {
    return cache()->remember('a.plansPopularity', getCacheALifetime('plansPopularity'), function () {
        $popularity = [];
        $plans = getTariffPlans();

        foreach ($plans as $plan) {
            $depositsSum = \App\Models\Deposit::where('rate_id', $plan['id'])->count();
            $popularity[$plan['id']] = $plan;
            $popularity[$plan['id']]['depositsSum'] = $depositsSum;
        }

        return $popularity;
    });
}

/**
 * @param int    $days
 * @param string $currency
 *
 * @return array
 * @throws Exception
 */
function getAdminMoneyTrafficStatistic($days = null, $currency = null) {
    if (null === $days || null === $currency) {
        return [];
    }

    return cache()->tags('moneyTrafficStatistic')->remember('a.moneyTrafficStatistic.days-' . $days . '.currency-' . $currency, getCacheALifetime('moneyTrafficStatistic'), function () use ($days, $currency) {
        $daysArray = [];
        $currency = \App\Models\Currency::where('code', $currency)->first();
        $typeEnter = \App\Models\TransactionType::getByName('enter');
        $typeWithdraw = \App\Models\TransactionType::getByName('withdraw');

        if (null === $currency || null === $typeEnter || null === $typeWithdraw) {
            return null;
        }

        for ($i = $days; $i > 0; $i--) {
            $day = \Carbon\Carbon::now()->subDays($i);
            $daysArray[$day->format('Y-m-d')] = cache()->tags('moneyTrafficStatistic.specificDay')->rememberForever('a.moneyTrafficStatistic.days-' . $days . '.currency-' . $currency . '.date-' . $day->toFormattedDateString(), function () use ($days, $currency, $typeEnter, $typeWithdraw, $day) {
                $enter = \App\Models\Transaction::where('currency_id', $currency->id)->where('type_id', $typeEnter->id)->where('created_at', '>=', $day->format('Y-m-d') . ' 00:00:01')->where('created_at', '<=', $day->format('Y-m-d') . ' 23:59:59')->sum('amount');
                $withdrew = \App\Models\Transaction::where('currency_id', $currency->id)->where('type_id', $typeWithdraw->id)->where('created_at', '>=', $day->format('Y-m-d') . ' 00:00:01')->where('created_at', '<=', $day->format('Y-m-d') . ' 23:59:59')->sum('amount');
                return [
                    'enter' => round($enter, $currency->precision),
                    'withdrew' => round($withdrew, $currency->precision),
                ];
            });
        }
        return $daysArray;
    });
}

function canEditLang()
: bool {
    if (auth()->check() && auth()->user()->hasRole('root|admin')) {
        return true;
    }
    return false;
}

function createUserAuthLog($request, $user) {
    $user_log = new \App\Models\UserAuthLog();
    $user_log->user_id = $user->id;
    $user_log->ip = $request->ip();
    $user->hasAnyRole([
        'admin',
        'root',
    ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
    $user_log->save();
}

/**
 * @param float $amount
 * @param \App\Models\Currency $currency
 * @param string $thousands_sep
 * @return string
 */
function amountWithPrecision(float $amount, \App\Models\Currency $currency, $thousands_sep='')
{
    return round($amount, $currency->precision);
}

/**
 * @param float $amount
 * @param string $currencyCode
 * @param string $thousands_sep
 * @return string
 */
function amountWithPrecisionByCurrencyCode(float $amount, string $currencyCode, $thousands_sep='')
{
    /** @var \App\Models\Currency $currency */
    $currency = \App\Models\Currency::where('code', $currencyCode)
        ->first();

    return round($amount, $currency->precision);
}

function convertToCurrency(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
{
    if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
        return 0;
    }

    // FIAT: USD, EUR, RUB
    // CRYPTO: BTC, LTC, ETH

    $rate = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_'.strtolower($toCurrency->code));

    return amountWithPrecision($rate*$amount, $toCurrency);

}

function checkRequestOnEdit() : bool {
    if (request()->get('edit') && request()->get('edit') == 'true'){
        return true;
    }
    return false;
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
    return cache()->tags('totalAccounts')->remember('i.totalAccounts.date-' . $date, now()->addHour(), function () use ($date) {
        if (null !== $date) {
            return \App\Models\User::where('created_at', '<=', $date->format('Y-m-d') . '00:00:01')
                ->where('created_at', '>=', $date->format('Y-m-d') . '23:59:29')
                ->count();
        }
        return \App\Models\User::count();
    });
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
 * @param \Carbon\Carbon $date
 * @param int $active
 * @return int
 * @throws Exception
 */
function getDepositsCount($active = null, \Carbon\Carbon $date = null): int
{
    return cache()->tags('depositsCount')->remember('depositsCount.' . ($active ? $active : 'd') . '.date-' . $date, now()->addHour(), function () use ($active, $date) {
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
