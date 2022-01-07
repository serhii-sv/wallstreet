<?php

namespace App\Console\Commands;

use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetUserDocumentVerified extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-documents:set-verified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set user document verified after 5 hours';

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
        UserVerification::where('created_at', '<=', Carbon::now()->subHours(5))
            ->where('accepted', 0)
            ->update([
                'accepted' => 1
            ]);
        return Command::SUCCESS;
    }
}
