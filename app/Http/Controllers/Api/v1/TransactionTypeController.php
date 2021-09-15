<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/transaction-types",
     * summary="Transaction types",
     * description="List of transaction types",
     *      @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     *     @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="integer", example="200"),
     *       @OA\Property(
     *     property="data",
     *     type="array",
     *     @OA\Items(type="object",
     * @OA\Property(type="string", property="id", example="123e4567-e89b-12d3-a456-426655440000"),
     * @OA\Property(type="string", property="name", example=" Пополнение"),
     * @OA\Property(type="integer", property="commission", example="0"),
     * )
     * )
     * )
     * )
     * )
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => TransactionType::select('id', 'name', 'commission')->get()->each(function ($type) {
                $type->name = __('locale.' . $type->name);
            })
        ], 200);
    }
}
