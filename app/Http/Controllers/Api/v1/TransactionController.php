<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/v1/transactions",
     * summary="Transactions",
     * @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     * description="Transactions list",
     *     @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *
     * )
     * )
     * )
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $filter_type = $request->get('type') ? $request->get('type') : false;
        $transactions = Transaction::when($filter_type, function($query) use ($filter_type){
            return $query->where('type_id', $filter_type);
        })
            ->where('user_id', $user->id)
            ->with('user', 'paymentSystem', 'currency', 'type')
            ->paginate(self::API_PAGINATION);

        return response()->json([
            'status' => 200,
            'data' => $transactions
        ], 200);
    }
}
