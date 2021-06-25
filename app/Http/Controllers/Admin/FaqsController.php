<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestFaqStore;
use App\Models\Faq;
use App\Http\Controllers\Controller;

class FaqsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.faqs.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * @param RequestFaqStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RequestFaqStore $request)
    {
        if (Faq::create($request->all())) {
            return back()->with('success', __('FAQ has been created'));
        }
        return back()->with('error', __('Unable to create FAQ'))->withInput();
    }

    /**
     * @param Faq $faq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', [
            'faq' => $faq
        ]);
    }

    /**
     * @param RequestFaqStore $request
     * @param Faq $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestFaqStore $request, Faq $faq)
    {
        if ($faq->update($request->all())) {
            return back()->with('success', __('FAQ has been updated'));
        }
        return back()->with('error', __('Unable to update FAQ'))->withInput();
    }

    /**
     * @param Faq $faq
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            return back()->with('success', __('FAQ has been deleted'));
        }
        return back()->with('error', __('Unable to delete FAQ'));
    }
}
