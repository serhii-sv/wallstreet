<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $banners = Banner::orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            $recordsFiltered = $banners->count();
            $banners->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($banners->get() as $banner) {
                $data[] = [
                    'empty' => '',
                    'title' => $banner->title,
                    'size' => $banner->size,
                    'image' => view('pages.banners.partials.example-image', compact('banner'))->render(),
                    'actions' => view('pages.banners.partials.actions', compact('banner'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Banner::count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.banners.index');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.banners.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('pages.banners.edit', compact('banner'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'size' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $banner = Banner::create([
            'title' => $request->title,
            'size' => $request->size,
        ]);

        if ($request->has('image') && $banner) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'banners', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $banner->update([
                'image' => $upload
            ]);
        }

        if ($banner) {
            return redirect(route('referrals-and-banners.index', ['#banners']))->with('success_short', 'Баннер добавлен');
        }

        return back()->with('error_short', 'Баннер не добавлен')->withInput($request->input());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'size' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $banner = Banner::findOrfail($id);

        $banner->update([
            'title' => $request->title,
            'size' => $request->size,
        ]);

        if ($request->has('image') && $banner) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'banners', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $banner->update([
                'image' => $upload
            ]);
        }

        if ($banner) {
            return redirect(route('referrals-and-banners.index', ['#banners']))->with('success_short', 'Баннер изменен');
        }

        return back()->with('error_short', 'Баннер не изменен')->withInput($request->input());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if ($banner->delete()) {
            return redirect()->route('referrals-and-banners.index', ['#banners'])->with('success_short', __('Баннер удален'));
        }

        return redirect()->route('referrals-and-banners.index', ['#banners'])->with('error_short', __('Баннер не удален'));
    }
}
