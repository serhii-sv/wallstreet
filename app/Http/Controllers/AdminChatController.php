<?php

namespace App\Http\Controllers;

use App\Events\AdminChat;
use App\Events\PrivateChat;
use App\Models\AdminChatMessage;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
    public function index() {
        
        $myAvatar = Auth()->user()->avatar ? route('user.get.avatar', auth()->user()->id) : asset('images/user.png');
        
        return view('pages.chat.index', [
            'messages' => AdminChatMessage::orderBy('created_at', 'asc')->paginate(200),
            'myAvatar' => $myAvatar,
        ]);
    }
    
    public function sendMessage(Request $request) {
        if ($request->post('type') == 'message') {
            $msg = $request->post('message');
            if (strlen($msg) > 0) {
                $message = new AdminChatMessage();
                $message->user_id = $request->post('user_id');
                $message->message = $msg;
                $message->save();
                broadcast(new AdminChat($msg, $request->post('user_id'), $message->id));
   
            }
        }
    }
}
