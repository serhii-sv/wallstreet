<?php

namespace App\Http\Controllers;

use App\Models\SupportTask;
use Illuminate\Http\Request;

class SupportTaskController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
           $supportTasks = SupportTask::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $supportTasks->count();
            $supportTasks->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($supportTasks->get() as $supportTask) {
                $data[] = [
                    'title' => $supportTask->title,
                    'description' => $supportTask->description,
                    'email' => view('pages.support-tasks.partials.user-item', compact('supportTask'))->render(),
                    'status' => view('pages.support-tasks.partials.status', compact('supportTask'))->render(),
                    'created_at' => $supportTask->created_at->format('d-m-Y H:i'),
                    'actions' => view('pages.support-tasks.partials.actions', compact('supportTask'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => SupportTask::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.support-tasks.index');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $supportTask = SupportTask::findOrFail($id);
        return view('pages.support-tasks.show', compact('supportTask'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function close($id)
    {
        $supportTask = SupportTask::findOrFail($id);

        $result = $supportTask->update([
            'status' => SupportTask::CLOSED_STATUS
        ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Задача завершена'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Задача не завершена'
        ]);
    }
}
