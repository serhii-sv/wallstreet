<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateDeposit;
use App\Http\Requests\RequestReinvestDeposit;
use App\Models\Deposit;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Wallet;
use ATehnix\VkClient\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepositsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('profile.deposits.index');
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request) {
        $rate = $request->has('rate_id') ? Rate::with('currency')->where('id', $request->rate_id)->first() : null;
        
        if (null !== $rate) {
            $rate = $rate->toArray();
        }
        
        return view('profile.deposits.create', [
            'rate' => $rate,
        ]);
    }
    
    /**
     * @param RequestCreateDeposit $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(RequestCreateDeposit $request) {
        try {
            Deposit::addDeposit($request->all());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->route('profile.deposits')->with('success', __('Deposit has been created'));
    }
    
    /**
     * @param null $active
     *
     * @return mixed
     * @throws \Exception
     */
    public function dataTable($active = null) {
        $deposits = cache()->tags('userDeposits.' . getUserId())->remember('c.' . getUserId() . '.userDeposits.active-' . $active, getCacheCLifetime('userDeposits'), function () use ($active) {
            $deposits = Deposit::where('user_id', getUserId());
            
            if (null !== $active) {
                $deposits = $deposits->where('active', $active);
            }
            
            return $deposits->with([
                'transactions',
                'user',
                'rate',
                'wallet',
                'paymentSystem',
            ])->get();
        });
        
        return DataTables::of($deposits)->editColumn('condition', function ($deposit) {
            return __($deposit->condition);
        })->editColumn('closing_at', function ($deposit) {
            return Carbon::parse($deposit->created_at)->addDays($deposit->duration)->toDateString();
        })->make(true);
    }
    
    public function show() {
        //
    }
    
    public function showReinvestPage($id) {
        return view('profile.deposits.reinvest', [
            'id' => $id,
            'deposit' => Deposit::findOrFail($id),
        ]);
    }
    
    public function reinvest(RequestReinvestDeposit $request, $id) {
        $user_id = auth()->user()->id;
        $amount = $request->get('amount');
        $deposit = Deposit::find($id);
        $wallet = Wallet::where('id',$deposit->wallet_id)->where('user_id', $user_id)->firstOrFail();
        
        if ($wallet->balance < $amount) {
            return redirect()->back()->withErrors([__('Insufficient funds!')]);
        }
        
        $deposit->balance += $amount;
        $deposit->invested += $amount;
        $wallet->balance -= $amount;
    
        $transaction_type = TransactionType::where('name', 'reinvest')->first();
        
        $transaction = new Transaction();
        $transaction->type_id = $transaction_type->id;
        $transaction->user_id = $user_id;
        $transaction->currency_id = $deposit->currency_id;
        $transaction->rate_id = null;
        $transaction->deposit_id = $deposit->id;
        $transaction->wallet_id = $wallet->id;
        $transaction->payment_system_id = null;
        $transaction->amount = $amount;
        $transaction->main_currency_amount = 0;
        $transaction->source = null;
        $transaction->result = null;
        $transaction->batch_id = null;
        $transaction->commission = $transaction_type->commision;
        $transaction->approved = true;
        
        $transaction->save();
        $deposit->save();
        $wallet->save();
        
        return redirect()->back()->with('success', __('Reinvestment successful!'));
    }
}
