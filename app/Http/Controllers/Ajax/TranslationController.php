<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TranslationController extends Controller
{
    public function changeLang(Request $request) {
        //dump($request->all());
        $name = $request->post('name');
        $value = $request->post('text');
        $lang = $request->locale_name ?? app()->getLocale();

        $sendToClient = $request->send_to_client == 'true';

        // Check lang file
        if (Storage::disk($sendToClient ? 'client_lang' : 'lang')->exists($lang . '.json')) {
            $translations = json_decode(Storage::disk($sendToClient ? 'client_lang' : 'lang')->get($lang . '.json'), true);
        } else {
            $translations = [];
        }

        // check lang_manual file
        if (Storage::disk($sendToClient ? 'client_lang' : 'lang')->exists($lang . '_manual.json')) {
            $manual = json_decode(Storage::disk($sendToClient ? 'client_lang' : 'lang')->get($lang . '_manual.json'), true);
            if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                unset($manual[$name]);
            } else {
                $manual[$name] = true;
            }
            Storage::disk($sendToClient ? 'client_lang' : 'lang')->put($lang . '_manual.json', json_encode($manual));
        } else {
            $manual = [];
            if ((array_key_exists($name, $translations) && $value == $translations[$name]) || $value == $name) {
                unset($manual[$name]);
            } else {
                $manual[$name] = true;
            }
            Storage::disk($sendToClient ? 'client_lang' : 'lang')->put($lang . '_manual.json', json_encode($manual));
        }

        $translations[$name] = htmlspecialchars($value);

        if (Storage::disk($sendToClient ? 'client_lang' : 'lang')->put($lang . '.json', json_encode($translations))) {
            if ($sendToClient) {
                try {
                    $response = Http::post(env('CLIENT_SITE_URL') . 'translations?api_token=' . auth()->user()->api_token, [
                        'translations' => [
                            $lang => $translations
                        ]
                    ])->json();
                } catch (\Exception $exception) {

                }
            }
            return json_encode([
                'status' => 'good',
                'msg' => 'Phrase is changed!',
            ]);
        }

        return json_encode([
            'status' => 'bad',
            'msg' => 'Phrase is not changed!',
        ]);
    }
}
