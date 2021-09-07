<?php

namespace App\Http\Controllers;


use App\Events\AdminCommonChat;

use App\Models\AdminChat;
use App\Models\AdminChatMessage;
use App\Models\AdminCommonChatMessage;
use App\Models\AdminCommonChatUsers;
use App\Models\ChatMessage;
use App\Models\ModelHasPermission;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    public function index($id = null) {
        $permission = Permission::where('slug', 'chat')->first();
        $users = [];
        $model_has_permissions = ModelHasPermission::where('permission_id', $permission->id)->get();
        foreach ($model_has_permissions as $item) {
            if ($item->model_id !== Auth::user()->id) {
                $users[] = $item->user;
            }
        }
        $myAvatar = Auth()->user()->avatar ? route('user.get.avatar', auth()->user()->id) : asset('images/user.png');
        
        if ($id === null) {
            $chat = false;
            $messages = AdminCommonChatMessage::orderBy('created_at', 'asc')->paginate(200);
            $commonMessages = AdminCommonChatUsers::where('user_id', Auth::user()->id)->where('is_read', false)->get();
            if (!empty($commonMessages)) {
                foreach ($commonMessages as $commonMessage) {
                    $commonMessage->update(['is_read' => true]);
                }
            }
            $companion = false;
        } else {
            $chat = AdminChat::where('id', $id)->firstOrFail();
            $chat->user_1 == Auth::user()->id ? $companion = User::where('id', $chat->user_2)->first() : $companion = User::where('id', $chat->user_1)->first();
            $messages = AdminChatMessage::where('chat_id', $id)->paginate(200);
            $chatMessages = AdminChatMessage::where('user_id', '!=', Auth::user()->id)->where('is_read', false)->get();
            if (!empty($chatMessages)) {
                foreach ($chatMessages as $chatMessage) {
                    $chatMessage->update(['is_read' => true]);
                }
            }
        }
        
        return view('pages.chat.index', [
            'messages' => $messages,
            'myAvatar' => $myAvatar,
            'users' => $users,
            'chat' => $chat,
            'companion' => $companion,
        ]);
    }
    
    public function sendCommonMessage(Request $request) {
        if ($request->post('type') == 'message') {
            $permission = Permission::where('slug', 'chat.send.message')->first();
            $model_has_permission = ModelHasPermission::where('permission_id', $permission->id)->where('model_id', $request->post('user_id'))->first();
            if (!empty($model_has_permission)) {
                $msg = $request->post('message');
                if (strlen($msg) > 0) {
                    $message = new AdminCommonChatMessage();
                    $message->user_id = $request->post('user_id');
                    $message->message = $msg;
                    $message->save();
                    broadcast(new AdminCommonChat($msg, $request->post('user_id'), $message->id));
                    $permission = Permission::where('slug', 'chat')->first();
                    $users = [];
                    $model_has_permissions = ModelHasPermission::where('permission_id', $permission->id)->get();
                    foreach ($model_has_permissions as $item) {
                        if ($item->model_id !== Auth::user()->id) {
                            $users[] = $item->user;
                        }
                    }
                    foreach ($users as $user) {
                        $status = new AdminCommonChatUsers();
                        $status->message_id = $message->id;
                        $status->user_id = $user->id;
                        $status->save();
                    }
                }
            }
        }
    }
    
    public function readCommonChatMessage(Request $request) {
        $user_id = $request->post('user_id');
        $message_id = $request->post('message_id');
        $message = AdminCommonChatUsers::where('message_id', $message_id)->firstOrFail();
        if ($message->user_id == $user_id) {
            $message->update(['is_read' => true]);
            return 'upd';
        }
        return 'not upd';
    }
    
    public function sendMessage(Request $request) {
        if ($request->post('type') == 'message') {
            $chat_id = $request->post('chat_id');
            $msg = $request->post('message');
            if (strlen($msg) > 0) {
                $chat = AdminChat::where('id', $chat_id)->first();
                if (!empty($chat)) {
                    $message = new AdminChatMessage();
                    $message->chat_id = $chat_id;
                    $message->user_id = $request->post('user_id');
                    $message->message = $msg;
                    $message->is_read = false;
                    $message->save();
                    broadcast(new \App\Events\AdminChat($request->post('user_id'), $message->id));
                } else {
                    $message = false;
                }
                
            }
        }
    }
    
    public function readMessage(Request $request) {
        $user_id = $request->post('user_id');
        $message_id = $request->post('message_id');
        $message = AdminChatMessage::where('id', $message_id)->firstOrFail();
        if ($message->user_id !== $user_id) {
            $message->update(['is_read' => true]);
            return 'upd';
        }
        return 'not upd';
    }
    
    public function deleteCommonMessage(Request $request) {
        $message_id = $request->post('id');
        $user_id = $request->post('user_id');
        $message = AdminCommonChatMessage::where('user_id', $user_id)->where('id', $message_id)->first();
        if (!empty($message)) {
            AdminCommonChatUsers::where('message_id', $message->id)->delete();
            $message->delete();
            broadcast(new AdminCommonChat("Сообщение удалено", $user_id, $message->id, 'delete'));
            return 'deleted';
        }
    }
    
    public function deleteMessage(Request $request) {
        $message_id = $request->post('id');
        $user_id = $request->post('user_id');
        $message = AdminChatMessage::where('user_id', $user_id)->where('id', $message_id)->first();
        if (!empty($message)) {
            $chat_id = $message->chat_id;
            $message->delete();
            broadcast(new \App\Events\AdminChat($user_id, $message_id, "delete", $chat_id));
            return 'deleted';
        }
    }
}
