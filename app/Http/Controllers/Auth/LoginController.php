<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeviceStat;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserDevice;
use App\Models\UserMultiAccounts;
use App\Providers\RouteServiceProvider;
use hisorange\BrowserDetect\Parser;
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

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            /* 'g-recaptcha-response' => config('app.env') == 'production' ? 'required|recaptchav3:login,0.5' : '',*/
        ], [/* 'recaptchav3' => 'Captcha error! Try again',*/
        ]);
    }

    /**
     * @param Request $request
     * @param         $user
     */
    protected function authenticated(Request $request, $user) {
        //
        $this->createUserAuthLog($request, $user);
        $this->createUserAuthDevice($request, $user);
        $this->checkForMultiAccounts($request, $user);
        $this->sendLoginNotification($request, $user);
    }

    protected function sendLoginNotification($request, $user)
    {
        $notification_data = [
            'notification_name' => 'Реинвестирование по депозиту',
            'user' => $user,
            'ip' => $request->ip(),
        ];

        Notification::sendNotification($notification_data, 'new_login');
    }

    /**
     * @param $request
     * @param $user
     */
    public function createUserAuthLog(Request $request, $user) {
        $user_log = new \App\Models\UserAuthLog();
        $user_log->user_id = $user->id;
        $user_log->ip = $request->ip();
        $user->hasAnyRole([
            'admin',
            'root',
        ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
        $user->hasAnyRole([
            'teamlead'
        ]) ? $user_log->is_teamlead = true : $user_log->is_teamlead = false;
        $user_log->save();

    }

    public function createUserAuthDevice(Request $request, $user) {
        $browser = Parser::browserFamily();
        $browser_version = Parser::browserVersion();
        $device_platform = Parser::platformName();
        $device_stats = DeviceStat::where('browser', $browser)->first();
        if ($device_stats === null) {
            $device_stats = new DeviceStat([
                'browser' => $browser,
                'count' => 0,
            ]);
        }
        $device_stats->update(['count' => $device_stats->count + 1]);

        $user_device = UserDevice::where('user_id', $user->id)->where('browser', $browser)->where('browser_version', $browser_version)->where('device_platform', $device_platform)->first();
        if ($user_device !== null) {
            if ($user_device->ip !== $request->ip()) {
                $user_device->ip = $request->ip();
                $user_device->sms_verified = false;
                $user_device->save();
            }
        } else {
            $user_device = new UserDevice();
            $user_device->user_id = $user->id;
            $user_device->ip = $request->ip();
            $user_device->browser = $browser;
            $user_device->browser_version = $browser_version;
            $user_device->device_platform = $device_platform;
            if (Parser::isMobile()) {
                $user_device->is_mobile = true;
            } else if (Parser::isTablet()) {
                $user_device->is_tablet = true;
            } else if (Parser::isDesktop()) {
                $user_device->is_desktop = true;
            } else if (Parser::is_bot()) {
                $user_device->is_bot = true;
            }
            $user_device->save();
        }
    }

    public function checkForMultiAccounts(Request $request, $user) {
        $current_ip = $request->ip();
        $main_user = User::where('ip', $current_ip)->where('id', '!=', $user->id)->first();
        $main_user_log = UserAuthLog::where('ip', $current_ip)->where('user_id', '!=', $user->id)->first();
        if (!empty($main_user->isEmpty)) {
            $this->createMultiAccountRecord($user, $main_user, $current_ip);
        } else if (!empty($main_user_log)) {
            $this->createMultiAccountRecord($user, $main_user_log->user_id, $current_ip);
        }
    }

    /**
     * @return string
     */
    public function username() {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'login';
        request()->merge([$field => request()->email]);
        return $field;
    }

    public function createMultiAccountRecord($user, $main_user, $ip) {
        if (!(UserMultiAccounts::where('user_id', $user->id)->where('main_user_id', $main_user)->count() > 0)) {
            $multi_acc = new UserMultiAccounts();
            $multi_acc->user_id = $user->id;
            $multi_acc->main_user_id = $main_user;
            $multi_acc->ip = $ip;
            $multi_acc->save();
        }
    }
}
