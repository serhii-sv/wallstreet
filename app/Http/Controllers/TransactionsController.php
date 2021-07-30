<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Yajra\Datatables\Datatables;

/**
 * Class TransactionsController
 * @package App\Http\Controllers
 */
class TransactionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.transactions.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataTable()
    {
        $transactions = Transaction::with('user', 'currency', 'type')
            ->select('transactions.*');

        return Datatables::of($transactions)
            ->addColumn('type_name', function ($transaction) {
                return __($transaction->type->name);
            })->editColumn('amount', function ($transaction) {
                return number_format($transaction->amount, $transaction->currency->precision, '.', '');
            })
            ->make(true);
    }

    /**
     * @param Transaction $transaction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', [
            'transaction' => $transaction
        ]);
    }
}
