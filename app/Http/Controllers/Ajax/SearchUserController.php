<?php

namespace App\Http\Controllers\Ajax;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchUserController extends Controller
{
    //
    public function search(Request $request) {
        $search = $request->post('search');
        $users = [];
        if ($search && strlen($search) > 2) {
            $users = User::where(function ($query) use ($search) {
                return $query->where('login', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%');
            })->limit(10)->get();
        }
        return response()->json([
            'html' => view('panels.search-results', compact('users'))->render()
        ]);
    }

    public function getUserEmailByAny(Request $request) {
        if ($request->post('q'))
        {
            $search = $request->post('q');
            if ($search && strlen($search) > 1) {
                $users = User::where(function ($query) use ($search) {
                    return $query->where('login', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
                })->limit(15)->get();
                return json_encode([
                    'users' => $users,
                    'status' => 'good',
                    'msg' => 'Найдено ' . $users->count()
                ]);
            }
            return json_encode([
                'status' => 'bad',
                'msg' => 'Слишком короткий запрос'
            ]);
        }
        return json_encode([
            'status' => 'bad',
            'msg' => 'Ничего не найдено'
        ]);
    }
}
