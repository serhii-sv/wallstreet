<?php


namespace App\Http\ViewComposers;


use App\Models\CloudFile;
use App\Models\Language;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view) {
        if (Auth::check()) {
            $userNotifications = \App\Models\NotificationUser::with(['notification'])
                ->where('user_id', Auth::user()->id)
                ->where('is_read', false)
                ->where('created_at', '>', now()->subDays(7))
                ->orderBy('created_at', 'desc')
                ->get();

            $view->with('counts', [
                'notifications' => $userNotifications->count(),
            ]);
            $view->with('navbar_notifications', $userNotifications);
            $view->with('navbar_languages', Language::whereIn('code', ['ru', 'en'])->get());
        }

    }
}
