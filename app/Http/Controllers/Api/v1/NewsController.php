<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/api/v1/news",
     *      summary="News",
     *      description="News list",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          @OA\Schema(
     *              type="integer", example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="current_page", type="integer", example="1"),
     *                  @OA\Property(
     *                      property="data",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                          @OA\Property(property="title", type="string", example="Lorem ipsum"),
     *                          @OA\Property(property="content", type="string", example="Lorem ipsum"),
     *                          @OA\Property(property="short_content", type="string", example="Lorem ipsum"),
     *                          @OA\Property(property="image", type="string", example="Lorem ipsum"),
     *                          @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                          @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                      )
     *                  )
     *              ),
     *              @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/v1/news?page=1"),
     *              @OA\Property(property="from", type="integer", example="1"),
     *              @OA\Property(property="last_page", type="integer", example="1"),
     *              @OA\Property(property="last_page_url", type="string", example="http://localhost:8000/api/v1/news?page=1"),
     *              @OA\Property(property="next_page_url", type="string", example="http://localhost:8000/api/v1/news?page=1"),
     *              @OA\Property(property="path", type="string", example="http://localhost:8000/api/v1/news"),
     *              @OA\Property(property="per_page", type="integer", example="10"),
     *              @OA\Property(property="prev_page_url", type="string", example="http://localhost:8000/api/v1/news?page=1"),
     *              @OA\Property(property="to", type="integer", example="8"),
     *              @OA\Property(property="total", type="integer", example="8"),
     *             )
     *         )
     *      )
     * )
     */
    public function index()
    {
        $news = News::paginate(self::API_PAGINATION);

        $news->each(function ($item) {
            $item->image = $item->image ? Storage::disk('do_spaces')->url($item->image) : null;
            $item->content = $item->content[\App\Models\Language::getDefault()->code] ?? null;
            $item->title = $item->title[\App\Models\Language::getDefault()->code] ?? null;
            $item->short_content = $item->short_content[\App\Models\Language::getDefault()->code] ?? null;
        });

        return response()->json([
            'status' => 200,
            'data' => $news
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/news/{news_id}",
     *      summary="News",
     *      description="News item",
     *      @OA\Parameter(
     *          name="api_token",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="SYejxLCIpdK3RU7ed2ijjqfIyM0mrbtuiY5ccQA6J0f5ipuSGmupRt3tnmbU"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="news_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string", example="123e4567-e89b-12d3-a456-426655440000"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="objsct",
     *                  @OA\Property(property="id", type="string", example="123e4567-e89b-12d3-a456-426655440000"),
     *                  @OA\Property(property="title", type="string", example="Lorem ipsum"),
     *                  @OA\Property(property="content", type="string", example="Lorem ipsum"),
     *                  @OA\Property(property="short_content", type="string", example="Lorem ipsum"),
     *                  @OA\Property(property="image", type="string", example="Lorem ipsum"),
     *                  @OA\Property(property="created_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *                  @OA\Property(property="updated_at", type="date-time", example="2021-09-07T05:44:44.000000Z"),
     *             )
     *         )
     *      )
     * )
     */
    public function show($id)
    {
        $item = News::find($id);

        if (!is_null($item)) {
            return response()->json([
                'status' => 404,
                'message' => 'Новость не найдена'
            ], 404);
        }

        $item->image = $item->image ? Storage::disk('do_spaces')->url($item->image) : null;
        $item->content = $item->content[\App\Models\Language::getDefault()->code] ?? null;
        $item->title = $item->title[\App\Models\Language::getDefault()->code] ?? null;
        $item->short_content = $item->short_content[\App\Models\Language::getDefault()->code] ?? null;

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }
}
