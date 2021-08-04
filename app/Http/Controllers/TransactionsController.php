<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class TransactionsController
 * @package App\Http\Controllers
 */
class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $filter_type = $request->get('type') ? $request->get('type') : false;
        $transactions = Transaction::when($filter_type, function($query) use ($filter_type){
            return $query->where('type_id', $filter_type);
        })->orderByDesc('created_at')->paginate(10);

        $transaction_types = TransactionType::all();

        $transactions_count = Transaction::count();

        return view('pages.transactions.index', compact(
            'transactions',
            'transaction_types',
            'transactions_count'
        ));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataTable()
    {
//        $transactions = Transaction::with('user', 'currency', 'type')
//            ->select('transactions.*');
//
//        return Datatables::of($transactions)
//            ->addColumn('type_name', function ($transaction) {
//                return __($transaction->type->name);
//            })->editColumn('amount', function ($transaction) {
//                return number_format($transaction->amount, $transaction->currency->precision, '.', '');
//            })
//            ->make(true);
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
