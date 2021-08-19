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
            })->orderBy('created_at', 'desc');

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
                    'invested' => "$ " . number_format($deposit->invested, 0, '.', ',') ?? 0  ?? 'Не указано',
                    'total_assessed' => view('pages.deposits.partials.total-assessed', compact('deposit'))->render(),
                    'remains_to_accrue' => '?',
                    'next_charge' => '?',
                    'created_at' => $deposit->created_at->format('d-m-Y'),
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
     * @param Deposit $deposit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Deposit $deposit)
    {
        return view('pages.deposits.show', ['deposit' => $deposit]);
    }
}
