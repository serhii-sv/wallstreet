<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Facades\App;

/**
 * Class LanguageController
 * @package App\Http\Controllers
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($locale) {
        $checkExists = Language::where('code', $locale)->get()->count();

        if ($checkExists == 0) {
            return back()->with('error', __('Язык не найден'));
        }

        session([
            'language' => $locale
        ]);
        App::setLocale($locale);
        return back()->with('success', __('Язык изменен успешно'));
    }

}
