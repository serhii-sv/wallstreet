<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/user",
     * summary="User info",
     * @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     * description="User info",
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *
     * )
     * )
     * )
     * )
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * @OA\Put (
     * path="/api/v1/user",
     * summary="User info update",
     * @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     * description="Update user info",
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *
     * )
     * )
     * )
     * )
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',
            'sex' => 'nullable|in:male,female'
        ]);

        if ($request->password) {
            $request->password = Hash::make($request->password);
        }

        $user->fill($request->only(['name', 'email', 'phone', 'password', 'sex']));

        if ($user->save()) {
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'user' => 'Нельзя обновить данные пользователя'
            ]
        ], 400);
    }

    /**
     * @OA\Delete (
     * path="/api/v1/user",
     * summary="User delete",
     * @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     * description="Delete user",
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *
     * )
     * )
     * )
     * )
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        if ($user->delete()) {
            return response()->json([
                'status' => 200,
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'user' => 'Нельзя удалить пользователя'
            ]
        ], 400);
    }
}
