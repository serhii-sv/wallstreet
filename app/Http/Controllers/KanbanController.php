<?php

namespace App\Http\Controllers;

use App\Models\KanbanBoard;
use App\Models\KanbanBoardTask;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $boards = $user->kanbanBoards()->orderBy('order')->with('item')->get();

        $ru_month = array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' );
        $en_month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

        $boards->each(function ($board) use ($ru_month, $en_month) {
           $board->item->each(function (&$item) use ($ru_month, $en_month)  {
               $item->dueDate = str_replace($en_month, $ru_month, $item->created_at->format('F j, Y'));
               $item->border = "blue";
           });
        });

        return view('pages.kanban.index', compact('boards'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function boardStore(Request $request)
    {
        $result = $board = KanbanBoard::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'order' => $request->order
        ]);

        return response()->json([
            'success' => (bool)$result,
            'board' => $board
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function taskStore(Request $request, $id)
    {
        $board = KanbanBoard::findOrFail($id);

        if (is_null($board)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой доски не существует.'
            ]);
        }

        $ru_month = array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' );
        $en_month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

        $result = $board->item()->create([
            'title' => $request->title,
            'order' => $request->order,
        ]);

        $result->dueDate = str_replace($en_month, $ru_month, $result->created_at->format('F j, Y'));
        $result->border = "blue";

        return response()->json([
            'success' => (bool)$result,
            'task' => $result
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeBoard(Request $request, $id)
    {
        $board = KanbanBoard::findOrFail($id);

        if (is_null($board)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой доски не существует.'
            ]);
        }

        $task = KanbanBoardTask::find($request->task_id);

        if (is_null($task)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой задачи не существует.'
            ]);
        }

        $task->update([
            'kanban_board_id' => $id
        ]);

        $tasksData = $request->tasks;

        $tasks = KanbanBoardTask::whereIn('id', array_keys($tasksData))->get();

        foreach ($tasks as $task) {
            $task->update([
                'order' => $tasksData[$task->id]
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortBoards(Request $request)
    {
        $boardsData = $request->boards;

        $boards = KanbanBoard::whereIn('id', array_keys($boardsData))->get();

        foreach ($boards as $board) {
            $board->update([
                'order' => $boardsData[$board->id]
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBoard(Request $request, $id)
    {
        $board = KanbanBoard::find($id);

        if (is_null($board)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой доски не существует.'
            ]);
        }

        $board->update([
            'title' => $request->title
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyBoard($id)
    {
        $board = KanbanBoard::find($id);

        if (is_null($board)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой доски не существует.'
            ]);
        }

        $board->item()->delete();
        $board->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param $id
     * @param $task_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyTask($id, $task_id)
    {
        $board = KanbanBoard::find($id);

        if (is_null($board)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой доски не существует.'
            ]);
        }

        $task = $board->item()->where('id', $task_id)->first();

        if (is_null($task)) {
            return response()->json([
                'success' => false,
                'message' => 'Такой задачи не существует.'
            ]);
        }

        return response()->json([
            'success' => $task->delete()
        ]);
    }
}
