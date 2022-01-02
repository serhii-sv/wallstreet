<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    /**
     * @var string
     */
    private $url = 'https://api.telegram.org/bot';

    /**
     * @param $chat_id
     * @param $text
     */
    public function sendMessage($chat_id, $text)
    {
        file_get_contents($this->url . env('TELEGRAM_BOT_TOKEN') . "/sendmessage?" . http_build_query([
                'chat_id' => $chat_id,
                'text' => $text
            ])
        );
    }

    /**
     * Set telegram bot webhook if needed
     *
     * @return array|false[]|mixed
     */
    public static function setWebhook()
    {
        $self = new self();

        $deleteUrl = $self->url . env('TELEGRAM_BOT_TOKEN') . '/deleteWebhook';
        \Log::critical($deleteUrl);
        $response = Http::get($deleteUrl)->json();

        if ($response['ok'] && isset($response['description']) &&
            ($response['description'] == 'Webhook was deleted' || $response['description'] == 'Webhook is already deleted')) {
            $url = $self->url . env('TELEGRAM_BOT_TOKEN') . '/setWebhook?' . http_build_query([
                    'url' => config('app.url') . '/telegram'
                ]);
            \Log::critical($url);
            return Http::get($url)->json();
        }

        return [
            'ok' => false
        ];
    }
}
