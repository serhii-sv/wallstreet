<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Deposit;
use App\Models\DepositBonus;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class DepositController
 *
 * @package App\Http\Controllers
 */
class DepositController extends Controller
{
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $deposits_status = [
            'Не активные' => 'false',
            'Активные' => 'true',
            'Закрываются в течении недели' => 'close_during_week',
        ];
        $deposits_count = Deposit::count();
        
        if (request()->ajax()) {
            
            $filter_status = $request->get('status') ? $request->get('status') : false;
            $filter_rates = $request->get('rate') ? $request->get('rate') : false;
            $deposits = Deposit::when($filter_status, function ($query) use ($filter_status) {
                if ($filter_status == 'close_during_week') {
                    return $query->where('active', true)->where('datetime_closing', '<=', date('Y-m-d H:i:s', strtotime('+ 1 week')));
                } else {
                    return $query->where('active', $filter_status);
                }
            })->when($filter_rates, function ($query) use ($filter_rates) {
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
                    'id' => view('pages.deposits.partials.id', compact('deposit'))->render(),
                    'email' => view('pages.deposits.partials.email', compact('deposit'))->render(),
                    'invested' => "$ " . number_format($deposit->invested, 2, '.', ',') ?? 0 ?? 'Не указано',
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
                'data' => $data,
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
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id) {
        $deposit = Deposit::findOrFail($id);
        return view('pages.deposits.show', ['deposit' => $deposit]);
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $deposit = Deposit::findOrFail($id);
        if ($deposit->delete()) {
            return redirect()->to(route('deposits.index'))->with('success_short', 'Депозит успешно удалена.');
        }
        return back()->with('error', __('ERROR:') . ' Депозит не была удалена');
    }
    
    public function showBonuses() {
        $deposit_turnovers = DepositBonus::orderBy('personal_turnover', 'asc')->get();
        return view('pages.deposits.bonuses', compact('deposit_turnovers'));
    }
    
    public function setBonus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $rules = [
                'status_name' => 'required|string',
                'status_stage' => 'required|string',
                'personal_turnover' => 'required|numeric',
                'total_turnover' => 'required|numeric',
                'reward' => 'required|numeric',
            ];
            
            $id = $request->post('id');
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $messages = 'Ошибка! ' . $request->post('status_name') . ' - ' . $request->post('status_stage') . ' не изменён! <br>';
                foreach ($validator->getMessageBag()->toArray() as $message) {
                    foreach ($message as $item) {
                        $messages .= $item . '<br>';
                    }
                }
                return json_encode([
                    'status' => 'bad',
                    'msg' => $messages,
                ]);
            }
            
            $deposit_bonus = DepositBonus::where('id', $id)->first();
            $deposit_bonus->update($request->post());
            
            return json_encode([
                'status' => 'good',
                'msg' => $request->post('status_name') . ' - ' . $request->post('status_stage') . ' is updated!',
            ]);
        }
    }
    
    public function addBonus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $rules = [
                'status_name' => 'required|string',
                'status_stage' => 'required|string',
                'personal_turnover' => 'required|numeric',
                'total_turnover' => 'required|numeric',
                'reward' => 'required|numeric',
            ];
            
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $messages = 'Ошибка! Бонус не добавлен! <br>';
                foreach ($validator->getMessageBag()->toArray() as $message) {
                    foreach ($message as $item) {
                        $messages .= $item . '<br>';
                    }
                }
                return json_encode([
                    'status' => 'bad',
                    'msg' => $messages,
                ]);
            }
        
            $deposit_bonus = new DepositBonus();
            $deposit_bonus->create($request->post());
        
            return json_encode([
                'status' => 'good',
                'msg' => 'Bonus added!',
                'id' => $deposit_bonus->id,
            ]);
        }
    }
    
    public function deleteBonus(Request $request) {
        $deposit_bonus = DepositBonus::where('id', $request->post('id'))->first();
        $deposit_bonus->delete();
    
        return json_encode([
            'status' => 'good',
            'msg' => 'Bonus deleted!',
        ]);
    }
}
