<?php

namespace App\Events;

use App\Models\AdminChatMessage;
use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message;
    public $message_id;
    public $user;
    public $chat_id;
    public $type;
    
    public function __construct($user, $message_id, $type = "message", $chat_id = '') {
        if ($type == 'delete') {
            $this->chat_id = $chat_id;
            $this->message = 'Удалено';
            $this->message_id = $message_id;
            $this->user = $user;
            $this->type = $type;
        }
        if ($type == 'message') {
            $chatMessage = AdminChatMessage::find($message_id);
            $this->chat_id = $chatMessage->chat_id;
            $this->user = $chatMessage->user_id;
            $this->message = $chatMessage->message;
            $this->message_id = $chatMessage->id;
            $this->type = $type;
        }
    }
    
    public function broadcastOn() {
        return new PresenceChannel('chat.' . $this->chat_id);
    }
    
    public function broadcastWith() {
        return [
            'user' => $this->user,
            'type' => $this->type,
            'chat_id' => $this->chat_id,
            'message' => $this->message,
            'message_id' => $this->message_id,
        ];
    }
}
