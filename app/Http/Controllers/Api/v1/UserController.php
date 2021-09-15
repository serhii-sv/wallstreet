<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
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
     *      @OA\Property(property="status", type="integer", example="200"),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
     * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
     * @OA\Property(property="login", type="string", maxLength=32, example="John_Doe"),
     * @OA\Property(property="sex", type="string", maxLength=32, example="male"),
     * @OA\Property(property="phone", type="string", maxLength=32, example="+7 333 3333"),
     * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU")
     *      )
     * )
     * )
     * )
     */
    public function user(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => 200,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'login' => $user->login,
                'sex' => $user->sex,
                'phone' => $user->phone,
                'password' => $user->password,
                'api_token' => $user->api_token
            ]
        ]);
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
     *     @OA\RequestBody(
     *    required=true,
     *    description="Pass user data",
     *    @OA\JsonContent(
     *       required={"email", "name"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="name", type="string", example="John Doe"),
     *       @OA\Property(property="phone", type="string", example="+7 333 3333"),
     *       @OA\Property(property="sex", type="string", example="male"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345")
     *    ),
     * ),
     * description="Update user info",
     *     @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *      @OA\Property(property="status", type="integer", example="200"),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
     * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
     * @OA\Property(property="login", type="string", maxLength=32, example="John_Doe"),
     * @OA\Property(property="sex", type="string", maxLength=32, example="male"),
     * @OA\Property(property="phone", type="string", maxLength=32, example="+7 333 3333"),
     * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU")
     *      ),
     *      )
     * ),
     *     @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * ),
     *      @OA\Response(
     *    response=400,
     *    description="Error",
     *    @OA\JsonContent(
     *      @OA\Property(property="status", type="integer", example="400"),
     *      @OA\Property(
     *          property="errors",
     *          type="object",
     *      @OA\Property(
     *              property="user",
     *              type="array",
     *              collectionFormat="multi",
     *              @OA\Items(
     *                 type="string",
     *                 example="Нельзя обновить данные пользователя.",
     *              )
     *           ),
     *      ),
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
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'login' => $user->login,
                    'sex' => $user->sex,
                    'phone' => $user->phone,
                    'password' => $user->password,
                    'api_token' => $user->api_token
                ]
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'user' => 'Нельзя обновить данные пользователя.'
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
     *  @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *      @OA\Property(property="status", type="integer", example="200"),
     *     )
     * ),
     *      @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * ),
     *      @OA\Response(
     *    response=400,
     *    description="Error",
     *    @OA\JsonContent(
     *      @OA\Property(property="status", type="integer", example="400"),
     *      @OA\Property(
     *          property="errors",
     *          type="object",
     *      @OA\Property(
     *              property="user",
     *              type="array",
     *              collectionFormat="multi",
     *              @OA\Items(
     *                 type="string",
     *                 example="Нельзя удалить пользователя.",
     *              )
     *           ),
     *      ),
     * )
     * )
     * )
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        if ($user->delete()) {
            return response()->json([
                'status' => 200
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'user' => 'Нельзя удалить пользователя.'
            ]
        ], 400);
    }

    /**
     * @OA\Get(
     * path="/api/v1/users",
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
     *      @OA\Property(property="status", type="integer", example="200"),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
     * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
     * @OA\Property(property="login", type="string", maxLength=32, example="John_Doe"),
     * @OA\Property(property="sex", type="string", maxLength=32, example="male"),
     * @OA\Property(property="phone", type="string", maxLength=32, example="+7 333 3333"),
     * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU")
     *      )
     * )
     * )
     * )
     */
    public function users()
    {
        return response()->json([
            'status' => 200,
            'data' => User::paginate(self::API_PAGINATION)
        ]);
    }
}
