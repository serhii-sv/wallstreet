<?php


namespace App\Http\ViewComposers;


use App\Models\CloudFile;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view) {
        if (Auth::check()) {
            $view->with('counts', [
                'notifications' => \App\Models\NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->count(),
            ]);
            $view->with('navbar_notifications', \App\Models\NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->get());
        }
        
    }
}