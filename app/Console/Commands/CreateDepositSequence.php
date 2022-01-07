<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use App\Models\Permission;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateDepositSequence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:deposit_sequence {deposit_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create deposit sequence';

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
        $deposit_id = $this->argument('deposit_id');

        /** @var Deposit $deposit */
        $deposit = Deposit::findOrFail($deposit_id);
        $deposit->createSequence();

        $this->info('success');
    }
}
