<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\PaymentSystem;
use Illuminate\Console\Command;

/**
 * Class RegisterPaymentSystemsCommand
 * @package App\Console\Commands
 */
class RegisterPaymentSystemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:payment_systems {demo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register all needed payment systems.';

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
     * @return mixed
     */
    public function handle()
    {
        $questions = [
            'perfectmoney' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Perfect Money [yes|no]', 'yes'),
                'name' => 'Perfect Money',
                'currencies' => [
                    'USD',
                    'EUR',
                ],
                'image' => 'perfect money.jpg',
            ],
            'coinpayments' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Coinpayments [yes|no]', 'yes'),
                'name' => 'Coinpayments',
                'currencies' => [
                    'BTC',
                    'LTC',
                    'BCH',
                    'ETH',
                    'USDT.ERC20',
                    'USDT.TRC20',
                    'XRP',
                ],
                'image' => '',
            ],
           /* 'bonus' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('bonus [yes|no]', 'yes'),
                'name' => 'Bonus',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                    'BTC',
                    'LTC',
                    'BCH',
                    'ETH',
                    'USDT.ERC20',
                    'USDT.TRC20',
                    'XRP',
                    'BNB',
                    'DOGE',
                ],
                'image' => '',
            ],*/
         /*   'manual' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('manual [yes|no]', 'yes'),
                'name' => 'Manual',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                    'BTC',
                    'LTC',
                    'BCH',
                    'ETH',
                    'USDT.ERC20',
                    'USDT.TRC20',
                    'XRP',
                    'BNB',
                    'DOGE',
                ],
            ],*/
            'yandex_money' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Яндекс Деньги [yes|no]', 'yes'),
                'name' => 'Яндекс Деньги',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                'image' => 'yandex money.jpg',
            ],
            'visa_mastercard' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Visa/MasterCard [yes|no]', 'yes'),
                'name' => 'Visa/MasterCard',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'visa mastercard.jpg',
            ],
            'vtb' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('ВТБ [yes|no]', 'yes'),
                'name' => 'ВТБ',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'vtb.jpg',
            ],
            'rosbank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Росбанк [yes|no]', 'yes'),
                'name' => 'Росбанк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'rosbank.jpg',
            ],
            'paypal' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('PayPal [yes|no]', 'yes'),
                'name' => 'PayPal',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'paypal.jpg',
            ],
            'sberbank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Сбербанк [yes|no]', 'yes'),
                'name' => 'Сбербанк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'sber.jpg',
            ],
            'tinkoff' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Тинькофф [yes|no]', 'yes'),
                'name' => 'Тинькофф',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'tinkoff.jpg',
            ],
            'qiwi' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Qiwi [yes|no]', 'yes'),
                'name' => 'Qiwi',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'qiwi.jpg',
            ],
            'western_union' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Western Union [yes|no]', 'yes'),
                'name' => 'Western Union',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'western union.jpg',
            ],
            'yoomoney' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Yoomoney [yes|no]', 'yes'),
                'name' => 'ЮMoney',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'yoomoney.jpg',
            ],
            'mts_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('МТС Банк [yes|no]', 'yes'),
                'name' => 'МТС Банк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'mts bank.jpg',
            ],
            'pochta_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Почта Банк [yes|no]', 'yes'),
                'name' => 'Почта Банк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'pochta rosii.jpg',
            ],
            'monobank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Monobank [yes|no]', 'yes'),
                'name' => 'Monobank',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'monobank.jpg',
            ],
            'moneygram' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('MoneyGram [yes|no]', 'yes'),
                'name' => 'MoneyGram',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'moneygram.jpg',
            ],
            'optima_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Optima Bank [yes|no]', 'yes'),
                'name' => 'Optima Bank',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'optima bank.jpg',
            ],
            'kaspi' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Kaspi [yes|no]', 'yes'),
                'name' => 'Kaspi',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'kaspi.jpg',
            ],
            'alfabank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('АльфаБанк [yes|no]', 'yes'),
                'name' => 'АльфаБанк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'alfa bank.jpg',
            ],
            'raiffeisen_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Райффайзен Банк [yes|no]', 'yes'),
                'name' => 'Райффайзен Банк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'raiffeisen bank.jpg',
            ],
            'advcash' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('AdvCash [yes|no]', 'yes'),
                'name' => 'AdvCash',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'advcash.jpg',
            ],
            'payeer' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Payeer [yes|no]', 'yes'),
                'name' => 'Payeer',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'payeer.jpg',
            ],
            'privatbank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('ПриватБанк [yes|no]', 'yes'),
                'name' => 'ПриватБанк',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'privat bank.jpg',
            ],
            'contact' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Contact [yes|no]', 'yes'),
                'name' => 'Contact',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'contact.jpg',
            ],
            'longjiang_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Longjiang Bank [yes|no]', 'yes'),
                'name' => 'Longjiang Bank',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'longjiang bank.jpg',
            ],
            'huishang_bank' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Huishang Bank [yes|no]', 'yes'),
                'name' => 'Huishang Bank',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'huishang bank.jpg',
            ],
            'agricultural_bank_of_china' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Agricultural Bank of China [yes|no]', 'yes'),
                'name' => 'Agricultural Bank of China',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'agricultural_bank_of_china.jpg',
            ],
            'american_express' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('American Express [yes|no]', 'yes'),
                'name' => 'American Express',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'american express.jpg',
            ],
            'otkritie' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Открытие [yes|no]', 'yes'),
                'name' => 'Открытие',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'otkritie.jpg',
            ],
            'bank_of_america' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Bank Of America [yes|no]', 'yes'),
                'name' => 'Bank Of America',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'bank of america.jpg',
            ],
            'swift' => [
                'answer' => $this->argument('demo') == true ? 'yes' : $this->ask('Swift [yes|no]', 'yes'),
                'name' => 'Swift',
                'currencies' => [
                    'USD',
                    'EUR',
                    'RUB',
                    'UAH',
                    'KZT',
                ],
                 'image' => 'swift.jpg',
            ],
        ];


        foreach ($questions as $paymentSystemCode => $data) {
            $this->line('------');

            if ('yes' !== $data['answer']) {
                continue;
            }

            $this->info('Registering ' . $paymentSystemCode);
            $checkExists = PaymentSystem::where('code', $paymentSystemCode)->get()->count();

            if ($checkExists > 0) {
                $this->error($paymentSystemCode . ' already registered.');
                continue;
            }

            $reg = PaymentSystem::create([
                'name' => $data['name'],
                'code' => $paymentSystemCode,
                'image' => $data['image'],
            ]);

            if (!$reg) {
                $this->error('Can not register ' . $paymentSystemCode);
                continue;
            }

            $this->info($paymentSystemCode . ' registered.');

            foreach ($data['currencies'] as $currency) {
                $currencyInfo = Currency::where('code', $currency)->first();

                if (empty($currencyInfo)) {
                    $this->warn('currency ' . $currency . ' is not registered, ' . $paymentSystemCode . ' will be without ' . $currency);
                    continue;
                }

                \DB::table('currency_payment_system')->insert([
                    'currency_id' => $currencyInfo->id,
                    'payment_system_id' => $reg->id,
                ]);

                $this->info('currency ' . $currency . ' registered for ' . $paymentSystemCode);
            }
        }
    }
}
