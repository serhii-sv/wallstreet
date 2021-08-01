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
        if ($search && strlen($search) > 2) {
            $users = User::where(function ($query) use ($search) {
                return $query->where('login', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%');
            })->limit(10)->get();
            if (!empty($users)) {
                $html = '';
                foreach ($users as $user) {
                    $html .= '
                    <li class="auto-suggestion">
                        <a class="collection-item" href="'.route('users.show', $user->id).'">
                           <div class="display-flex">
                              <div class="display-flex align-item-center flex-grow-1">
                                  <div class="avatar">
                                      <img class="circle" src="' . asset('images/avatar/user.svg') . '" width="30" alt="sample image">
                                  </div>
                                  <div class="member-info display-flex flex-column">
                                    <span class="black-text">' . $user->name . '</span>
                                    <small class="grey-text">Почта: ' . $user->email . '</small>
                                    <small class="grey-text">Логин: ' . $user->login . '</small>
                                  </div>
                            </div>
                          </div>
                        </a>
                      </li>
                    ';
                }
                return json_encode([
                    'status' => 'good',
                    'msg' => 'Users found!',
                    'html' => $html,
                ]);
            }
            return json_encode([
                'status' => 'bad',
                'msg' => 'No matches!',
                'html' => '<li class="auto-suggestion">
                            <a class="collection-item display-flex align-items-center" href="#">
                              <span class="material-icons">error_outline</span>
                              <span class="member-info">No results found.</span>
                            </a>
                          </li>',
            ]);
        }
        return json_encode([
            'status' => 'bad',
            'msg' => 'Short query!',
        ]);
    }
}
