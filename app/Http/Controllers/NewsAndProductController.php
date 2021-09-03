<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class NewsAndProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(9, '*', 'news_page');

        $products = Product::orderBy('created_at', 'desc')->paginate(9, '*', 'products_page');

        return view('pages.news-and-products.index', compact('news', 'products'));
    }
}
