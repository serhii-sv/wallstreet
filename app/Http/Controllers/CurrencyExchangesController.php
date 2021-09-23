<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchange;
use App\Models\UserSidebarProperties;
use Illuminate\Http\Request;

class CurrencyExchangesController extends Controller
{
    //
    public function index() {
        UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop','currency_exchange_count')->update(['sb_val' => 0]);
        return view('pages.currency-exchanges.index', [
            'exchanges_count' => CurrencyExchange::count(),
            'currency_exchange' => CurrencyExchange::paginate(10),
        ]);
    }
}
