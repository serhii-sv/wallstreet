<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Models\PaymentSystem;
use Illuminate\Console\Command;

/**
 * Class CheckPaymentSystemsConnectionsCommand
 * @package App\Console\Commands
 */
class CheckPaymentSystemsConnectionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payment_systems_connections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking payment system connection. And saving result in the DB.';

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
     * @return void
     */
    public function handle()
    {
        foreach (PaymentSystem::all() as $ps) {
            $this->info('Checking: '.$ps->name);

            $oldStatus = $ps->connected;

            if (!$ps->getClassName()) {
                $er = 'Can not reach class name for: ' . $ps->name;
                $this->warn($er);

                if ($ps->connected == 0 && $oldStatus == 1) {
                    \Log::critical($er);
                }
                continue;
            }
            try {
                $ps->getClassName()::getBalances();
                $this->info($ps->name.' successfully connected');
            } catch (\Exception $e) {
                $er = 'Can not connect to ' . $ps->name . ', error message: ' . $e->getMessage();
                $this->warn($er);

                if ($ps->connected == 0 && $oldStatus == 1) {
                    \Log::critical($er);
                }
                if ($ps->connected == 1 && $oldStatus == 0) {
                    \Log::info($er);
                }
            }

            $this->line('');
        }
    }
}
