<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class TransactionAccepted extends Notification
{
    use Queueable;

    /**
     * @var
     */
    private $transaction;

    /**
     * @var
     */
    private $transaction_type;

    /**
     * @var
     */
    private $approver;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction, $transaction_type, $approver)
    {
        $this->transaction = $transaction;
        $this->transaction_type = $transaction_type;
        $this->approver = $approver;
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
        $user = $this->approver;
        $type = '';

        switch ($this->transaction_type) {
            case 'withdrawals':
                $type = 'вывод средств';
                break;
            case 'replenishments':
                $type = 'пополнение кошелька';
                break;
        }
        $message = 'Заявка №' . $this->transaction->int_id . ' на ' . $type . ' от пользователя ' . $this->transaction->user->login . ' (тимлидер: ' . ($this->transaction->_teamleader->login ?? 'Не указан') . ') была изменена пользователем ' . $user->login;

        return TelegramMessage::create()
            ->content($message)
            ->button('Список заявок на ' . $type, url('/' . $this->transaction_type));
    }
}
