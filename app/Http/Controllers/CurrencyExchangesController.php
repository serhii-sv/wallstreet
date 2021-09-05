<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchange;
use Illuminate\Http\Request;

class CurrencyExchangesController extends Controller
{
    //
    public function index() {
        return view('pages.currency-exchanges.index', [
            'exchanges_count' => CurrencyExchange::count(),
            'currency_exchange' => CurrencyExchange::paginate(10),
        ]);
    }
}
