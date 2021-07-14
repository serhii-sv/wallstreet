<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

use Twilio\Rest\Client;

/**
 * @param $number
 * @param $text
 * @return bool|\Twilio\Rest\Api\V2010\Account\MessageInstance
 * @throws \Twilio\Exceptions\ConfigurationException
 *
 * TODO: twilio have to be as module
 */
function sendSmsTwilio($number, $text)
{
    // Your Account SID and Auth Token from twilio.com/console
    $sid = config('sms.set_twilio_sid');
    $token = config('sms.set_twilio_token');
    $client = new Client($sid, $token);
    $purchasedTwilioNumber = config('sms.set_twilio_number');

    try {
        return $client->messages->create(
            $number,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $purchasedTwilioNumber,
                'body' => $text
            ]
        );
    } catch(Exception $e) {
        return false;
    }
}

/**
 * @param string $currencyId
 * @param float $value
 * @return float
 * @throws Exception
 */
function currencyPrecision(string $currencyId, float $value): float
{
    $precision = cache()->tags(['currency', 'precision'])->rememberForever('precision_' . $currencyId, function () use ($currencyId) {
        /** @var \App\Models\Currency $currency */
        $currency = \App\Models\Currency::find($currencyId);

        return $currency->precision > 0
            ? $currency->precision
            : 2;
    });
    return round($value, $precision);
}

/**
 * @param array $keys
 * @return void
 * @throws Exception
 */
function clearCacheByArray(array $keys)
{
    foreach ($keys as $key) {
        cache()->forget($key);
    }
}

/**
 * @param array $tags
 * @return void
 * @throws Exception
 */
function clearCacheByTags(array $tags)
{
    cache()->tags($tags)->flush();
}

/**
 * @return array
 * @throws Exception
 */
function getTransactionTypes(): array
{
    return cache()->remember('h.transactionTypes', getCacheHLifetime('transactionTypes'), function() {
        return \App\Models\TransactionType::get()->toArray();
    });
}

/**
 * @return int
 */
function generateMyId(): int
{
    $maxExists = \App\Models\User::max('my_id');
    $maxExists = $maxExists > 0 ? $maxExists+1 : rand(500000, 2000000);
    return $maxExists;
}

/**
 * @param string $baseCurrency
 * @return array
 * @throws Exception
 *
 * TODO: currency rates have to be as module
 */
function currenciesRates(string $baseCurrency = 'USD'): array
{
    return cache()->tags(['currency', 'precision', 'rates'])->remember('rates_' . $baseCurrency, getCacheHLifetime('currenciesRates'), function () use ($baseCurrency) {
        $rates = \App\Models\Currency::balances();
        array_pull($rates, $baseCurrency);
        $keys = implode(",", array_keys($rates));

        try {
            $f = fopen('https://openexchangerates.org/api/latest.json?app_id=' . env('OPENEXCHANGERATES_API') . '&base=' . $baseCurrency . '&symbols=' . $keys . '&show_alternative=true', 'rb');

            if ($f) {
                $out = "";

                while (!feof($f)) {
                    $out .= fgets($f);
                }

                fclose($f);
                $out = json_decode($out, true);

                if (isset($out['rates'])) {
                    foreach ($out['rates'] as $key => $value) {
                        $rates[$key] = currencyPrecision($baseCurrency, (1 / $value));
                    }
                }
            }
        } finally {
            return $rates;
        }
    });
}

/**
 * @param string|null $key
 * @param string|null $section
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getCacheLifetime($key = null, $section = null)
{
    if (null == $key) {
        throw new Exception('Cache key is empty');
    }

    if (null == $section) {
        throw new Exception('Cache section is empty');
    }

    return now()->addMinutes(config()->get('cache.lifetimes.' . $section . '.' . $key));
}

/**
 * @param null $key
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getCacheILifetime($key = null)
{
    return getCacheLifetime($key, 'i');
}

/**
 * @param null $key
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getCacheALifetime($key = null)
{
    return getCacheLifetime($key, 'a');
}

/**
 * @param null $key
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getCacheHLifetime($key = null)
{
    return getCacheLifetime($key, 'h');
}

/**
 * @param null $key
 * @return \Carbon\Carbon
 * @throws Exception
 */
function getCacheCLifetime($key = null)
{
    return getCacheLifetime($key, 'c');
}

/**
 * @return string
 */
function getTodayLicenceFile()
{
    $today          = now()->toDateString();
    $todayTimestamp = strtotime($today);
    $indicatorFile  = $todayTimestamp.'.licence';

    return $indicatorFile;
}

/**
 * @return boolean
 */
function checkLicence()
{
//    $disk        = 'licences';
//    $licenceFile = getTodayLicenceFile();
//
//    if (isset($_SERVER['HTTP_HOST']) && preg_match('/\.(test|develop)/', $_SERVER['HTTP_HOST'])) {
//        return true;
//    }
//
//    return \Illuminate\Support\Facades\Storage::disk($disk)->exists($licenceFile);
    return true;
}

/**
 * @return string
 */
function getSupervisorName()
{
    return preg_replace('/ /', '-', env('APP_NAME', 'supervisor-1'));
}

/**
 * @param \App\Models\Transaction $enterTransaction
 * @return bool
 * @throws Exception
 */
function autocreatedeposit(\App\Models\Transaction $enterTransaction)
{
    $user = $enterTransaction->user;
    $wallet = $enterTransaction->wallet;
    $amount = $enterTransaction->amount;

    if (null === $user || null === $wallet) {
        return false;
    }

    $lookForAutoCreateRecord = \App\Models\AutoCreateDeposit::where('user_id', $user->id)
        ->where('wallet_id', $wallet->id)
        ->where('amount', $amount)
        ->orderBy('created_at', 'desc')
        ->first();

    if (null === $lookForAutoCreateRecord) {
        return false;
    }

    $depositData = [
        'wallet_id'  => $wallet->id,
        'rate_id'    => $lookForAutoCreateRecord->rate_id,
        'amount'     => $amount,
        'reinvest'   => 0,
        'created_at' => now(),
        'user'       => $user,
    ];
    $depo = \App\Models\Deposit::addDeposit($depositData);

    if (null === $depo) {
        return false;
    }

    $lookForAutoCreateRecord->delete();

    return true;
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
