<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['pages.sidebar.right-sidebar'], 'App\Http\ViewComposers\DashboardComposer'
        );
        View::composer(['panels.scripts'], 'App\Http\ViewComposers\UserGeoipComposer');
        View::composer(
            ['panels.sidebar'], 'App\Http\ViewComposers\SidebarComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
