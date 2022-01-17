<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TranslationService
{

    /**
     * @return array|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getClientTranslations()
    {
        $translationData = $this->getTranslations();
        $this->storeClientTranslationsLocal($translationData['translations']);
        return $translationData;
    }

    /**
     * @return array|mixed
     */
    private function getTranslations()
    {
        return Http::get(env('CLIENT_SITE_URL') . 'translations?api_token=' . auth()->user()->api_token)->json();
    }

    /**
     * @param $translations
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function storeClientTranslationsLocal($translations)
    {
        foreach ($translations as $lang => $translation) {
            foreach ($translation as $name => $value) {
                if (Storage::disk('client_lang')->exists($lang . '.json')) {
                    $translations = json_decode(Storage::disk('client_lang')->get($lang . '.json'), true);
                } else {
                    $translations = [];
                }

                // check lang_manual file
                if (Storage::disk('client_lang')->exists($lang . '_manual.json')) {
                    $manual = json_decode(Storage::disk('client_lang')->get($lang . '_manual.json'), true);
                    if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                        unset($manual[$name]);
                    } else {
                        $manual[$name] = true;
                    }
                    Storage::disk('client_lang')->put($lang . '_manual.json', json_encode($manual));
                } else {
                    $manual = [];
                    if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                        unset($manual[$name]);
                    } else {
                        $manual[$name] = true;
                    }
                    Storage::disk('client_lang')->put($lang . '_manual.json', json_encode($manual));
                }

                $translations[$name] = htmlspecialchars($value);

                Storage::disk('client_lang')->put($lang . '.json', json_encode($translations));
            }
        }
    }
}
