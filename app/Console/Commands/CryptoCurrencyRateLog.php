<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Console\Command;

class CryptoCurrencyRateLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rate_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create rate log';

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
        $rates = Setting::where('s_key', 'like', '%_to_%')->get();

        foreach ($rates as $rate) {
            CryptoCurrencyRateLog::setRateLog($rate);

            $this->info('Create rate log for ' . $rate->s_key);
        }

        return true;
    }
}
