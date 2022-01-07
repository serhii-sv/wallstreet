<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Models\DepositQueue;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MoveDepositQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move:deposit_queue {days} {date_from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move deposit queue';

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
     * @return mixed
     */
    public function handle()
    {\Log::critical(self::class);
        $days = $this->argument('days');
        $dateFrom = Carbon::parse($this->argument('date_from'));

        /** @var DepositQueue $depositQueue */
        $depositQueue = DepositQueue::where('done', 0)
            ->where('available_at', '>=', $dateFrom)
            ->get();

        /** @var DepositQueue $queue */
        foreach ($depositQueue as $queue) {
            $availableAt = Carbon::parse($queue->available_at)->addDays($days)->toDateTimeString();
            $queue->available_at = $availableAt;
            $queue->save();
            $this->info('queue '.$queue->id.' updated to date '.$queue->available_at);
        }
    }
}
