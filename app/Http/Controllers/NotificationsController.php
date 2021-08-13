<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Notification;
use App\Models\NotificationTemplates;
use App\Models\NotificationType;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class NotificationsController extends Controller
{
    
    public function index(Request $request) {
        $filter_type = $request->get('type') ? $request->get('type') : false;
        $notifications = Notification::when($filter_type, function ($query) use ($filter_type) {
            return $query->where('type_id', $filter_type);
        })->orderByDesc('created_at')->paginate(10);
        
        $notifications_count = Notification::count();
        
        return view('pages.notifications.index', compact('notifications', 'notifications_count',
        
        ));
    }
    
    
    public function create() {
        $notifications = new Notification();
        $notification_types = $notifications->getTypes();
        return view('pages.notifications.create', compact('notification_types'));
    }
    
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'users' => 'required',
            'type' => 'required',
            'text' => 'required',
        ], [
            'text.required' => 'Поле "Текст уведомления" необходимо заполнить',
        ]);
        DB::beginTransaction();
        $text = strip_tags(htmlspecialchars_decode(html_entity_decode($request->get('text'))));
        $text = str_replace([
            "\t",
            "\r",
            "\n",
        ], "", $text);
        $email_text = $request->get('text');
        try {
            $notification = new Notification();
            $notify_types = $notification->getTypes();
            $email = false;
            $notify_browser = false;
            $subject = $request->get('subject');
            foreach ($request->get('type') as $type) {
                if ($notify_types[$type]['name'] == 'Email') {
                    $email = true;
                }
                if ($notify_types[$type]['name'] == 'Браузер') {
                    $notify_browser = true;
                }
            }
            $users = User::findMany($request->get('users'));
            if ($notify_browser) {
                $notification->name = $request->get('name');
                $notification->subject = $subject;
                $notification->text = $text;
                $notification->type_browser = true;
                $notification->save();
                $notification_id = $notification->id;
            }
            foreach ($users as $user) {
                if ($notify_browser) {
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $user->id;
                    $notification_user->notification_id = $notification_id;
                    $notification_user->save();
                }
                if ($email) {
                    Mail::to($user)->send(new NotificationMail($user, $subject, $email_text));
                    if (!Mail::failures()) {
                        $email_sent[] = $user->email . ' - отправлено';
                    } else {
                        $email_sent[] = $user->email . ' - не отправлено';
                    }
                }
            }
            if ($email) {
                $email_sent = collect($email_sent);
                session()->flash('mail_sent', $email_sent);
            }
            DB::commit();
            return redirect()->back()->with('success', "Уведомление отправлено!");
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Произошла ошибка! ' . $exception->getMessage())->withInput();
        }
    }
    
    public function showPreview(Request $request) {
        return view('mail.preview', [
            'preview' => $this->makeMessageHtml(Auth::user(), $request->get('preview')),
        ]);
    }
    
    private function makeMessageHtml(User $user, $preview) {
        $markdown = Container::getInstance()->make(Markdown::class);
        
        return $markdown->render('mail.markdown', [
            'text' => $preview,
            'user' => $user,
        ]);
    }
    
    public function show($id) {
        //
    }
    
    
    public function edit($id) {
        //
    }
    
    public function update(Request $request, $id) {
        //
    }
    
    public function destroy($id) {
        //
    }
    
    public function setReadStatus(Request $request) {
        $id = $request->get('id');
        $user_notification = NotificationUser::where('id', $id)->where('user_id', Auth::user()->id)->where('is_read', false)->first();
        if (empty($user_notification))
            return json_encode([
                'status' => 'bad',
                'msg' => 'Такого уведомления не существует',
            ]);
        $user_notification->is_read = true;
        if ($user_notification->save()){
            return json_encode([
                'status' => 'good',
                'msg' => 'Статус уведомления изменён!',
                'notification_count' => NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->count(),
            ]);
        }
    
        return json_encode([
            'status' => 'bad',
            'msg' => 'Неведомая ошибка',
        ]);
    }
}
