<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;

/**
 * Class RegisterCurrenciesCommand
 * @package App\Console\Commands
 */
class RegisterCurrenciesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:currencies {demo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register all needed currencies for project';

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
            'USD' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('USD [yes|no]', 'yes'),
                'name'      => 'U.S dollars',
                'symbol'    => '$',
                'precision' => 2,
            ],
            'EUR' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('EUR [yes|no]', 'yes'),
                'name'      => 'European euros',
                'symbol'    => '€',
                'precision' => 2,
            ],
            'RUB' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('RUB [yes|no]', 'yes'),
                'name'      => 'Russian rubles',
                'symbol'    => '₽',
                'precision' => 2,
            ],
            'UAH' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('UAH [yes|no]', 'yes'),
                'name'      => 'Ukraine hryvnia',
                'symbol'    => '₴',
                'precision' => 6,
            ],
            'KZT' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('KZT [yes|no]', 'yes'),
                'name'      => 'Kazakhstani tenge',
                'symbol'    => '₸',
                'precision' => 6,
            ],
            'BTC' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('BTC "bitcoin" [yes|no]', 'yes'),
                'name'      => 'Bitcoins',
                'symbol'    => '฿',
                'precision' => 8,
                'image' => 'bitcoin.jpg'
            ],
            'LTC' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('LTC "Litecoin" [yes|no]', 'yes'),
                'name'      => 'Litecoins',
                'symbol'    => 'Ł',
                'precision' => 8,
                'image' => 'litecoin.jpg'
            ],
            'USDT.ERC20' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('USDT.ERC20" [yes|no]', 'yes'),
                'name'      => 'USDT.ERC20',
                'symbol'    => '$',
                'precision' => 8,
                'image' => 'usdt.erc20.jpg'
            ],
            'USDT.TRC20' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('USDT.TRC20" [yes|no]', 'yes'),
                'name'      => 'USDT.TRC20',
                'symbol'    => '$',
                'precision' => 8,
                'image' => 'usdt.trc20.jpg'
            ],
            'XRP' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('XRP [yes|no]', 'yes'),
                'name'      => 'XRP',
                'symbol'    => '$',
                'precision' => 8,
                'image' => 'ripple.jpg',
            ],
            'BCH' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('BCH "Bitcoin Cash" [yes|no]', 'yes'),
                'name'      => 'Bitcoin Cash',
                'symbol'    => 'Ƀ',
                'precision' => 8,
                'image' => 'bitcoin_cash.jpg',
            ],
            'ETH' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('ETH "Ether" [yes|no]', 'yes'),
                'name'      => 'Ether',
                'symbol'    => 'Ξ',
                'precision' => 8,
                'image' => 'ethereum.jpg',
            ],
            'DOGE' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('Dogecoin "DOGE" [yes|no]', 'yes'),
                'name'      => 'Dogecoin',
                'symbol'    => 'Ð',
                'precision' => 8,
                'image' => 'doge coin.jpg',
            ],
            'BNB' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('Binance Coin [yes|no]', 'yes'),
                'name'      => 'Binance Coin',
                'symbol'    => 'Ð',
                'precision' => 8,
                'image' => 'binance coin.jpg',
            ],
            'SPRINT' => [
                'answer'    => $this->argument('demo') == true ? 'yes' : $this->ask('Sprint Coin [yes|no]', 'yes'),
                'name'      => 'Sprint Token',
                'symbol'    => '',
                'precision' => 8,
            ],
        ];

        foreach ($questions as $currencyKey => $data) {
            $this->line('------');

            if ('yes' !== $data['answer']) {
                continue;
            }

            $this->info('Registering ' . $currencyKey);
            $checkExists = Currency::where('code', $currencyKey)->get()->count();

            if ($checkExists > 0) {
                $this->error($currencyKey . ' already registered.');
                continue;
            }

            $reg = Currency::create([
                'name'        => $data['name'],
                'code'        => $currencyKey,
                'symbol'      => $data['symbol'],
                'precision'   => $data['precision'],
                'currency_id' => $data['currency_id'] ?? null,
                'image' => $data['image'] ?? null,
            ]);

            if (!$reg) {
                $this->error('Can not register ' . $currencyKey);
                continue;
            }

            $this->info($currencyKey . ' registered.');
        }
    }
}
