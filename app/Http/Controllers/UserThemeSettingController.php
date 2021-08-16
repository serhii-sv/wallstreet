<?php

namespace App\Http\Controllers;

use App\Models\UserThemeSetting;
use Illuminate\Http\Request;

class UserThemeSettingController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $settings = $request->except('_token');

        $result = UserThemeSetting::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'user_id' => $user->id,
                'theme_settings' => $settings
            ]
        );

        return response()->json([
            'success' => (bool)$result,
            'message' => (bool)$result ? 'Настройки темы сохранены успешно' : 'Настройки темы не были сохранены'
        ]);
    }
}
