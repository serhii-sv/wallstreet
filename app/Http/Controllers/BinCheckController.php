<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BinCheckController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request) {
        if (!empty($request->card_number)) {
            $card_number = $request->card_number;
            $bin = substr($card_number, 0, 6);
            
            $curl = curl_init("https://lookup.binlist.net/" . $bin);
            curl_setopt($curl, CURLOPT_TIMEOUT, 25);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);
            
            $json = json_decode($result);
            
            if (is_null($json)) {
                return back()->with('error_short', 'Данные по карте не найдены')->withInput($request->input());
            }
            
            $cardData = [
                'brand' => $json->scheme,
                'type' => $json->type ?? ' - ',
                'country' => $json->country->name,
                'symbol' => $json->country->alpha2,
                'flag' => $json->country->emoji,
                'currency' => $json->country->currency,
                'bank_name' => $json->bank->name ?? null,
                'bank_url' => $json->bank->urk ?? null,
                'bank_phone' => $json->bank->phone ?? null,
            ];
            
            return view('pages.bin-check.index', compact('cardData', 'card_number'));
        }
        return view('pages.bin-check.index');
    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function check(Request $request) {
        
        //        $ch = curl_init();
        //        curl_setopt($ch, CURLOPT_URL, 'https://api.bintable.com/v1/426398?api_key=5f59f7a6688a6e1022662609a5ae086f95f696b5');
        //        curl_setopt($ch, CURLOPT_REFERER, gethostname());
        //        curl_setopt($ch, CURLOPT_USERAGENT, "Bintable.com PHP API");
        //        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //
        //        $output = curl_exec($ch);
        //        curl_close($ch);
        //        dd(json_decode($output, true));
    }
    
    public function ajaxCheck(Request $request) {
        if (!empty($request->card_number)) {
            $card_number = $request->card_number;
            $bin = substr($card_number, 0, 6);
            
            $curl = curl_init("https://lookup.binlist.net/" . $bin);
            curl_setopt($curl, CURLOPT_TIMEOUT, 25);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);
            
            $json = json_decode($result);
            
            if (is_null($json)) {
                return json_encode([
                    'status' => 'bad',
                    'msg' => 'Данные по карте не найдены',
                ]);
            }
            
            $cardData = [
                'brand' => $json->scheme,
                'type' => $json->type ?? ' - ',
                'country' => $json->country->name,
                'symbol' => $json->country->alpha2,
                'flag' => $json->country->emoji,
                'currency' => $json->country->currency,
                'bank_name' => $json->bank->name ?? null,
                'bank_url' => $json->bank->urk ?? null,
                'bank_phone' => $json->bank->phone ?? null,
            ];
            
            $html = '
            <ul class="collection">
              <li class="collection-item avatar">
                <i class="material-icons red accent-2 circle">account_balance</i>
                <h6 class="collection-header m-0">Имя банка</h6>
                <p>' . $cardData["bank_name"] . '</p>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons red accent-2 circle">branding_watermark</i>
                <h6 class="collection-header m-0">Бренд</h6>
                <p>' . $cardData["brand"] . '</p>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons red accent-2 circle">credit_card</i>
                <h6 class="collection-header m-0">Тип карты</h6>
                <p>' . $cardData["type"] . '</p>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons red accent-2 circle">edit_location</i>
                <h6 class="collection-header m-0">Страна</h6>
                <p>' . $cardData["country"] . '</p>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons red accent-2 circle">payment</i>
                <h6 class="collection-header m-0">Валюта</h6>
                <p>' . $cardData["currency"] . '</p>
              </li>
            </ul>';
            
            return json_encode([
                'status' => 'good',
                'html' => $html,
            ]);
        }
    }
}
