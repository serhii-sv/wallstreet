<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
     *                  type="objsct",
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

    public function referralsList(Request $request)
    {
        $user = $request->user();


    }
}
