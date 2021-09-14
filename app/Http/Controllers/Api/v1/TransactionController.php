<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();

        dd($user);
    }
}
