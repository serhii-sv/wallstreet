<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CryptoCurrencyRateLog;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends BaseController
{
    /**
     *  @OA\Get(
     *      path="/api/v1/wallets",
     *      summary="Wallets",
     *      description="Wallets list",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          @OA\Schema(
     *              type="integer", example="1"
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
     *              @OA\Property(property="current_page", type="integer", example="1"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="user_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="payment_system_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="external", type="string", example="Z123123"),
     *                      @OA\Property(property="balance", type="decimal", example="2533.5"),
     *                      @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      @OA\Property(property="main_currency_amount", type="decimal", example="33.5"),
     *                      @OA\Property(
     *                          property="currency",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                          @OA\Property(property="name", type="string", example="U.S dollars"),
     *                          @OA\Property(property="code", type="string", example="USD"),
     *                          @OA\Property(property="symbol", type="string", example="$"),
     *                          @OA\Property(property="icon", type="string", example="http://localhost:8000/images/coins/usd.png"),
     *                          @OA\Property(property="precision", type="integer", example="2"),
     *                          @OA\Property(property="current_rate", type="string", example="124123.123123"),
     *                          @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                          @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      ),
     *                      @OA\Property(
     *                          property="payment_system",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                          @OA\Property(property="name", type="string", example="Perfect Money"),
     *                          @OA\Property(property="code", type="string", example="perfectmoney"),
     *                          @OA\Property(property="instant_limit", type="string", example="null"),
     *                          @OA\Property(property="external_balances", type="string", example="null"),
     *                          @OA\Property(property="minimum_topup", type="string", example="null"),
     *                          @OA\Property(property="minimum_withdraw", type="string", example="null"),
     *                          @OA\Property(property="connected", type="integer", example="0"),
     *                          @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                          @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      ),
     *                      @OA\Property(
     *                          property="cyrrency_rate_log",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="key", type="string", example="Mon"),
     *                              @OA\Property(property="value", type="string", example="234.234"),
     *                         )
     *                     )
     *                  )
     *              ),
     *              @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="from", type="integer", example="1"),
     *              @OA\Property(property="last_page", type="integer", example="1"),
     *              @OA\Property(property="last_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="next_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="path", type="string", example="http://localhost:8000/api/v1/wallets"),
     *              @OA\Property(property="per_page", type="integer", example="10"),
     *              @OA\Property(property="prev_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="to", type="integer", example="8"),
     *              @OA\Property(property="total", type="integer", example="8"),
     *             )
     *         )
     *     )
     *  )
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $wallets = $user->wallets()
            ->with('currency', 'paymentSystem')
            ->paginate(self::API_PAGINATION);

        $wallets->each(function ($wallet) {
            $rate = Setting::where('s_key', 'like', strtolower($wallet->currency->code) . '%')->first();
            $wallet->currency->current_rate = $rate->s_value ?? 0;

            $wallet->currency->getCoinIcon();

            $wallet->cyrrency_rate_log = CryptoCurrencyRateLog::getChartData($wallet);
        });

        return response()->json([
            'status' => 200,
            'data' => $wallets
        ], 200);
    }

    /**
     *  @OA\Put(
     *      path="/api/v1/wallets/{wallet_id}",
     *      summary="Update wallet",
     *      description="Update wallet",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="wallet_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="123e4567-e89b-12d3-a456-426655440000"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="Pass wallet data",
     *          @OA\JsonContent(
     *              required={"external"},
     *              @OA\Property(property="external", type="string", example="@123123")
     *          ),
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="external",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="The external field is required.",
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
     *              property="data",
     *              type="object",
     *              @OA\Property(property="current_page", type="integer", example="1"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="user_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="currency_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="payment_system_id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                      @OA\Property(property="external", type="string", example="Z123123"),
     *                      @OA\Property(property="balance", type="decimal", example="2533.5"),
     *                      @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      @OA\Property(property="main_currency_amount", type="decimal", example="33.5"),
     *                      @OA\Property(
     *                          property="currency",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                          @OA\Property(property="name", type="string", example="U.S dollars"),
     *                          @OA\Property(property="code", type="string", example="USD"),
     *                          @OA\Property(property="symbol", type="string", example="$"),
     *                          @OA\Property(property="precision", type="integer", example="2"),
     *                          @OA\Property(property="icon", type="string", example="http://localhost:8000/images/coins/usd.png"),
     *                          @OA\Property(property="current_rate", type="string", example="124123.123123"),
     *                          @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                          @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      ),
     *                      @OA\Property(
     *                          property="payment_system",
     *                          type="object",
     *                          @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                          @OA\Property(property="name", type="string", example="Perfect Money"),
     *                          @OA\Property(property="code", type="string", example="perfectmoney"),
     *                          @OA\Property(property="instant_limit", type="string", example="null"),
     *                          @OA\Property(property="external_balances", type="string", example="null"),
     *                          @OA\Property(property="minimum_topup", type="string", example="null"),
     *                          @OA\Property(property="minimum_withdraw", type="string", example="null"),
     *                          @OA\Property(property="connected", type="integer", example="0"),
     *                          @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                          @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      ),
     *                      @OA\Property(
     *                          property="cyrrency_rate_log",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="key", type="string", example="Mon"),
     *                              @OA\Property(property="value", type="string", example="234.234"),
     *                          )
     *                     )
     *                  )
     *              ),
     *              @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="from", type="integer", example="1"),
     *              @OA\Property(property="last_page", type="integer", example="1"),
     *              @OA\Property(property="last_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="next_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="path", type="string", example="http://localhost:8000/api/v1/wallets"),
     *              @OA\Property(property="per_page", type="integer", example="10"),
     *              @OA\Property(property="prev_page_url", type="string", example="http://localhost:8000/api/v1/wallets?page=1"),
     *              @OA\Property(property="to", type="integer", example="8"),
     *              @OA\Property(property="total", type="integer", example="8"),
     *             )
     *         )
     *     )
     *  )
     */
    public function update(Request $request, $id)
    {
        $wallet = $request->user()->wallets()->where('id', $id)->first();

        if (is_null($wallet)) {
            return response()->json([
                'status' => 403,
                'errors' => [
                    'wallet' => 'Нельзя изменить чужой кошелек'
                ]
            ], 403);
        }

        $request->validate([
            'external' => 'required|string|max:256|unique:wallets,external,' . $id
        ]);

        $wallet->fill($request->only('external'));

        if ($wallet->save()) {
            $rate = Setting::where('s_key', 'like', strtolower($wallet->currency->code) . '%')->first();
            $wallet->currency->current_rate = $rate->s_value ?? 0;

            $wallet->currency->getCoinIcon();

            $wallet->cyrrency_rate_log = CryptoCurrencyRateLog::getChartData($wallet);

            return response()->json([
                'status' => 200,
                'data' => $wallet
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'wallet' => 'Нельзя изменить кошелек'
            ]
        ], 400);
    }

    /**
     *  @OA\Get (
     *      path="/api/v1/wallets/{wallet_id}/currency-rates",
     *      summary="Wallet currency rate change data",
     *      description="Wallet currency rate change data",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="wallet_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="123e4567-e89b-12d3-a456-426655440000"
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
     *                  @OA\Property(property="key", type="string", example="Mon"),
     *                  @OA\Property(property="value", type="string", example="234.234"),
     *             )
     *          )
     *        )
     *     )
     *  )
     */
    public function currencyRate(Request $request, $id)
    {
        $wallet = $request->user()->wallets()->where('id', $id)->first();

        if (is_null($wallet)) {
            return response()->json([
                'status' => 403,
                'errors' => [
                    'wallet' => 'Это не ваш кошелек'
                ]
            ], 403);
        }

        $logData = CryptoCurrencyRateLog::getChartData($wallet);

       return response()->json([
           'status' => 200,
           'data'  => $logData
       ]);
    }
}
