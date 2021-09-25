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
     *              @OA\Property(property="token", type="string", example="ksahbfdgyuegfa6sdfga7s6sda8s7dta6sd8as"),
     *              @OA\Property(property="email", type="string", format="email", example="user@gmail.com")
     *          )
     *     ),
     *  )
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'token' => 'Неверный или просроченый токен'
                ]
            ]);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'unhashed_password' => $request->password
        ]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Пароль успешно восстановлен'
        ]);
    }
}
