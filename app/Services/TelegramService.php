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

        $response = Http::get($self->url . env('TELEGRAM_BOT_TOKEN') . '/deleteWebhook')->json();

        if ($response['ok'] && isset($response['description']) &&
            ($response['description'] == 'Webhook was deleted' || $response['description'] == 'Webhook is already deleted')) {
            return Http::get($self->url . env('TELEGRAM_BOT_TOKEN') . '/setWebhook?' . http_build_query([
                    'url' => config('app.url') . '/telegram'
                ])
            )->json();
        }

        return [
            'ok' => false
        ];
    }
}
