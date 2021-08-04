<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['guest'])->except('logout');
    }

    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => config('app.env') == 'production'
                ? 'required|recaptchav3:login,0.5'
                : '',
        ], [
            'recaptchav3' => 'Captcha error! Try again',
        ]);
    }
    
    protected function authenticated(Request $request, $user)
    {
        //
        $this->createUserAuthLog($request, $user);
    }
    public function createUserAuthLog($request, $user) {
        $user_log = new \App\Models\UserAuthLog();
        $user_log->user_id = $user->id;
        $user_log->ip = $request->ip();
        $user->hasAnyRole([
            'admin',
            'root',
        ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
        $user_log->save();
    }
}
