<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * @OA\Post (
     *      path="/api/v1/password-change",
     *      summary="Password change",
     *      description="Password change",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="Pass data",
     *          @OA\JsonContent(
     *              required={"current_password", "password", "password_confirmation"},
     *              @OA\Property(property="current_password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *          ),
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(property="message", type="string", example="Пароль успешно изменен"),
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="current_password",
     *                      type="array",
     *                      collectionFormat="multi",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Пароли не совпадают"
     *                      )
     *                  ),
     *               )
     *          ),
     *     ),
     *  )
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'current_password' => 'Пароли не совпадают'
                ]
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->unhashed_password = $request->password;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Пароль успешно изменен'
        ]);
    }
}
