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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $user_id)
    {

        $transaction_types = TransactionType::all();

        $transactions_count = Transaction::count();
        $user = User::findOrFail($user_id);

        if (request()->ajax()) {
            $filter_type = $request->get('type') ? $request->get('type') : false;
            $transactions = Transaction::when($filter_type, function($query) use ($filter_type){
                return $query->where('type_id', $filter_type);
            })
                ->where('user_id', $user->id)
                ->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $transactions->count();
            $transactions->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($transactions->get() as $transaction) {
                $data[] = [
                    'type_name' => __('locale.' . $transaction->type->name) ?? 'Не указано',
                    'amount' => view('pages.transactions.partials.amount', compact('transaction'))->render(),
                    'paymentSystem_name' => $operation->paymentSystem->name ?? 'Не указано',
                    'created_at' => $transaction->created_at->format('d-m-Y H:i'),
                    'actions' => view('pages.users.partials.user-transaction-actions', compact('transaction', 'user'))->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' =>  $transactions_count,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.users.user-transactions', compact(
                'transaction_types',
                'transactions_count',
                'user'
            ));
        }
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
            return redirect()->to(route('user-transactions.index', $user_id))->with('success_short', 'Транзакция успешно удалена.');
        }
        return back()->with('error_ырщке', __('ERROR:').' Транзакция не была удалена.');
    }
}
