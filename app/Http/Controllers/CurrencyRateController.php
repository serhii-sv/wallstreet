<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $rates = Setting::where('s_key', 'like', '%_to_%');

            $recordsFiltered = $rates->count();
            $rates->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($rates->get() as $rate) {
                $data[] = [
                    'empty' => '',
                    'currency_rate' => $rate->currency_name,
                    'rate' => number_format($rate->s_value, 2, '.',','),
                    'autoupdate' => $rate->autoupdate ? 'Да' : 'Нет',
                    'actions' => view('pages.currency-rates.partials.actions', compact('rate'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $rates->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            return view('pages.currency-rates.index');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $rate = Setting::findOrFail($id);
        return view('pages.currency-rates.edit', compact('rate'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rate = Setting::findOrFail($id);

        $request->validate([
            'rate' => 'required|numeric',
            'autoypdate' => 'in:1,0'
        ]);

        $result = $rate->update([
            's_value' => $request->rate,
            'autoupdate' => $request->autoupdate == '1'
        ]);

        if ($result) {
            return redirect()->route('currency-rates.index')->with('success_short', 'Курс обновлен');
        }

        return back()->with('error_short', 'Курс не обновлен');
    }
}
