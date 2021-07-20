<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionType;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.dashboard');
    }
    
    public function indexNew() {
        $count_main_graph = 12;
        $weeks_main_graph = $this->getWeeksFirstDayArray($count_main_graph);
        $id_withdraw = TransactionType::where('name', 'withdraw')->first()->id;
      
        $transactions_deposit_sum = [];
        $transactions_withdraw_sum = [];
        
        foreach ($weeks_main_graph as $key => $week){
            $transactions = Transaction::where('approved', 1)->whereBetween('created_at', [$week->format('Y-m-d H:i:s'), $week->endOfWeek()])->get();
            $transactions_deposit_sum[$key] = $transactions->where('type_id', '!=', $id_withdraw)->sum('main_currency_amount');
            $transactions_withdraw_sum[$key] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }
        $deposit_total_sum = array_sum($transactions_deposit_sum);
        $deposit_total_withdraw = array_sum($transactions_withdraw_sum);
        $deposit_diff =  $deposit_total_sum - $deposit_total_withdraw;
        
      
        return view('admin.dashboard-new', [
            'weeks_main_graph' => $this->getWeeksFirstDayArray($count_main_graph),
            'transactions_deposit_sum' => $transactions_deposit_sum,
            'transactions_withdraw_sum' => $transactions_withdraw_sum,
            'deposit_diff' => $deposit_diff,
            'deposit_total_sum' => $deposit_total_sum,
            'deposit_total_withdraw' => $deposit_total_withdraw,
            'last_operations' => Transaction::orderByDesc('created_at')->limit(10)->get(),
        ]);
    }
    
    public function getWeeksFirstDayArray($count = 1) {
        $weeks = [];
        for ($i = 1, $j = 1; $count >= $i; $j++, $count--) {
            $weeks[$j] = now()->startOfWeek()->subWeek($count - 1);
        }
        return $weeks;
    }
}
