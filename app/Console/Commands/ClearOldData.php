<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Models\DepositQueue;
use App\Models\HttpLog;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\UserAuthLog;
use App\Models\UserGeoip;
use App\Models\UserPhoneMessages;
use Illuminate\Console\Command;

class ClearOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear old data';

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
        ActivityLog::where('created_at', '<=', now()->subMonths())->delete();
        UserAuthLog::where('created_at', '<=', now()->subMonths())->delete();
        UserGeoip::where('created_at', '<=', now()->subMonths())->delete();
        UserPhoneMessages::where('created_at', '<=', now()->subMonths())->delete();
        DepositQueue::where('done', 1)->where('created_at', '<=', now()->subWeeks())->delete();

        $notifications = Notification::where('created_at', '<=', now()->subWeeks());

        NotificationUser::whereIn('notification_id', $notifications->pluck('id')->toArray())->delete();

        $notifications->delete();

        HttpLog::where('created_at', '<=', now()->subWeeks())->delete();

        return Command::SUCCESS;
    }
}
