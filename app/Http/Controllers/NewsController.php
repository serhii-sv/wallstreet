<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(9);

        return view('pages.news.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::all();
        return view('pages.news.create', compact('languages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $defaultLanguage = Language::where('default', 1)->first();

        $rules = [];
        $fields = ['title', 'short_content', 'content'];

        foreach ($fields as $field) {
            $rules[$field . '.' . $defaultLanguage->code] = 'required';
        }

        $request->validate($rules);

        $item = News::create($request->except(['_token']));

        if ($request->has('image') && $item) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'news', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $item->update([
                'image' => $upload
            ]);
        }

        if ($item) {
            return redirect(route('news.index'))->with('success_short', 'Новость создана');
        }

        return back()->with('error_short', 'Новость не создана')->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('pages.news.show', compact('item'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $item = News::findOrFail($id);
        $languages = Language::all();
        return view('pages.news.edit', compact('item', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $item = News::findOrFail($id);
        $defaultLanguage = Language::where('default', 1)->first();

        $rules = [];
        $fields = ['title', 'short_content', 'content'];

        foreach ($fields as $field) {
            $rules[$field . '.' . $defaultLanguage->code] = 'required';
        }

        $request->validate($rules);

        $item->update($request->except(['_token']));

        if ($request->has('image') && $item) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'news', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $item->update([
                'image' => $upload
            ]);
        }

        if ($item) {
            return redirect(route('news.index'))->with('success_short', 'Новость обновлена');
        }

        return back()->with('error_short', 'Новость не обновлена')->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = News::findOrFail($id);
        if ($item->delete()) {
            return redirect()->route('news.index')->with('success', __('Новость удалена'));
        }
        return back()->with('error', __('Новочть не удалена'));
    }
}
