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
     * @OA\Get(
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
     *          response=404,
     *          description="Currency not found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="currency",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Валюта не найдена",
     *                      )
     *                  ),
     *              )
     *          ),
     *     ),
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
     *                  @OA\Property(property="rate_exchange_percentage", type="string", example="22.4"),
     *                  @OA\Property(property="icon", type="string", example="http://localhost:8000/images/coins/usd.png"),
     *                  @OA\Property(property="current_rate", type="string", example="124123.123123"),
     *                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                  @OA\Property(
     *                          property="cyrrency_rate_log",
     *                          type="object",
     *                          @OA\Property(
     *                              property="week",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="label", type="string", example="Tue"),
     *                                  @OA\Property(property="value", type="string", example="123.123"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="label", type="string", example="2021-03-21"),
     *                                  @OA\Property(property="value", type="string", example="123.123"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month3",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="label", type="string", example="2021-03-21"),
     *                                  @OA\Property(property="value", type="string", example="123.123"),
     *                              )
     *                          ),
     *                          @OA\Property(
     *                              property="month6",
     *                              type="array",
     *                              @OA\Items(
     *                                  @OA\Property(property="label", type="string", example="Jun"),
     *                                  @OA\Property(property="value", type="string", example="123.123"),
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
//            'day' => '1 day',
            'week' => '1 week',
            'month' => '1 month',
            'month3' => '3 months',
            'month6' => '6 months',
//            'year' => '1 year'
        ];

        if (is_null($currency)) {
            return response()->json([
                'status' => 404,
                'errors' => [
                    'currency' => 'Валюта не найдена'
                ]
            ], 404);
        }

        $responseData = cache()->remember('sprint-token.chart-date', now()->addMinutes(30), function () use ($currency, $periods) {
            $currency->getCoinIcon();
            $currency->getRisePercentage();

            $rate = Setting::where('s_key', 'like', strtolower($currency->code) . '%')->first();
            $currency->current_rate = $rate->s_value ?? 0;

            $chartDataLog = [];

            foreach ($periods as $period_label => $period_value) {
                switch ($period_label) {
                    case 'week':
                        $log = $currency
                            ->rateLog()
                            ->where('date', '>=', date('Y-m-d', strtotime('- ' . $period_value)))
                            ->orderBy('date', 'asc')
                            ->get();

                        $data = [
                            'label' => '1w',
                            'name' => 'week',
                        ];

                        foreach ($log as $item) {
                            $data['data'][] = [
                                'label' => Carbon::parse($item->date)->format('D'),
                                'value' => $item->rate
                            ];
                        }

                        $chartDataLog[] = $data;
                        break;
                    case 'month':
                        $log = $currency
                            ->rateLog()
                            ->where('date', '>=', date('Y-m-d', strtotime('- ' . $period_value)))
                            ->orderBy('date', 'asc')
                            ->get();

                        $data = [
                            'label' => '1m',
                            'name' => 'month',
                        ];

                        foreach ($log as $item) {
                            $data['data'][] = [
                                'label' => $item->date,
                                'value' => $item->rate
                            ];
                        }

                        $chartDataLog[] = $data;
                        break;
                    case 'month3':
                        $date = Carbon::now()->subMonths(3);

                        $data = [
                            'label' => '3m',
                            'name' => 'month3',
                        ];

                        while (true) {
                            $log = $currency
                                ->rateLog()
                                ->where('date', $date->format('Y-m-d'))
                                ->orderBy('date', 'asc')
                                ->first();

                            if (!is_null($log)) {
                                $data['data'][] = [
                                    'label' => $log->date,
                                    'value' => $log->rate
                                ];
                            }

                            $date = $date->endOfWeek()->addWeek();

                            if ($date->gt(Carbon::now())) {
                                break;
                            }
                        }

                        $chartDataLog[] = $data;
                        break;

                    case 'month6':
                        $date = Carbon::now()->subMonths(5);

                        $data = [
                            'label' => '6m',
                            'name' => 'month6',
                        ];

                        while (true) {
                            $log = $currency
                                ->rateLog()
                                ->where('date', $date->format('Y-m-d'))
                                ->orderBy('date', 'asc')
                                ->first();

                            if (!is_null($log)) {
                                $data['data'][] = [
                                    'label' => Carbon::parse($log->date)->format('M'),
                                    'value' => $log->rate
                                ];
                            }

                            $date = $date->addMonth();

                            if ($date->gt(Carbon::now())) {
                                break;
                            }
                        }

                        $chartDataLog[] = $data;
                        break;
                }
            }

            $currency->cyrrency_rate_log = $chartDataLog;

            return $currency;
        });

        return response()->json([
            'status' => 200,
            'data' => $responseData
        ]);
    }

    /**
     * @OA\Get(
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
     *              type="object",
     *              @OA\Property(
     *                  property="days",
     *                  type="array",
     *                  @OA\Items(type="string", example="Mon"),
     *              ),
     *              @OA\Property(
     *                  property="replenishments",
     *                  type="array",
     *                  @OA\Items(type="string", example="123.123"),
     *              ),
     *              @OA\Property(
     *                  property="withdrawals",
     *                  type="array",
     *                  @OA\Items(type="string", example="123.123"),
     *              )
     *            )
     *         )
     *     )
     *  )
     */
    public function transactions(Request $request)
    {
        $user = $request->user();

        $transactionsData = [];

        for ($i = 7; $i > 0; $i--) {
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

            $transactionsData['days'][] = $date->format('D');
            $transactionsData['replenishments'][] = $replenishments->sum('main_currency_amount');
            $transactionsData['withdrawals'][] = $withdrawals->sum('main_currency_amount');
        }

        return response()->json([
            'status' => 200,
            'data' => $transactionsData
        ]);
    }
}
