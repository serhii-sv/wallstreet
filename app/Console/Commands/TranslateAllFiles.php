<?php

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use JoggApp\GoogleTranslate\GoogleTranslate;
use JoggApp\GoogleTranslate\GoogleTranslateClient;

class TranslateAllFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate files automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $translate = new GoogleTranslate(new GoogleTranslateClient(config('googletranslate')));

        $translationsData = [];

        foreach (['admin', 'client'] as $site) {
            foreach (Language::all() as $language) {
                $disk = $site == 'admin' ? 'lang' : 'client_lang';

                if (Storage::disk($disk)->exists($language->code . '.json')) {
                    $data = json_decode(Storage::disk($disk)->get($language->code . '.json'), true);

                    if ($data) {
                        foreach ($data as $key => $value) {
                            if (!isset($translationsData[$site]['non_manual'][$key])) {
                                if ($value != '') {
                                    $translationsData[$site]['non_manual'][$key][$language->code] = $value;
                                }
                            }
                        }
                    }
                }

                if (Storage::disk($disk)->exists($language->code . '_manual.json')) {
                    $data = json_decode(Storage::disk($disk)->get($language->code . '_manual.json'), true);

                    if ($data) {
                        foreach ($data as $key => $value) {
                            if (!isset($translationsData[$site]['manual'][$key])) {
                                if ($value != '') {
                                    $translationsData[$site]['manual'][$key][$language->code] = $value;
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($translationsData as $site => $data) {
            $disk = $site == 'admin' ? 'lang' : 'client_lang';
            foreach ($data as $manual => $translation) {
                $manual = $manual == 'manual' ? '_manual' : '';
                foreach ($translation as $keyName => $lang_val) {
                    foreach ($lang_val as $from => $value) {
                        foreach (Language::all() as $language) {
                            $to = $language->code;

                            if ($from == $to) {
                                continue;
                            }

                            $this->info("make translations for key '{$keyName}' from {$from} to {$to}");

                            $toArray = [];

                            try {
                                $toArray[$keyName] = $translate->translate($value, $to)['translated_text'] ?? $value;

                                $oldTranslations = Storage::disk($disk)->exists($to . $manual . '.json') ? json_decode(Storage::disk($disk)->get($to . $manual . '.json'), true) : [];

                                Storage::disk($disk)->put($to . $manual . '.json', json_encode(array_merge($oldTranslations, $toArray)));

                                $this->info('success');
                            } catch (\Exception $exception) {
                                $this->error('invalid language');
                            }
                        }
                    }

                }
            }
        }

        foreach (Language::all() as $language) {
            $this->info("sync translation for {$language->code} language");
            try {
                $response = Http::post(env('CLIENT_SITE_URL') . 'translations?api_token=' . User::whereNotNull('api_token')->first()->api_token, [
                    'translations' => [
                        $language->code => Storage::disk('client_lang')->exists($language->code . '.json') ? json_decode(Storage::disk('client_lang')->get($language->code . '.json'), true) : []
                    ]
                ])->json();
            } catch (\Exception $exception) {

            }
            sleep(2);
        }

        return Command::SUCCESS;
    }
}
