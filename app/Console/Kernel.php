<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console;

use App\Console\Commands\CheckPaymentSystemsConnectionsCommand;
use App\Console\Commands\ClearOldData;
use App\Console\Commands\CreateAdminCommand;
use App\Console\Commands\CryptoCurrencyRateLog;
use App\Console\Commands\DashboardCachesCommand;
use App\Console\Commands\DepositQueueCommand;
use App\Console\Commands\GenerateDemoDataCommand;
use App\Console\Commands\CreateRootCommand;
use App\Console\Commands\InstallScriptCommand;
use App\Console\Commands\RegisterCurrenciesCommand;
use App\Console\Commands\RegisterPaymentSystemsCommand;
use App\Console\Commands\SetRateNonFixedCurrency;
use App\Console\Commands\SetUserDocumentVerified;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        GenerateDemoDataCommand::class,
        CreateRootCommand::class,
        CreateAdminCommand::class,
        InstallScriptCommand::class,
        RegisterCurrenciesCommand::class,
        RegisterPaymentSystemsCommand::class,
        CheckPaymentSystemsConnectionsCommand::class,
        DepositQueueCommand::class,
        CryptoCurrencyRateLog::class,
        SetRateNonFixedCurrency::class,
        SetUserDocumentVerified::class,
        DashboardCachesCommand::class,
        ClearOldData::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('deposits:queue')->everyMinute()->withoutOverlapping();
        $schedule->command('make:rate_log')->hourly();
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
        $schedule->command('check:payment_systems_connections')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('update:currency_rates')->hourly();
        $schedule->command('update:non_fixed_currency_rates')->cron('*/10 * * * *');
        $schedule->command('backup:clean')->everyTwoHours();
        $schedule->command('make:backup', ['--mode' => 'only-db'])->everyTwoHours();
        $schedule->command('cache:helper')->everyMinute()->withoutOverlapping();
        $schedule->command('cache:dashboard')->everyMinute()->withoutOverlapping();
        $schedule->command('log:clear')->daily()->withoutOverlapping();
        $schedule->command('user-documents:set-verified')->everyMinute();

        $schedule->command('data:clear')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
