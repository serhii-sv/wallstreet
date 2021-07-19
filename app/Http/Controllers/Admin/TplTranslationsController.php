<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Admin;

use App\Models\TplDefaultLang;
use App\Models\TplTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Class TplTranslationsController
 *
 * @package App\Http\Controllers\Admin
 */
class TplTranslationsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $lang = Language::getDefault()->code;
        
        $texts = Storage::disk('lang')->exists($lang . '.json') ? json_decode(Storage::disk('lang')->get($lang . '.json'), true) : [];
        $category = 'customer';
        
        //        if (!empty($request->category)) {
        //            $texts = $texts->where('category', $request->category);
        //            $category = $request->category;
        //        }
        //$texts = $texts->orderBy('text')->get();
        
        return view('admin.langs.translations.index', [
            'texts' => $texts,
            'lang' => $lang,
            'category' => $category,
        ]);
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.langs.translations.create');
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $languages = Language::all();
        $text = $languages->mapWithKeys(function ($lang) use ($request) {
            return [$lang->code => $request->input('text_' . $lang->code)];
        });
        $key = $request->get('key');
        $text->each(function ($item, $lang) use ($key) {
            if (Storage::disk('lang')->exists($lang . '.json')) {
                $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
                if (!array_key_exists($key, $translations)) {
                    $translations[$key] = $item;
                }
            } else {
                $translations[$key] = $item;
            }
            Storage::disk('lang')->put($lang . '.json', json_encode($translations));
        });
        
        return back()->with('success', __('Translation has been created'));
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($key) {
        $languages = Language::all();
        
        $data = $languages->mapWithKeys(function ($lang) use ($key) {
            if (Storage::disk('lang')->exists($lang->code . '.json')) {
                $translations = json_decode(Storage::disk('lang')->get($lang->code . '.json'), true);
                if (array_key_exists($key, $translations)) {
                    return [$lang->code => $translations[$key]];
                } else {
                    return [$lang->code => ''];
                }
            }
        });
        return view('admin.langs.translations.edit', [
            'data' => $data,
            'key' => $key,
            'languages' => $languages,
        ]);
    }
    
    /**
     * @param Request $request
     * @param         $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $key) {
        $languages = Language::all();
        $text = $languages->mapWithKeys(function ($lang) use ($request) {
            return [$lang->code => $request->input('text_' . $lang->code)];
        });
        $text->each(function ($item, $lang) use ($key) {
            if (Storage::disk('lang')->exists($lang . '.json')) {
                $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
                $translations[$key] = $item;
            } else {
                $translations[$key] = $item;
            }
            Storage::disk('lang')->put($lang . '.json', json_encode($translations));
        });
        return back()->with('success', __('Translation ahs been updated'));
    }
    
    /**
     * @param $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($key) {
        $languages = Language::all();
        $languages = $languages->map(function ($lang) {
            return $lang->code;
        });
        $languages->each(function ($lang) use ($key) {
            if (Storage::disk('lang')->exists($lang . '.json')) {
                $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
                if (array_key_exists($key, $translations)){
                    unset($translations[$key]);
                    Storage::disk('lang')->put($lang . '.json', json_encode($translations));
                }
            }
        });
        return back()->with('success', 'Translation has been deleted');
    }
}
