<?php

namespace App\Http\Controllers;

use App\Models\SupportTask;
use Illuminate\Http\Request;

class SupportTaskMessageController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $supportTask = SupportTask::findOrFail($id);

        $request->validate([
            'message' => 'required|string|min:1'
        ]);

        $result = $supportTask->messages()->create([
            'message' => $request->message,
            'user_id' => auth()->user()->id
        ]);

        $supportTask->update([
            'status' => SupportTask::ANSWERED_STATUS
        ]);

        if ($result) {
            return back()->with('success_short', 'Сообщние отправлено');
        }

        return back()->with('error_short', 'Сообщние не отправлено')->withInput($request->input());
    }
}
