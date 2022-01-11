<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console;

use App\Console\Commands\CalculateSalaryCommand;
use App\Console\Commands\CheckPaymentSystemsConnectionsCommand;
use App\Console\Commands\CleanPartnerTransactionsCommand;
use App\Console\Commands\ClearOldData;
use App\Console\Commands\CreateAdminCommand;
use App\Console\Commands\CryptoCurrencyRateLog;
use App\Console\Commands\DashboardCachesCommand;
use App\Console\Commands\DepositQueueCommand;
use App\Console\Commands\GenerateDemoDataCommand;
use App\Console\Commands\CreateRootCommand;
use App\Console\Commands\HandleWithdrawalCommand;
use App\Console\Commands\InstallScriptCommand;
use App\Console\Commands\MoveDepositQueueCommand;
use App\Console\Commands\RegisterCurrenciesCommand;
use App\Console\Commands\RegisterPaymentSystemsCommand;
use App\Console\Commands\SetRateNonFixedCurrency;
use App\Console\Commands\SetUserDocumentVerified;
use App\Console\Commands\TransactionDontCountCommand;
use App\Console\Commands\TransactionTeamleaderCommand;
use App\Console\Commands\UpdateZeroAmountTransactionsCommand;
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
        ClearOldData::class,
        CalculateSalaryCommand::class,
        MoveDepositQueueCommand::class,
        TransactionTeamleaderCommand::class,
        UpdateZeroAmountTransactionsCommand::class,
        TransactionDontCountCommand::class,
        CleanPartnerTransactionsCommand::class,
        HandleWithdrawalCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('deposits:queue')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('handle:withdrawals')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('transaction:teamleaders')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('calculate:salaries')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('make:rate_log')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('horizon:snapshot')
            ->everyFiveMinutes()
            ->runInBackground();
        $schedule->command('check:payment_systems_connections')
            ->everyTenMinutes()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('update:currency_rates')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('update:non_fixed_currency_rates')
            ->runInBackground()
            ->cron('*/10 * * * *');
        $schedule->command('backup:clean')
            ->everyTwoHours()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('make:backup', ['--mode' => 'only-db'])
            ->runInBackground()
            ->everyTwoHours();
        $schedule->command('cache:helper')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('cache:dashboard')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('log:clear')
            ->daily()
            ->runInBackground()
            ->withoutOverlapping();
//        $schedule->command('user-documents:set-verified')
//            ->everyMinute()
//            ->runInBackground()
//            ->withoutOverlapping();
        $schedule->command('update:zero_transactions')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('transactions:dont_count')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('clean:partner_transactions')
            ->everyMinute()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('data:clear')
            ->daily()
            ->withoutOverlapping();
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
