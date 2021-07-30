<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var User
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param User $users
     * @return void
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $admin_users_qbuilder = $this->users->whereHas('roles', function ($query) {
            $query->where(function ($query) {
                $query->whereIn('roles.name', ['root', 'admin']);
            });
        });

        $common_users_qbuilder = $this->users->whereHas('roles', function ($query) {
            $query->where(function ($query) {
                $query->whereNotIn('roles.name', ['root', 'admin']);
            });
        });

        $view
            ->with('admin_users',
                [
                    'users' => $admin_users_qbuilder
                        ->orderBy('last_activity_at', 'desc')
                        ->get(),
                    'online' => $admin_users_qbuilder
                        ->where('last_activity_at', '>', Carbon::now()
                            ->subSeconds(config('chats.max_idle_sec_to_be_online'))
                            ->format('Y-m-d H:i:s')
                        )->get()->count()
                ])
            ->with('common_users',
                [
                    'users' => $common_users_qbuilder
                        ->orderBy('last_activity_at', 'desc')
                        ->get(),
                    'online' => $common_users_qbuilder
                        ->where('last_activity_at', '>', Carbon::now()
                            ->subSeconds(config('chats.max_idle_sec_to_be_online'))
                            ->format('Y-m-d H:i:s')
                        )->get()->count()
                ]);

    }
}