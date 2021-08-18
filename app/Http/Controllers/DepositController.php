<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\Wallet;
use App\User;
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

        if (request()->ajax()) {

            $filter_status = $request->get('status') ? $request->get('status') : false;
            $filter_rates = $request->get('rate') ? $request->get('rate') : false;
            $deposits = Deposit::when($filter_status, function($query) use ($filter_status){
                return $query->where('active', $filter_status);
            })->when($filter_rates, function($query) use ($filter_rates){
                return $query->where('rate_id', $filter_rates);
            })->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $deposits->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $deposits->count();
            $deposits->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($deposits->get() as $deposit) {
                $data[] = [
                    'user_email' => view('pages.deposits.partials.user-email', compact('deposit'))->render(),
                    'invested' => "$ " . number_format($deposit->invested, 2, '.', ',') ?? 0  ?? 'Не указано',
                    'total_assessed' => view('pages.deposits.partials.total-assessed', compact('deposit'))->render(),
                    'remains_to_accrue' => '?',
                    'next_charge' => '?',
                    'created_at' => $deposit->created_at->format('d-m-Y H:i'),
                    'actions' => view('pages.deposits.partials.actions', compact('deposit'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $deposits_count,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.deposits.index', [
                'deposits_count' => $deposits_count,
                'deposits_status' => $deposits_status,
                'deposits_rates' => Rate::all(),
            ]);
        }
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
