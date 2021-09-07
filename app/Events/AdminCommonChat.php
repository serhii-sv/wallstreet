<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminCommonChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message;
    public $user_id;
    public $message_id;
    public $type;
    
    public function __construct($message, $user_id, $message_id = null, $type = 'message') {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->message_id = $message_id;
        $this->type = $type;
    }
    
    
    public function broadcastOn() {
        return new PresenceChannel('chat');
    }
    
    public function broadcastWith() {
        return [
            'user_id' => $this->user_id,
            'type' => $this->type,
            'message' => $this->message,
            'message_id' => $this->message_id,
            'avatar' => User::where('id', $this->user_id)->first()->avatar ? route('user.get.avatar', $this->user_id) : asset('images/user.png'),
        ];
    }
    
}
