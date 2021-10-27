<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\UserPhoneMessages;
use Illuminate\Http\Request;

class UserPhoneVerificationController extends Controller
{
    //
    public function index() {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        $verification_type = Setting::Where('s_key', 'verification_type')->first();
        $verification_text = Setting::Where('s_key', 'verification_text')->first();
        $verification_voice_text = Setting::Where('s_key', 'verification_voice_text')->first();
        $messages = UserPhoneMessages::orderByDesc('created_at')->paginate(16);
        
        return view('pages.user-phone-verification.index', [
            'verification_type' => $verification_type,
            'verification_enable' => $verification_enable,
            'verification_text' => $verification_text,
            'verification_voice_text' => $verification_voice_text,
            'messages' => $messages,
        ]);
    }
    
    public function save(Request $request) {
        if (UserPhoneMessages::validate($request)) {
            Setting::where('s_key', 'verification_type')->first()->update([
                's_value' => $request->get('verification_type'),
            ]);
            Setting::where('s_key', 'verification_enable')->first()->update([
                's_value' => $request->get('verification_enable'),
            ]);
        }
        Setting::where('s_key', 'verification_text')->first()->update([
            's_value' => $request->get('verification_text'),
        ]);
        Setting::where('s_key', 'verification_voice_text')->first()->update([
            's_value' => $request->get('verification_voice_text'),
        ]);
        return redirect()->back()->with('success', 'Параметры сохранены!');
    }
}
