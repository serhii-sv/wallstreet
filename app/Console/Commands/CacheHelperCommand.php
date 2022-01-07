<?php

namespace App\Console\Commands;

use App\Http\Controllers\DashboardController;
use App\Models\DeviceStat;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:helper {login?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache helper';

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
        $this->referralsCache();
    }

    private function referralsCache()
    {
        $login = $this->argument('login');
        $users = User::where(null);

        if (!empty($login)) {
            $users = $users->where('login', $login);
        }

        $users = $users->orderBy('referrals_invested_total', 'desc')->get();

        /** @var User $user */
        foreach ($users as $user) {
            $this->info('cache for '.$user->login);

            cache()->remember('user.referrals_' . $user->id, 180, function () use ($user) {
                return $user->getAllReferralsInArray(1, 1000);
            });
        }
    }
}
