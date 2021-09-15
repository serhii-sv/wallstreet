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
     * summary="Support tasks",
     *
     * description="Create support task",
     *     @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *       @OA\Property(property="title", type="string", example="Test support task title"),
     *       @OA\Property(property="description", type="string", example="Test support task description"),
     *       @OA\Property(property="status", type="string", example="pending")
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
