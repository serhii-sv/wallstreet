<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * Class DepositController
 * @package App\Http\Controllers
 */
class DepositController extends Controller
{

    public function index(Request $request)
    {
        $deposits_status = ['Не активные' => 'false', 'Активные' => 'true'];
        $deposits_count = Deposit::count();
        $filter_status = $request->get('status') ? $request->get('status') : false;
        $deposits = Deposit::when($filter_status, function($query) use ($filter_status){
            return $query->where('active', $filter_status);
        })->orderByDesc('created_at')->paginate(10);
        return view('pages.deposits.index', [
            'deposits' => $deposits,
            'deposits_count' => $deposits_count,
            'deposits_status' => $deposits_status,
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataTable()
    {
        $deposits = Deposit::with('user', 'rate', 'currency')
            ->select('deposits.*');

        return Datatables::of($deposits)
            ->editColumn('condition', function ($deposit) {
                return __($deposit->condition);
            })->editColumn('invested', function ($deposit) {
                return number_format($deposit->invested, $deposit->currency->precision, '.', '');
            })
            ->make(true);
    }

    /**
     * @param Deposit $deposit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Deposit $deposit)
    {
        
        return view('pages.deposits.show', ['deposit' => $deposit]);
    }

    /**
     * @param Deposit $deposit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Deposit $deposit)
    {
        return $deposit->block()
            ? back()->with('success', __('Blocked'))
            : back()->with('error', __('Unable to block'));
    }

    /**
     * @param Deposit $deposit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock(Deposit $deposit)
    {
        return $deposit->unblock()
            ? back()->with('success', __('Unblocked'))
            : back()->with('error', __('Unable to unblock'));
    }
}
