<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

namespace App\Http\Middleware;

use App\Models\Setting;
use App\Models\User;
use Closure;

class SiteStatus
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View|mixed
     * @throws \Throwable
     */
    public function handle($request, Closure $next)
    {
        if(Setting::getValue('site-on') != 'on'){
            return response()->view('customer.disabled');
        }

        /** @var User $user */
        $user = \Auth::user();

        /** @var User $user */
//        if (null !== $user && !$user->isVerifiedEmail()) {
//            if (\Route::is('resend')) {
//                if ($user->canSendVerificationEmail()) {
//                    $user->sendVerificationEmail();
//                } else {
//                    return response()->view('customer.verify_your_account', [
//                        'message' => 'Can not send email, please, contact support or try again later.'
//                    ]);
//                }
//
//                return response()->view('customer.verify_your_account', [
//                    'message' => 'Email sent successfully'
//                ]);
//            }
//            return response()->view('customer.verify_your_account');
//        }

        return $next($request);
    }
}
