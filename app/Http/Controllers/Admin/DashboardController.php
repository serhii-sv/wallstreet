<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestDashboardBonusUser;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\Wallet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        
        $count_main_graph = 12;
        $weeks_main_graph = $this->getWeeksFirstDayArray($count_main_graph);
        $id_withdraw = TransactionType::where('name', 'withdraw')->first()->id;
        
        $transactions_deposit_sum = [];
        $transactions_withdraw_sum = [];
        foreach ($weeks_main_graph as $key => $week) {
            $transactions = cache()->remember('dshb.last_transactions' . $key, 60, function () use ($week) {
                return Transaction::where('approved', 1)->whereBetween('created_at', [
                    $week->format('Y-m-d H:i:s'),
                    $week->endOfWeek(),
                ])->get();
            });
            $transactions_deposit_sum[$key] = $transactions->where('type_id', '!=', $id_withdraw)->sum('main_currency_amount');
            $transactions_withdraw_sum[$key] = $transactions->where('type_id', '=', $id_withdraw)->sum('main_currency_amount');
        }
        $deposit_total_sum = array_sum($transactions_deposit_sum);
        $deposit_total_withdraw = array_sum($transactions_withdraw_sum);
        $deposit_diff = $deposit_total_sum - $deposit_total_withdraw;
    
        $payment_system = PaymentSystem::all();
        foreach ($payment_system as $item)
        {
            $item->transaction_sum = cache()->remember('dshb.payment_transactions_sum' . $item->id, 60, function () use ($item) {
                return $item->transactions_enter()->sum('main_currency_amount');
            });
            $item->transaction_minus = cache()->remember('dshb.payment_transaction_minu' . $item->id, 60, function () use ($item) {
                return $item->transactions_withdraw()->sum('main_currency_amount');
            });
        }
        return view('admin.dashboard', [
            'weeks_main_graph' => $this->getWeeksFirstDayArray($count_main_graph),
            'transactions_deposit_sum' => $transactions_deposit_sum,
            'transactions_withdraw_sum' => $transactions_withdraw_sum,
            'deposit_diff' => $deposit_diff,
            'deposit_total_sum' => $deposit_total_sum,
            'deposit_total_withdraw' => $deposit_total_withdraw,
            'last_operations' => Transaction::orderByDesc('created_at')->limit(10)->get(),
            'currencies' => Currency::all(),
            'payment_system' => $payment_system,
            'user_auth_logs' => UserAuthLog::where('is_admin', true)->orderByDesc('created_at')->limit(10)->get(),
            
        ]);
    }
    
    public function addUserBonus(RequestDashboardBonusUser $request) {
        $user = User::where('name', $request->post('user'))->orWhere('login', $request->post('user'))->orWhere('email', $request->post('user'))->first();
        $currency_id = $request->post('currency_id');
        $payment_system_id = $request->post('payment_system_id');
        $wallet = Wallet::where('user_id', $user->id)->where('currency_id', $currency_id)->where('payment_system_id', $payment_system_id)->first();
        if (empty($wallet)){
            $wallet= new Wallet();
            $wallet->user_id = $user;
            $wallet->currency_id = $currency_id;
            $wallet->payment_system_id = $payment_system_id;
        }
        $wallet = $wallet->addBonus($request->post('amount'));
        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->post('amount'),
                'currency' => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance' => $wallet->balance,
            ];
            $wallet->user->sendNotification('bonus_accrued', $data);
            return back()->with('success', __('Bonus accrued'));
        }
        return back()->with('error', __('Unable to accrue bonus'));
    }
    
    public function getWeeksFirstDayArray($count = 1) {
        $weeks = [];
        for ($i = 1, $j = 1; $count >= $i; $j++, $count--) {
            $weeks[$j] = now()->startOfWeek()->subWeek($count - 1);
        }
        return $weeks;
    }
}
