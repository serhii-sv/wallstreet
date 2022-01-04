<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewReplenishmentRequest extends Notification
{
    use Queueable;

    /**
     * @var
     */
    private $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    /**
     * @param $notifiable
     * @return \NotificationChannels\Telegram\TelegramContact|\NotificationChannels\Telegram\TelegramFile|\NotificationChannels\Telegram\TelegramLocation|TelegramMessage|\NotificationChannels\Telegram\TelegramPoll|\NotificationChannels\Telegram\Traits\HasSharedLogic
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content('Пользователь ' . $this->transaction->user->login . ' (тимлидер: ' . ($this->transaction->_teamleader->login ?? 'Не указан') . ' оставил заявку №' .
                $this->transaction->int_id . ' на пополнение на сумму: ' . $this->transaction->currency->symbol . $this->transaction->amount)
            ->button('Список заявок на пополнение', url('/replenishments'));
    }
}
