<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestSaveUserSettings;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Profile
 */
class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('profile.settings');
    }

    /**
     * @param RequestSaveUserSettings $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(RequestSaveUserSettings $request)
    {
        $user = \Auth::user();

        /*
         * Base settings
         */
        if ($request->has('name')) {
            $user->name = htmlspecialchars(trim($request->name));
        }

        if ($request->has('login')) {
            $user->login = $request->login;
        }

        if ($request->has('partner_id')) {
            $user->partner_id = $request->partner_id;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('skype')) {
            $user->skype = htmlspecialchars(trim($request->skype));
        }

        $user->save();

        /*
         * Wallets
         */
        if ($request->has('wallets')) {
            foreach ($request->wallets as $walletId => $walletAddress) {
                $wallet = $user->wallets()
                    ->where('id', $walletId)
                    ->first();

                if (null == $wallet) {
                    continue;
                }

                $walletAddress = htmlspecialchars(trim($walletAddress));

                if (!empty($walletAddress) && $walletAddress != $wallet->external) {
                    $wallet->external = $walletAddress;
                    $wallet->save();
                }
            }
        }

        return redirect()->route('profile.settings')->with('success', __('Settings successfully saved!'));
    }
}
