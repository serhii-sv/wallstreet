<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();
        $deposits_status = [
            'Не активные' => 'false',
            'Активные' => 'true',
            'Закрываются в течении недели' => 'close_during_week',
        ];

        $filter_status = $request->get('status') ? $request->get('status') : false;
        $filter_rates = $request->get('rate') ? $request->get('rate') : false;

        $deposits = $user->deposits()->when($filter_status, function ($query) use ($filter_status) {
            if ($filter_status == 'close_during_week') {
                return $query->where('active', true)->where('datetime_closing', '<=', date('Y-m-d H:i:s', strtotime('+ 1 week')));
            } else {
                return $query->where('active', $filter_status);
            }
        })->when($filter_rates, function ($query) use ($filter_rates) {
            return $query->where('rate_id', $filter_rates);
        })->orderBy('created_at', 'desc')
            ->with('currency', 'user', 'rate', 'wallet')
            ->paginate(self::API_PAGINATION);

       return response()->json([
           'status' => 200,
           'data' => $deposits
       ], 200);
    }
}
