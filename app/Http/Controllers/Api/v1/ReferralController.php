<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class ReferralController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/api/v1/ref-link",
     *      summary="Referral link",
     *      description="Referral link",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="link", type="string", example="http://localhost:8000/ref/1472152")
     *             )
     *         )
     *      )
     * )
     */
    public function makeLink(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => 200,
            'data' => [
                'link' => url('/ref/' . $user->my_id)
            ]
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/referrals/referrals-list",
     *      summary="Referrals list",
     *      description="Referrals list",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="login", type="string", example="user"),
     *                      @OA\Property(property="invested", type="string", example="123.1312"),
     *                      @OA\Property(property="reward", type="string", example="123.1312"),
     *                  )
     *             )
     *         )
     *      )
     * )
     */
    public function referralsList(Request $request)
    {
        $user = $request->user();

        $data = [];

        foreach ($user->referrals as $referral) {
            $data[] = [
                'login' => $referral->login,
                'invested' => number_format($referral->transactions()->where('type_id',
                    TransactionType::where('name', 'create_dep')
                        ->first()
                        ->id
                )->sum('main_currency_amount'), 2, '.', ','),
                'reward' => number_format($user->transactions()
                    ->where('type_id',
                        TransactionType::where('name', 'partner')
                            ->first()
                            ->id
                    )
                    ->where('source', $referral->id)
                    ->sum('main_currency_amount'), 2, '.', ',')
            ];
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
}
