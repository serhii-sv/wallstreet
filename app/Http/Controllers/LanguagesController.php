<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Class LanguagesController
 *
 * @package App\Http\Controllers
 */
class LanguagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.langs.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.langs.create');
    }

    /**
     * @param RequestCreateLanguage $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RequestCreateLanguage $request) {

        $createLang = Language::create($request->all());

        if (!$createLang) {
            return back()->with('error', __('Невозможно добавить язык'))->withInput();
        }

        return back()->with('success', __('Язык успешно добавлен'));
    }

    /**
     * @param Language $lang
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Language $lang) {
        return view('admin.langs.edit', [
            'lang' => $lang,
        ]);
    }

    /**
     * @param Request  $request
     * @param Language $lang
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Language $lang) {
        if ($lang->default) {
            return back()->with('error', __('Запрещено мзменять язык по умолчанию'))->withInput();
        }

        $update = $lang->update($request->all());

        if ($request->default) {
            Language::where('default', 1)->update([
                'default' => 0,
            ]);
            $lang->default = 1;
            $lang->save();
        }

        if (!$update) {
            return back()->with('error', __('Невозможно изменять язык'))->withInput();
        }

        return back()->with('success', 'Язык успешно изменен');
    }

    /**
     * @param $lang
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy($lang) {
        $lang = Language::find($lang);

        if ($lang->default) {
            return back()->with('error', __('Запрещено мзменять язык по умолчанию'))->withInput();
        }

        if ($lang->delete()) {
            return redirect()->route('admin.langs.index')->with('success', __('Узык удален'));
        }

        return redirect()->route('admin.langs.index')->with('error', __('Невозможно удалить язык'));
    }

}
