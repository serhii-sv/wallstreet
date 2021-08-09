<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationTemplates;
use App\Models\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NotificationsController extends Controller
{

    public function index(Request $request)
    {
        $filter_type = $request->get('type') ? $request->get('type') : false;
        $notifications = Notification::when($filter_type, function($query) use ($filter_type){
            return $query->where('type_id', $filter_type);
        })->orderByDesc('created_at')->paginate(10);
    
        $notification_types = NotificationType::all();
        $notifications_count = Notification::count();

    
        return view('pages.notifications.index', compact(
            'notifications',
            'notification_types',
            'notifications_count',
         
        ));
    }

 
    public function create()
    {
        $notification_templates = NotificationTemplates::all();
        return view('pages.notifications.create',compact(   'notification_templates'));
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
