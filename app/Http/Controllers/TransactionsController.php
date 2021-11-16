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
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $transaction_types = TransactionType::all();

        $transactions_count = Transaction::count();
        if (request()->ajax()) {
            $filter_type = $request->get('type') ? $request->get('type') : false;
            $transactions = Transaction::when($filter_type, function($query) use ($filter_type){
                return $query->where('type_id', $filter_type);
            })->orderBy('created_at', 'desc');

            $recordsFiltered = $transactions->count();
            $transactions->limit($request->length)->offset($request->start);
            $data = [];

            /** @var Transaction $transaction */
            foreach ($transactions->get() as $transaction) {
                $data[] = [
                    'id' => view('pages.transactions.partials.id', compact('transaction'))->render(),
                    'email' => view('pages.transactions.partials.email', compact('transaction'))->render(),
                    'user_email' => view('pages.transactions.partials.user-email', compact('transaction'))->render(),
                    'type_name' => __('locale.' . $transaction->type->name) ?? 'Не указано',
                    'amount' => view('pages.transactions.partials.amount', compact('transaction'))->render(),
                    'paymentSystem_name' => $transaction->paymentSystem->name ?? $transaction->currency->code,
                    'created_at' => $transaction->created_at->format('d-m-Y H:i:s'),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' =>  $transactions_count,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.transactions.index', compact(
                'transaction_types',
                'transactions_count'
            ));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.transactions.show', [
            'transaction' => $transaction
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        \Log::error(auth()->user()->login.' deleted transaction '.$transaction->id.' with type '.$transaction->type->name);

        if ($transaction->delete()) {
            return redirect()->to(route('transactions.index'))->with('success_short', 'Транзакция успешно удалена.');
        }
        return back()->with('error', __('ERROR:').' Транзакция не была удалена');
    }
}
