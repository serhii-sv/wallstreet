<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post (
     *      path="/api/v1/password/forget",
     *      summary="Password forget",
     *      description="Password forget",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Pass data",
     *          @OA\JsonContent(
     *              required={"email"},
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *          ),
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *               @OA\Property(
     *                  property="email",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The email field is required.",
     *                  )
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200")
     *          )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="400")
     *          )
     *     ),
     *  )
     */
    public function forget(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => $status === Password::RESET_LINK_SENT ? 200 : 400
        ]);
    }
}
