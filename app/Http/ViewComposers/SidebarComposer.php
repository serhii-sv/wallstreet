<?php

namespace App\Http\ViewComposers;

use App\Models\CloudFile;
use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SidebarComposer
{
    public function __construct()
    {
        //
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
            ->with('counts', [
                'users' => cache()->remember('counts.users', now()->addHour(), function() {
                    return \App\User::count();
                }),
                'files' => cache()->remember('counts.files', now()->addHour(), function() {
                    return CloudFile::count();
                }),
            ]);

    }
}
