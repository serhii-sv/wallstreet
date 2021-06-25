<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

namespace App\Jobs;

use App\Models\Telegram\TelegramUsers;
use App\Models\User;
use App\Models\UserTasks\Tasks;
use App\Models\UserTasks\UserTasks;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class NotifyNewTaskJob
 * @package App\Jobs
 */
class NotifyNewTaskJob implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var User */
    protected $user;

    /** @var Tasks */
    protected $task;

    /**
     * ProposeTaskJob constructor.
     * @param User $user
     * @param Tasks $task
     */
    public function __construct(User $user, Tasks $task)
    {
        /** @var User user */
        $this->user = $user;

        /** @var Tasks task */
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        /** @var User $user */
        $user = $this->user;

        /** @var Tasks $task */
        $task = $this->task;

        if (null === $user || null === $task) {
            return '';
        }

        $checkUserTask = UserTasks::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->count();

        if ($checkUserTask > 0) {
            return '';
        }

        /** @var TelegramUsers $telegramUser */
        $telegramUser = $user->telegramUser()
            ->where('blocked_user', 0)
            ->first();

        if ($telegramUser === null) {
            return '';
        }

        $user->sendTelegramNotification('new_task', [
            'task'          => $task,
            'telegramUser'  => $telegramUser,
        ]);
    }
}