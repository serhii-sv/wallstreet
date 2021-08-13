<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Requests\RequestRateStoreUpdate;
use App\Models\Rate;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

/**
 * Class RateController
 * @package App\Http\Controllers
 */
class RateController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rates = Rate::all();
        return view('pages.rates.index', compact('rates'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.rates.create');
    }

    /**
     * @param RequestRateStoreUpdate $request
     * @return $this|RedirectResponse
     */
    public function store(RequestRateStoreUpdate $request)
    {
        $rate = Rate::create($request->all());

        if (!$rate) {
            return back()->with('error_short', __('Невозможно созать тариф'))->withInput();
        }

        return redirect()->route('rates.index')->with('success_short', __('Тариф создан успешно'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $rate = Rate::findOrFail($id);
        return view('pages.rates.show', [
            'rate' => $rate
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $rate = Rate::findOrFail($id);
        return view('pages.rates.edit', [
            'rate' => $rate
        ]);
    }

    /**
     * @param RequestRateStoreUpdate $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RequestRateStoreUpdate $request, $id)
    {
        $rate = Rate::findOrFail($id);
        $rate->update($request->all());

        if (!$rate) {
            return back()->with('error_short', __('Невозможно обновить тариф'))->withInput();
        }

        return redirect()->route('rates.index')->with('success_short', __('Тариф успешно обновлен'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $rate = Rate::findOrFail($id);

        if ($rate->delete()) {
            return redirect()->route('rates.index')->with('success_short', __('Тариф был успешно удален'));
        }

        return redirect()->route('rates.index')->with('error_short', __('Невозможно удалить тариф'));
    }
}
