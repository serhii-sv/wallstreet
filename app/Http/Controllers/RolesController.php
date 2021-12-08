<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class RolesController extends Controller
{

    public function index() {

        return view('pages.sample.app-roles-list', [
            'roles' => Role::orderByDesc('created_at')->get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ], [
            'name.required' => 'Название роли не указано',
            'name.unique' => 'Роль должна быть уникальна',
        ]);
        $role = new Role($request->except('_token'));
        if ($role->save()) {
            return redirect()->back()->with('success', 'Роль успешно создана!');
        } else {
            return redirect()->back()->with('errors', 'Попробуйте заново!');
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ], [
            'name.required' => 'Название роли не указано',
            'name.unique' => 'Название роли уже занята',
        ]);

        $role = Role::findById($id);

        if($role->is_fixed){
            if ($request->color != $role->color) {
                $role->color = $request->color;
                $role->save();
                return redirect()->back()->with('success', 'Цвет успешно изменен');
            }

            return redirect()->back()->with('error', 'Эту роль нельзя изменять!');
        }

        if ($role->update($request->except('method', '_token'))) {
            return redirect()->back()->with('success', 'Роль успешно обновлена!');
        } else {
            return redirect()->back()->with('error', 'Ошибка! Попробуйте заново');
        }
    }

    public function delete($id) {
        $role = Role::findById($id);
        $users = User::role($role->name)->get();
        if($role->is_fixed){
            return redirect()->back()->with('error', 'Эту роль нельзя изменять!');
        }
        DB::beginTransaction();
        try {
            if (!empty($users)) {
                foreach ($users as $user) {
                    $user->removeRole($role->name);
                }
            }
            if ($role->delete()) {
                DB::commit();
                return redirect()->back()->with('success', 'Роль успешно удалена!');
            } else {
                return redirect()->back()->with('errors', 'Ошибка! Попробуйте заново');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errors', $e->getMessage());
        }

    }
}
