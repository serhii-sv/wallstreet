<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Post(
 * path="/api/v1/register",
 * summary="Sign up",
 * description="User registration",
 * @OA\RequestBody(
 *    required=true,
 *    description="Request Body",
 *    @OA\JsonContent(
 *       required={"email","password", "name", "password_confirmation"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="name", type="string", example="John Doe")
 *    ),
 * ),
 *     @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
 * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
 * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
 * @OA\Property(property="login", type="string", maxLength=32, example="John_Doe"),
 * @OA\Property(property="sex", type="string", maxLength=32, example="male"),
 * @OA\Property(property="phone", type="string", maxLength=32, example="+7 333 3333"),
 * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU")
 *        )
 *     ),
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
 *           @OA\Property(
 *              property="password",
 *              type="array",
 *              collectionFormat="multi",
 *              @OA\Items(
 *                 type="string",
 *                 example="The password field is required.",
 *              )
 *           ),
 *           @OA\Property(
 *              property="name",
 *              type="array",
 *              collectionFormat="multi",
 *              @OA\Items(
 *                 type="string",
 *                 example="The name field is required.",
 *              )
 *           )
 *        ),
 *      )
 *     )
 *  )
 * )
 */

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
            'partner_id' => ['nullable', 'digits:6', 'exists:users,my_id']
        ]);
    }

    /**
     * @param array $data
     * @return array[]
     */
    protected function create(array $data)
    {
        $partner_id = null;

        /** @var User|null $partner */
        $partner = null !== $partner_id
            ? User::where('my_id', $partner_id)
            : null;

        if (empty($data['login'])) {
            $data['login'] = $data['email'];
        }

        $myId = Helper::generateMyId();

        return User::create([
            'name'       => $data['name'] ?? '',
            'email'      => $data['email'],
            'login'      => $data['login'],
            'password'   => Hash::make($data['password']),
            'partner_id' => null !== $partner ? $partner->my_id : (\App\Models\User::where('email', 'sprint@bank.com')->first()->email ?? null),
            'my_id'      => $myId,
            'api_token' => Str::random(60),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        \Log::critical(print_r($request->all(),true));

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'login' => $user->login,
            'sex' => $user->sex,
            'phone' => $user->phone,
            'password' => $user->password,
            'api_token' => $user->api_token
        ], 201);
    }
}
