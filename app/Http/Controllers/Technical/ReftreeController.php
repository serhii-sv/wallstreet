<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Technical;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $user = User::find($id);

        return view('pages.users.reftree', [
            'referrals_data' => $user->getAllReferrals()
        ]);
    }
}
