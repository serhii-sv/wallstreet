<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
     *                          @OA\Property(property="precision", type="integer", example="2"),
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

        return response()->json([
            'status' => 200,
            'data' => $wallets
        ], 200);
    }
}
