<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    /**
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $filter_type = $request->get('type') ? $request->get('type') : false;
        $transactions = Transaction::when($filter_type, function($query) use ($filter_type){
            return $query->where('type_id', $filter_type);
        })
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        $transaction_types = TransactionType::all();

        $transactions_count = Transaction::where('user_id', $user->id)->count();

        return view('pages.users.user-transactions', compact(
            'transactions',
            'transaction_types',
            'transactions_count',
            'user'
        ));
    }

    /**
     * @param $user_id
     * @param $transaction_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($user_id, $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        if ($transaction->delete()) {
            return redirect()->to(route('user-transactions.index', $user_id));
        }
        return back()->with('error', __('ERROR:').' Транзакция не была удалена');
    }
}
