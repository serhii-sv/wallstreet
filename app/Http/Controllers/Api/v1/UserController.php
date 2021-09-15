<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
