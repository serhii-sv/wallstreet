<?php

namespace App\Http\Controllers;

use App\Models\TelegramChat;
use App\Services\TelegramService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var TelegramService
     */
    var $telegramService;

    /**
     *
     */
    public function __construct()
    {
        $this->telegramService = new TelegramService();
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {

            $all = $request->all();
            $message = $all['message'];
            $chat_id = $message['chat']['id'];
            $text = $message['text'];

            if (TelegramChat::where('chat_id', $chat_id)->exists()) {
                $this->telegramService->sendMessage($chat_id, 'Привет! В данный момент, я умею только уведомлять!');
            } else {
                if ($text == '/start') {
                    $this->telegramService->sendMessage($chat_id, 'Привет, пользователь! Для авторизации введите ваш имейл и пароль в следующем формате: example@email.com::password123');
                } else {
                    $this->runAuth($chat_id, $text);
                }
            }
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            Log::info($exception->getFile());
            Log::info($exception->getLine());
        }

    }

    /**
     * @param $chat_id
     * @param $text
     */
    public function runAuth($chat_id, $text)
    {
        if (strlen($text) > 10) {

            list($email, $password) = explode('::', $text);

            if (!$this->attemptLogin(new Request(['email' => $email, 'password' => $password]))) {
                $this->telegramService->sendMessage($chat_id, 'Неверное имя пользователя или пароль.');
            }

            $user = $this->guard()->user();

            TelegramChat::create([
                'user_id' => $user->id,
                'chat_id' => $chat_id,
                'active' => true
            ]);

            $this->telegramService->sendMessage($chat_id, ' Авторизация прошла успешно! Ожидайте уведомления из системы...');
        }
    }
}
