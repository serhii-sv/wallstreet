<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_content' => 'required|string|min:3|max:255'
        ]);

        if ($validator->errors()->count()) {
            return back()->with('error_short', $validator->errors()->messages()['task_content'][0])->withInput();
        }

        $task = auth()->user()->tasks()->create([
            'content' => $request->task_content
        ]);

        if ($task) {
            return back()->with('success_short', 'Задача создана');
        }
        return back()->with('error_short', 'Задача не создана')->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $task = Task::findOrFail($id);

        $task = $task->update([
            'done' => true
        ]);

        if ($task) {
            return back()->with('success_short', 'Задача завершена');
        }
        return back()->with('error_short', 'Задача не завершена');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->delete()) {
            return back()->with('success_short', 'Задача удалена');
        }
        return back()->with('error_short', 'Задача не удвлена');
    }
}
