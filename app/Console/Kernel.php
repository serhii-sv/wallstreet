<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console;

use App\Console\Commands\CheckPaymentSystemsConnectionsCommand;
use App\Console\Commands\CreateAdminCommand;
use App\Console\Commands\CryptoCurrencyRateLog;
use App\Console\Commands\DepositQueueCommand;
use App\Console\Commands\GenerateDemoDataCommand;
use App\Console\Commands\CreateRootCommand;
use App\Console\Commands\InstallScriptCommand;
use App\Console\Commands\RegisterCurrenciesCommand;
use App\Console\Commands\RegisterPaymentSystemsCommand;
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
        CryptoCurrencyRateLog::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Logs
        $schedule->command('log:clear')->daily()->withoutOverlapping();
        $schedule->command('make:rate_log')->daily();

        // Jobs
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        // Financial
        $schedule->command('check:payment_systems_connections')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('deposits:queue')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('update:currency_rates')->cron('*/30 * * * * *');

        // Backups
//        $schedule->command('backup:clean')->hourly();
        $schedule->command('make:backup', ['--mode' => 'only-db'])->everyTwoHours();
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
