<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\TplDefaultLang;
use App\Models\TplTranslation;
use App\Models\Language;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Class TplTranslationsController
 *
 * @package App\Http\Controllers
 */
class TplTranslationsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index(Request $request)
    {
        $translationService = new TranslationService();

        $translations = [];

        $languages = Language::all();

        $translationKeys = [];

        $translationsFor = ['admin' => 'Админка', 'client' => 'Клиентский сайт'];

        $clientTranslations = $translationService->getClientTranslations();

        $translations['client'] = $clientTranslations['translations'];

        $translationKeys['client'] = $clientTranslations['translationKeys'];
        $translationKeys['admin'] = [];

        foreach ($languages as $language) {
            $translations['admin'][$language->code] = Storage::disk('lang')->exists($language->code . '.json') ? json_decode(Storage::disk('lang')->get($language->code . '.json'), true) : [];
            $translationKeys['admin'] = array_merge($translationKeys['admin'], array_keys($translations['admin'][$language->code]));
        }

        $translationKeys['admin'] = array_unique($translationKeys['admin']);

        return view('pages.translations.index', compact('translations', 'languages', 'translationKeys', 'translationsFor'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.langs.translations.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
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
    public function edit($key)
    {
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
    public function update(Request $request, $key)
    {
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
    public function destroy($key)
    {
        $languages = Language::all();
        $languages = $languages->map(function ($lang) {
            return $lang->code;
        });
        $languages->each(function ($lang) use ($key) {
            if (Storage::disk('lang')->exists($lang . '.json')) {
                $translations = json_decode(Storage::disk('lang')->get($lang . '.json'), true);
                if (array_key_exists($key, $translations)) {
                    unset($translations[$key]);
                    Storage::disk('lang')->put($lang . '.json', json_encode($translations));
                }
            }
        });
        return back()->with('success', 'Translation has been deleted');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download()
    {
        $zip = new \ZipArchive();
        $fileName = 'translations-' . now()->format('U') . '.zip';
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == TRUE) {
            foreach (['admin', 'client'] as $site) {
                $files = File::files(resource_path($site == 'client' ? 'lang/client_lang' : 'lang'));

                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, ($site == 'client' ? 'client' : 'admin') . '/' . $relativeName);
                }
            }

        }

        $zip->close();

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function translateAll()
    {
        Artisan::call('translate:files');
        return back()->with('success_short', 'Процесс перевода запущен');
    }
}
