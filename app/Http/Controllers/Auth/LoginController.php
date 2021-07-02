<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 *
 * @property string redirectTo
 * @property int maxAttempts
 * @property int decayMinutes
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/wallstreet';

    /*
     * Limiting
     */
    protected $maxAttempts = 0;
    protected $decayMinutes = 0;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->maxAttempts = User::MAX_LOGIN_ATTEMPTS;
        $this->decayMinutes = User::LOGIN_BLOCKING;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            /** @var User $user */
            $user = auth()->user();

            if ($user->hasAnyRole(['admin','root'])) {
                return redirect(route('admin'));
            }

            return redirect(route('profile.profile'));
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     * @throws
     */
    protected function attemptLogin(Request $request)
    {
        /*
         * Check captcha
         */
        $validator = \Validator::make($request->all(), [
            'captcha' => loginCaptchaCanBeShown() ? 'required|captcha' : '',
        ], [
            'captcha.required' => trans('validation.captcha_required'),
            'captcha.captcha' => trans('validation.captcha_captcha')
        ]);

        /*
         * Send errors about captcha
         */
        if ($validator->fails()) {
            throw ValidationException::withMessages([
                $this->username() => [$validator->errors()->get('captcha')[0]],
            ]);
        }

        /*
         * Turn off blocking
         */
        if (session()->has('blocked_time') && $this->getDiffInMinutesForBlocked() < 1) {
            session()->remove('blocked_time');
            session()->remove('login_attempts');
        }

        /*
         * If do not have login attempts
         */
        if (session()->has('login_attempts') == false) {
            session()->put('login_attempts', 0);
        }

        /*
         * Block user if needs this
         */
        if (session()->has('blocked_time')) {
            return $this->hasTooManyAttempts();
        }

        /*
         * Trying to authorize user
         */
        if (\Auth::attempt(['email' => $request->login, 'password' => $request->password], $request->filled('remember'))) {
            return true;
        }

        if (\Auth::attempt(['login' => $request->login, 'password' => $request->password], $request->filled('remember'))) {
            return true;
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     * @throws
     */
    protected function authenticated(Request $request, $user)
    {
        $data = [
            'user' => $user,
            'ip' => $_SERVER['REMOTE_ADDR']
        ];
        $user->sendNotification('authorized', $data);
    }

    /**
     * @param Request $request
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        /*
         * Increment attempts
         */
        session()->increment('login_attempts');

        /*
         * Create blocking session variable
         */
        if (session()->get('login_attempts') >= $this->maxAttempts && !session()->has('blocked_time')) {
            session()->put('blocked_time', now());
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * @throws \Exception
     */
    protected function hasTooManyAttempts()
    {
        /*
         * Increment attempts
         */
        session()->increment('login_attempts');

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.throttle', [
                'minutes' => $this->getDiffInMinutesForBlocked(),
            ])],
        ]);
    }

    /**
     * @return int
     */
    private function getDiffInMinutesForBlocked()
    {
        return Carbon::parse(session('blocked_time'))
            ->addMinutes($this->decayMinutes)
            ->diffInMinutes(now());
    }

    /**
     * @return string
     */
    public static function checkClassExists()
    {
        return 'auth looks ok';
    }
}
