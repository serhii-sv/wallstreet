<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Console\Command;

class RateLogGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate_log:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate demo data for rate log';

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
    {\Log::critical(self::class);
        $this->comment('Crypto currency rate demo data generation started');
        $start = Carbon::now();
        $faker = Factory::create();

        $currency = Currency::where('code', 'SPRINT')->first();

        $startDate = Carbon::now()->subYear();

        while (true) {
            $currency->rateLog()->create([
                'date' => $startDate->format('Y-m-d'),
                'time' => $startDate->format('H:i:s'),
                'rate' => $faker->randomFloat(5,0.5, 1.5),
                'created_at' => $startDate->format('Y-m-d')
            ]);

            $startDate = Carbon::parse($startDate)->addDay();

            if ($startDate->gt(Carbon::now())) {
                break;
            }
        }

        $this->comment('Crypto currency rate demo data was generated after ' . Carbon::now()->diffInSeconds($start) . 's');
        return true;
    }
}
