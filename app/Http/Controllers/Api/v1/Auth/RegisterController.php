<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
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
 *      @OA\Parameter(
 *      name="name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="email",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="password",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *      @OA\Parameter(
 *      name="password_confirmation",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *     @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *      @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
 * @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
 * @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
 * @OA\Property(property="api_token", type="string", maxLength=80, example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"),
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp"),
 * @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp"),
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        $user = User::create([
            'name'       => $data['name'] ?? '',
            'email'      => $data['email'],
            'login'      => $data['login'],
            'password'   => Hash::make($data['password']),
            'partner_id' => null !== $partner ? $partner->my_id : (\App\Models\User::where('email', 'jordan_belfort@gmail.com')->firts()->email ?? null),
            'my_id'      => $myId,
            'api_token' => Str::random(60),
        ]);

        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'api_token' => $user->api_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at]
        ];
    }
}
