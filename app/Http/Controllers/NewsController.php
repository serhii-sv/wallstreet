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
        $news = News::paginate(9);

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
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(News $news)
    {
        $newsLangs = NewsLang::where('news_id', $news->id)->get();
        $newsKeys = collect([
            'lang_id',
            'lang_code',
            'lang_name',
            'title',
            'teaser',
            'text',
            'created_at'
        ]);

        foreach (getLanguagesArray() as $lang) {
            if ($newsValues = $newsLangs->where('lang_id', $lang['id'])->first()) {
                $newsValuesCollect = collect([$lang['id'], $lang['code'], $lang['name'], $newsValues->title, $newsValues->teaser, $newsValues->text, $newsValues->created_at]);
            } else {
                $newsValuesCollect = collect([$lang['id'], $lang['code'], $lang['name'], '', '', '', '']);
            }
            $data[] = $newsKeys->combine($newsValuesCollect);
        }
        $data = collect($data);

        return view('admin/news/edit', [
            'newsData' => $data,
            'news' => $news,
            'img' => '/news_img/' . $news->img,
        ]);
    }

    /**
     * @param Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, News $news)
    {
        $slug = str_slug($request->input('title_' . Language::getDefault()->code));

        if ($news->update(['slug' => $slug])) {
            $translations = NewsLang::where('news_id', $news->id)->get();

            foreach (getLanguagesArray() as $lang) {
                if ($translation = $translations->where('lang_id', $lang['id'])->first()) {
                    $translation->update([
                        'title' => $request->input('title_' . $lang['code']),
                        'teaser' => $request->input('teaser_' . $lang['code']),
                        'text' => $request->input('text_' . $lang['code']),
                    ]);
                } else {
                    NewsLang::create([
                        'title' => $request->input('title_' . $lang['code']),
                        'teaser' => $request->input('teaser_' . $lang['code']),
                        'text' => $request->input('text_' . $lang['code']),
                        'lang_id' => $request->input('lang_id_' . $lang['code']),
                        'news_id' => $news->id,
                    ]);
                }
            }

            if ($request->hasFile('img')) {
                $news->addImg($request->file('img'));
            }
            return redirect()->route('admin.news.index')->with('success', __('News has been updated'));
        }
        return back()->with('error', __('Unable to update news'))->withInput();
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect()->route('admin.news.index')->with('success', __('News has been deleted'));
        }
        return back()->with('error', __('Unable to delete news'));
    }
}
