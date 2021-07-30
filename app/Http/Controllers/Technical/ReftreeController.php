<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Technical;

use App\Http\Controllers\Controller;

/**
 * Class ReftreeController
 * @package App\Http\Controllers\Technical
 */
class ReftreeController extends Controller
{
    /**
     * @param null $id
     * @return null|string
     * @throws \Exception
     */
    public function show($id = null)
    {
        if (null == $id) {
            throw new \Exception('reftree id is null');
        }

        return getAdminD3V3ReferralsTree($id);
    }
}
