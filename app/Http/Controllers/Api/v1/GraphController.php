<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Setting;
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
     *     @OA\Parameter(
     *          name="period",
     *          in="query",
     *          @OA\Schema(
     *              type="string", example="1 month"
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
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                              @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                              @OA\Property(property="rate", type="string", example="200.45"),
     *                              @OA\Property(property="date", type="date-time", example="2021-09-07"),
     *                              @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                              @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                         )
     *                     )
     *                  )
     *              ),
     *         )
     *     )
     *  )
     */
    public function sprintToken(Request $request)
    {
        $currency = Currency::where('code', 'USDT.ERC20')->first();

        $period = '1 month';

        if ($request->period) {
            $period = $request->period;
        }

        $currency->getCoinIcon();

        $rate = Setting::where('s_key', 'like', strtolower($currency->code) . '%')->first();
        $currency->current_rate = $rate->s_value ?? 0;

        $currency->cyrrency_rate_log = $currency
            ->rateLog()
            ->where('date', '>=', date('Y-m-d', strtotime( '- ' . $period)))
            ->orderBy('date', 'asc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $currency
        ]);
    }
}
