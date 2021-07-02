<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class StatisticController
 * @package App\Http\Controllers\Admin
 */
class StatisticController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.statistic.index');
    }
}
