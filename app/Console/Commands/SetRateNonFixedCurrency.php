<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetRateNonFixedCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:non_fixed_currency_rates';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $exchange_rates = ExchangeRate::all();
        if ($exchange_rates->count() > 0) {
            
            foreach ($exchange_rates as $exchange_rate) {
                $currency_rate = Setting::find($exchange_rate->rate_id);
                
                if ($currency_rate !== null) {
                    if ($exchange_rate->is_random) {
                        $rate = $exchange_rate->min_rate + mt_rand() / mt_getrandmax() * ($exchange_rate->max_rate - $exchange_rate->min_rate);
                        $rate = round($rate, 8);
                        $this->info('Текущий курс '. $currency_rate->s_key .' будет равен рандомному числу ' .$rate);
                    } else {
                        $rate = $exchange_rate->rate;
                        $this->info('Текущий курс '. $currency_rate->s_key .' будет равен ' . $rate);
                    }
                    if ($exchange_rate->date_end > Carbon::now()) {
                        if ($exchange_rate->date_start < Carbon::now()) {
                            $currency_rate->update(['s_value' => $rate]);
                            $this->info('Текущий курс '. $currency_rate->s_key .' равен ' . $rate);
                        }else{
                            $this->info('Время еще не пришло для '. $currency_rate->s_key);
                        }
                    } else {
                        $currency_rate->update(['s_value' => $exchange_rate->rate]);
                        $this->info('Время прошло для '. $currency_rate->s_key. '. Курс на текущий момент будет равен ' . $exchange_rate->rate);
                    }
                }
            }
            
        }
    }
}
