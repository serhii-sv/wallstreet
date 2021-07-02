<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Technical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReftreeController extends Controller
{
    /**
     * @return null|string
     * @throws \Exception
     */
    public function show()
    {
        return getD3V3ReferralsTree();
    }
}
