<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 * path="/api/v1/login",
 * summary="Sign in",
 * description="Login by email/login, password",
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345")
 *    ),
 * ),
 *     @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
 * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
 * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
 * @OA\Property(property="login", type="string", maxLength=32, example="John_Doe"),
 * @OA\Property(property="sex", type="string", maxLength=32, example="male"),
 * @OA\Property(property="phone", type="string", maxLength=32, example="+7 333 3333"),
 * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU")
 * )
 * ),
 * @OA\Response(
 *     response=422,
 *     description="Validation error",
 *     @OA\JsonContent(
 *        @OA\Property(property="message", type="string", example="The given data was invalid."),
 *        @OA\Property(
 *           property="errors",
 *           type="object",
 *           @OA\Property(
 *              property="email",
 *              type="array",
 *              collectionFormat="multi",
 *              @OA\Items(
 *                 type="string",
 *                 example="The email field is required.",
 *              )
 *           ),
 *
 *        ),
 *     )
 *  )
 * )
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        $this->createUserAuthLog($request, $user);
    }

    /**
     * @param $request
     * @param $user
     */
    public function createUserAuthLog($request, $user)
    {
        $user_log = new \App\Models\UserAuthLog();
        $user_log->user_id = $user->id;
        $user_log->ip = $request->ip();
        $user->hasAnyRole([
            'admin',
            'root',
        ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
        $user_log->save();
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = auth()->user();

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'login' => $user->login,
            'sex' => $user->sex,
            'phone' => $user->phone,
            'password' => $user->password,
            'api_token' => $user->api_token
        ];
    }

    /**
     * @return string
     */
    public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'login';
        request()->merge([$field => request()->email]);
        return $field;
    }
}
