<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Modules\SocialNetworks\FacebookModule;
use App\Modules\SocialNetworks\VkModule;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('customer.main');
    }
}
