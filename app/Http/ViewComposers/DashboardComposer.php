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
        $view
            ->with('admins',
                $this->users->whereHas('roles', function ($query) {
                    $query->where(function ($query) {
                        $query->where('roles.name', '=', 'root');
                        $query->orWhere('roles.name', '=', 'admin');
                    });
                })->orderBy('last_activity_at', 'desc')->get());

    }
}
