<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/api/v1/graphs/sprint-token",
     *      summary="Sprint token graph data",
     *      description="Sprint token graph data",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                  @OA\Property(property="name", type="string", example="U.S dollars"),
     *                  @OA\Property(property="code", type="string", example="USD"),
     *                  @OA\Property(property="symbol", type="string", example="$"),
     *                  @OA\Property(property="precision", type="integer", example="2"),
     *                  @OA\Property(property="icon", type="string", example="http://localhost:8000/images/coins/usd.png"),
     *                  @OA\Property(property="current_rate", type="string", example="124123.123123"),
     *                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                  @OA\Property(
     *                          property="cyrrency_rate_log",
     *                          type="object",
     *                          @OA\Property(
     *                              property="day",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="week",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month3",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month6",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="year",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                                  @OA\Property(property="rate", type="string", example="200.45"),
     *                                  @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              )
     *                          ),
     *                  )
     *              ),
     *         )
     *     )
     *  )
     */
    public function sprintToken()
    {
        $currency = Currency::where('code', 'SPRINT')->first();

        $periods = [
            'day' => '1 day',
            'week' => '1 week',
            'month' => '1 month',
            'month3' => '3 months',
            'month6' => '6 months',
            'year' => '1 year'
        ];

        $data = [];

        $currency->getCoinIcon();

        $rate = Setting::where('s_key', 'like', strtolower($currency->code) . '%')->first();
        $currency->current_rate = $rate->s_value ?? 0;

       foreach ($periods as $period_label => $period_value) {
           $data[$period_label] = $currency
               ->rateLog()
               ->where('date', '>=', date('Y-m-d', strtotime( '- ' . $period_value)))
               ->orderBy('date', 'asc')
               ->get();
       }

        $currency->cyrrency_rate_log = $data;

        return response()->json([
            'status' => 200,
            'data' => $currency
        ]);
    }

    /**
     *  @OA\Get(
     *      path="/api/v1/graphs/transactions",
     *      summary="User replenishments/withdrawals transactions",
     *      description="User replenishments/withdrawals transactions",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="day", type="string", example="Tue"),
     *                  @OA\Property(property="replenishments", type="string", example="200.000"),
     *                  @OA\Property(property="withdrawals", type="string", example="200.000"),
     *              ),
     *            )
     *         )
     *     )
     *  )
     */
    public function transactions(Request $request)
    {
        $user = $request->user();

        $transactionsData = [];

        for($i = 7; $i > 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $transactionReplenishmentType = TransactionType::getByName('enter');

            $replenishments = Transaction::select('transactions.*')
                ->where('user_id', $user->id)
                ->where('type_id', $transactionReplenishmentType->id)
                ->where('approved', 1)
                ->where('created_at', '>=', $date->format('Y-m-d 00:00:00'))
                ->where('created_at', '<=', $date->format('Y-m-d 23:59:59'))
                ->get();

            $transactionWithdrawType = TransactionType::getByName('withdraw');

            $withdrawals = Transaction::select('transactions.*')
                ->where('user_id', $user->id)
                ->where('type_id', $transactionWithdrawType->id)
                ->where('approved', 1)
                ->where('created_at', '>=', $date->format('Y-m-d 00:00:00'))
                ->where('created_at', '<=', $date->format('Y-m-d 23:59:59'))
                ->get();

            $transactionsData[] = [
                'day' => $date->format('D'),
                'replenishments' => $replenishments->sum('main_currency_amount'),
                'withdrawals' => $withdrawals->sum('main_currency_amount'),
            ];
        }

        return response()->json([
            'status' => 200,
            'data' => $transactionsData
        ]);
    }
}
