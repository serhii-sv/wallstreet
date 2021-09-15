<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportTaskController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/v1/support-tasks",
     * summary="Support tasks",
     * description="Create support task",
     *  @OA\Parameter(
     *      name="page",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer", example={1,2,3}
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="123e4567-e89b-12d3-a456-426655440000"
     *      )
     *   ),
     *     @OA\Parameter(
     *      name="api_token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *      )
     *   ),
     *     @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *       @OA\Property(property="title", type="string", example="Test support task title"),
     *       @OA\Property(property="description", type="string", example="Test support task description"),
     *       @OA\Property(property="status", type="string", example="pending")
     * )
     * ),
     * @OA\Response(
     *     response=422,
     *     description="Validation error",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="The given data was invalid."),
     *        @OA\Property(
     *           property="errors",
     *           type="object",
     *           @OA\Property(
     *              property="title",
     *              type="array",
     *              collectionFormat="multi",
     *              @OA\Items(
     *                 type="string",
     *                 example="The title field is required.",
     *              )
     *           ),
     *          @OA\Property(
     *              property="description",
     *              type="array",
     *              collectionFormat="multi",
     *              @OA\Items(
     *                 type="string",
     *                 example="The description field is required.",
     *              )
     *           ),
     *
     *        ),
     *     )
     *  )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $supportTask = auth()->user()->supportTasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($supportTask) {
            return response()->json([
                'status' => 200,
                'data' => $supportTask
            ]);
        }

        return response()->json([
            'status' => 400,
            'errors' => [
                'task' => [
                    'Задача не была создана'
                ]
            ]
        ]);
    }
}
