<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Notification;
use App\Models\NotificationTemplates;
use App\Models\NotificationType;
use App\Models\NotificationUser;
use App\User;
use Illuminate\Http\Request;
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
        ]);
        DB::beginTransaction();
        try {
            $notification = new Notification();
            $notify_types = $notification->getTypes();
            $email = false;
            $email_text = '';
            $notify_browser = false;
            $notify_text = '';
            $subject = $request->get('subject');
            foreach ($request->get('type') as $type) {
                $request->validate([
                    $notify_types[$type]['input'] => 'required',
                ], [
                    $notify_types[$type]['input'] . '.required' => $notify_types[$type]['required'],
                ]);
                if ($notify_types[$type]['name'] == 'Email') {
                    $email = true;
                    $email_text = $request->get($notify_types[$type]['input']);
                }
                if ($notify_types[$type]['name'] == 'Браузер') {
                    $notify_browser = true;
                    $notify_text = $request->get($notify_types[$type]['input']);
                }
            }
            $users = User::findMany($request->get('users'));
            if ($notify_browser){
                $notification->name = $request->get('name');
                $notification->subject = $subject;
                $notification->text = $notify_text;
                $notification->type_browser = true;
                $notification->save();
                $notification_id = $notification->id;
            }
            foreach ($users as $user) {
                if ($notify_browser){
                    $notification_user = new NotificationUser();
                    $notification_user->user_id = $user->id;
                    $notification_user->notification_id = $notification_id;
                    $notification_user->save();
                }
                if ($email) {
                    Mail::to($user)->send(new NotificationMail($user, $subject, $email_text));
                }
            }
            DB::commit();
            return redirect()->back()->with('success', "Уведомление отправлено!")->with('success_short', "Уведомление отправлено!");
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Произошла ошибка! '.$exception->getMessage());
        }
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
}
