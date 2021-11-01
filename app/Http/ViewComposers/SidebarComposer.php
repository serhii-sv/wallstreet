<?php

namespace App\Http\ViewComposers;

use App\Models\CloudFile;
use App\Models\CurrencyExchange;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\UserSidebarProperties;
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
        $user = auth()->user();

        $count_users = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop','count_users')->firstOrCreate(['sb_prop' => 'count_users']);
        $withdrawals_amount = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop','withdrawals_amount')->firstOrCreate(['sb_prop' => 'withdrawals_amount']);
        $replenishments_amount = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop','replenishments_amount')->firstOrCreate(['sb_prop' => 'replenishments_amount']);
        $currency_exchange_count = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop','currency_exchange_count')->firstOrCreate(['sb_prop' => 'currency_exchange_count']);
        //$count_tasks = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop','tasks')->firstOrCreate(['sb_prop' => 'tasks']);

        $view
            ->with('counts', [
                'users' => $count_users->sb_val ?? 0,
//                'files' => cache()->remember('counts.files', now()->addHour(), function() {
//                    return CloudFile::count();
//                }),
                'withdrawals_amount' => $withdrawals_amount != null ? Transaction::sidebarIndicatorsFormatting($withdrawals_amount->sb_val) : 0,
                    /*cache()->remember('counts.withdrawals_amount', now()->addHour(), function() {
                    $sum = Transaction::where('approved', 0)->where('type_id', TransactionType::getByName('withdraw')->id)->sum('main_currency_amount');
                    return Transaction::sidebarIndicatorsFormatting($sum);
                }),*/
                'replenishments_amount' => $replenishments_amount != null ? Transaction::sidebarIndicatorsFormatting($replenishments_amount->sb_val) : 0,
                /*cache()->remember('counts.replenishments_amount', now()->addHour(), function() {
                    $sum = Transaction::where('approved', 1)->where('type_id', TransactionType::getByName('enter')->id)->sum('main_currency_amount');
                    return Transaction::sidebarIndicatorsFormatting($sum);
                }),*/

//                'transactions_amount' => cache()->remember('counts.transactions_amount', now()->addHour(), function() {
//                    $sum = Transaction::sum('main_currency_amount');
//                    return Transaction::sidebarIndicatorsFormatting($sum);
//                }),
//                'deposits_active_amount' => cache()->remember('counts.deposits_active_amount', now()->addHour(), function() {
//                    $sum = Transaction::where('approved', 1)->where('type_id', TransactionType::getByName('create_dep')->id)->sum('main_currency_amount');
//                    return Transaction::sidebarIndicatorsFormatting($sum);
//                }),

                'currency_exchange_count' => $currency_exchange_count->sb_val ?? 0,
                /*cache()->remember('counts.currency_exchange_count', now()->addMinutes(30), function (){
                    return CurrencyExchange::count();
                }),*/
                'tasks' => cache()->remember('counts.tasks', now()->addMinutes(30), function (){
                    return Task::where('done', false)->count();
                }),

            ]);

    }
}
