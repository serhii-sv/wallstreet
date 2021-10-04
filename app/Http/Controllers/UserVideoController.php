<?php

namespace App\Http\Controllers;

use App\Models\UserVideo;
use Illuminate\Http\Request;

class UserVideoController extends Controller
{
    
    public function index($id = null) {
        if ($id) {
            $video = UserVideo::findOrFail($id);
            return view('pages.user-videos.show', [
                'video' => $video,
            ]);
        } else {
            return view('pages.user-videos.index', [
                'videos' => UserVideo::orderByDesc('created_at')->paginate(12),
            ]);
        }
    }
    
    public function save(Request $request, $id) {
        $request->validate([
            'link' => 'required',
        ]);
        $video = UserVideo::findOrFail($id);
        $video->update([
            'link' => $request->get('link')
        ]);
        return back()->with('success', 'Сохранено');
    }
    
    public function confirm($id) {
        $video = UserVideo::findOrFail($id);
        $video->update([
            'approved' => true
        ]);
        return back()->with('success', 'Видео подтверждено');
    }
    public function cancel($id) {
        $video = UserVideo::findOrFail($id);
        $video->update([
            'approved' => false
        ]);
        return back()->with('success', 'Видео отклонено');
    }
    
    public function delete($id) {
        UserVideo::findOrFail($id)->delete();
        return back()->with('success', 'Видео удалено!');
    }
}
