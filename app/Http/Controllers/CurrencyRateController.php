<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrencyRateLog;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Setting;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        if (request()->ajax()) {
            $rates = Setting::where('s_key', 'like', '%_to_%');

            $recordsFiltered = $rates->count();
            $rates->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($rates->get() as $rate) {
                $data[] = [
                    'empty' => '',
                    'currency_rate' => $rate->currency_name,
                    'rate' => number_format($rate->s_value, 8, '.', ','),
                    'updated_at' => $rate->updated_at->format('d-m-Y H:i'),
                    'data_source' => 'CoinMarketCap',
                    'autoupdate' => $rate->autoupdate ? 'Да' : 'Нет',
                    'actions' => view('pages.currency-rates.partials.actions', compact('rate'))->render(),
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $rates->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        } else {
            return view('pages.currency-rates.index');
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /*public function edit($id)
    {
        $rate = Setting::findOrFail($id);
        return view('pages.currency-rates.edit', compact('rate'));
    }*/
    public function edit($id) {
        $rate = Setting::findOrFail($id);
        $exchange_rate = ExchangeRate::where('rate_id', $rate->id)->first();
        return view('pages.currency-rates.edit-new', compact('rate', 'exchange_rate'));
    }

    public function update(Request $request, $id) {
        if ($request->post('is_fixed')) {
            $request->validate([
                'rate' => 'required|numeric',
                'autoupdate' => 'in:1,0',
            ]);
        } else {
            $request->validate([
                'rate' => 'required|numeric',
                'autoupdate' => 'in:1,0',
                'is_random' => 'in:1,0',
                'min_rate' => 'required_if:is_random,1',
                'max_rate' => 'required_if:is_random,1',
            ]);
        }

        $rate = Setting::findOrFail($id);
        if (!$request->post('is_fixed')) {
            if ($request->post('is_random')){
                $min_rate = $request->post('min_rate') ?? 0;
                $max_rate = $request->post('max_rate') ?? 0;
            }
            if ($request->post('date_start')){
                $date_start = strtotime($request->post('date_start') . $request->post('time_start'));
                $date_start = date('Y-m-d H:i:s', $date_start);
            }else{
                $date_start = null;
            }
            if ($request->post('date_end')){
                $date_end = strtotime($request->post('date_end') . $request->post('time_end'));
                $date_end = date('Y-m-d H:i:s', $date_end);
            }else{
                $date_end = null;
            }
            $exchange_rate = ExchangeRate::where('rate_id', $rate->id)->first();
            if ($exchange_rate == null){
                $exchange_rate = new ExchangeRate([
                    'rate_id' => $rate->id,
                    'rate' => $request->post('rate'),
                    'is_random' => $request->post('is_random'),
                    'min_rate' => $min_rate ?? 0,
                    'max_rate' => $max_rate ?? 0,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                ]);
                $exchange_rate->save();
            }else{
                $exchange_rate->update([
                    'rate' => $request->post('rate'),
                    'is_random' => $request->post('is_random'),
                    'min_rate' => $min_rate ?? 0,
                    'max_rate' => $max_rate ?? 0,
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                ]);
            }
            if($rate->update([
                'autoupdate' => $request->post('autoupdate'),
                's_value' => $request->post('rate'),
                'is_fixed' => false,
            ])){
                return redirect()->back()->with('success', 'Изменения усшено внесены!');
            }
        } else {
            ExchangeRate::where('rate_id', $rate->id)->delete();
            if ($rate->update([
                'autoupdate' => $request->post('autoupdate'),
                's_value' => $request->post('rate'),
                'is_fixed' => true,
            ])){
                return redirect()->back()->with('success', 'Изменения усшено внесены!');
            }
        }

        return redirect()->back()->with('error', 'Ошибка!')->withInput();
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function update(Request $request, $id)
    {
        $rate = Setting::findOrFail($id);

        $request->validate([
            'rate' => 'required|numeric',
            'autoypdate' => 'in:1,0',
            'date' => 'nullable|date'
        ]);

        if ($request->date) {
            CryptoCurrencyRateLog::setRateLog($rate, $request->date);
        } else {
            $result = $rate->update([
                's_value' => $request->rate,
                'autoupdate' => $request->autoupdate == '1'
            ]);
        }

        if ($result) {
            return redirect()->route('currency-rates.index')->with('success_short', 'Курс обновлен');
        }

        return back()->with('error_short', 'Курс не обновлен');
    }*/
}
