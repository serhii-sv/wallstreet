<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\PaymentSystem;

class PaymentSystems extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paymentSystems = PaymentSystem::all();

        return view('pages.payment-systems.index', compact('paymentSystems'));
    }
}
