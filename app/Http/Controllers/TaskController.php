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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $result = $task->update([
            'done' => $request->status == 'true'
        ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => $request->status == 'true' ? 'Задача завершена' : 'Задача повторно открыта'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Задача не завершена'
        ]);
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
