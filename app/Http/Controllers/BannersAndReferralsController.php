<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannersAndReferralsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function referrals()
    {
        return view('pages.referrals-and-banners.referrals');
    }
    
    public function banners() {
        return view('pages.referrals-and-banners.banners');
    }
}
