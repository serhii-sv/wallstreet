<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * @OA\Post (
     *      path="/api/v1/password/reset",
     *      summary="Password reset",
     *      description="Password reset",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Pass data",
     *          @OA\JsonContent(
     *              required={"email"},
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="token", type="string", example="ksahbfdgyuegfa6sdfga7s6sda8s7dta6sd8as"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
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
     *              @OA\Property(
     *                  property="password",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The password field is required."
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="token",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The token field is required."
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
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'unhashed_password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return response()->json([
            'status' => $status === Password::PASSWORD_RESET ? 200 : 400
        ]);
    }
}
