<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Auth\oAuth;

use App\Http\Controllers\Controller;

class VkOAuthController extends Controller
{
    public function handleProviderCallback()
    {
        die(print_r($_GET,true).'<hr>'.print_r($_POST,true));
    }
}
