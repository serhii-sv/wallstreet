<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Setting;
use App\Modules\Parsers\CoinmarketcapModule;
use App\Modules\Parsers\FixerModule;
use Illuminate\Console\Command;

/**
 * Class UpdateCurrencyRatesCommand
 *
 * @package App\Console\Commands
 */
class UpdateCurrencyRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency_rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all currency exchange rates.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException|\Exception
     */
    public function handle() {
        // FIAT: USD, EUR, RUR
        // CRYPTO: BTC, LTC, ETH

        $cryptoCurrencies = Currency::whereNotIn('code', [
            'USD',
            'UAH',
            'RUB',
            'EUR',
            'KZT',
        ])->get();

        /** @var Currency $currency */
        foreach ($cryptoCurrencies as $currency) {
            try {
                $response = CoinmarketcapModule::getRate(strtoupper(preg_replace('/\.(.+)/', '', $currency->code)));
            } catch (\Exception $exception) {
                $key = strtolower($currency->code) . '_to_usd';
                $currencyRate = Setting::where('s_key', $key)->first();

                if (is_null($currencyRate)) {
                    Setting::setValue($key, 0);
                    $this->comment('updated ' . $key . ' = ' . 0);
                }
            }

            if (!isset($response['data'][strtoupper($currency->code)]['quote']['USD']['price'])) {
                if (strtoupper($currency->code) == 'USD'
                    || strtoupper($currency->code) == 'USDT.TRC20'
                    || strtoupper($currency->code) == 'USDT.ERC20') {
                    $response['data'][strtoupper($currency->code)]['quote']['USD']['price'] = 1;
                }
                elseif(strtoupper($currency->code) == 'SPRINT') {
                    continue;
//                    $response['data'][strtoupper($currency->code)]['quote']['USD']['price'] = 1;
                }
                else {
                    \Log::error('Can not get rate for ' . $currency->code . ' in USD');
                    continue;
                }
            }

            $rateInUsd = (float)round($response['data'][strtoupper($currency->code)]['quote']['USD']['price'], $currency->precision);

            $key = strtolower($currency->code) . '_to_usd';
            $currencyRate = Setting::where('s_key', $key)->first();

            if (isset($currencyRate->autoupdate) && $currencyRate->autoupdate) {
                Setting::setValue($key, $rateInUsd);
                $this->comment('updated ' . $key . ' = ' . $rateInUsd);
            }

            if (is_null($currencyRate)) {
                Setting::setValue($key, $rateInUsd);
                $this->comment('updated ' . $key . ' = ' . $rateInUsd);
            }

            $key = 'usd_to_' . strtolower($currency->code);
            $currencyRate = Setting::where('s_key', $key)->first();

            if (isset($currencyRate->autoupdate) && $currencyRate->autoupdate) {
                Setting::setValue($key, 1 / $rateInUsd);
                $this->comment('updated ' . $key . ' = ' . (1 / $rateInUsd));
            }

            if (is_null($currencyRate)) {
                Setting::setValue($key, 1 / $rateInUsd);
                $this->comment('updated ' . $key . ' = ' . (1 / $rateInUsd));
            }
        }

        $fiatCurrencies = Currency::whereIn('code', [
            'USD',
            'UAH',
            'RUB',
            'EUR',
            'KZT',
        ])->get();

        /** @var Currency $currency */
        foreach ($fiatCurrencies as $currency) {
            $response = FixerModule::getRate(strtoupper($currency->code), [
                'USD',
                'UAH',
                'RUB',
                'EUR',
                'KZT',
            ]);

            if (!isset($response->rates)) {
                \Log::error('Error getting rate for ' . $currency->code);
                continue;
            }

            $response = (array)$response;
            $response['rates'] = (array)$response['rates'];

            foreach ($response['rates'] as $code => $rate) {

                $key = strtolower($currency->code) . '_to_' . strtolower($code);
                $currencyRate = Setting::where('s_key', $key)->first();

                if (isset($currencyRate->autoupdate) && $currencyRate->autoupdate) {
                    Setting::setValue($key, $rate);
                    $this->comment('updated ' . $key . ' = ' . $rate);
                }

                if (is_null($currencyRate)) {
                    Setting::setValue($key, $rate);
                    $this->comment('updated ' . $key . ' = ' . $rate);
                }

                $key = strtolower($code) . '_to_' . strtolower($currency->code);
                $currencyRate = Setting::where('s_key', $key)->first();

                if (isset($currencyRate->autoupdate) && $currencyRate->autoupdate) {
                    Setting::setValue($key, 1 / $rate);
                    $this->comment('updated ' . $key . ' = ' . (1 / $rate));
                }

                if (is_null($currencyRate)) {
                    Setting::setValue($key, 1 / $rate);
                    $this->comment('updated ' . $key . ' = ' . (1 / $rate));
                }
            }
        }
    }
}
