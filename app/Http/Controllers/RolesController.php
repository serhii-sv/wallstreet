<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class RolesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view('pages.sample.app-roles-list', [
            'roles' => Role::orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ], [
            'name.required' => 'Название роли не указано',
            'name.unique' => 'Название роли уже занята',
        ]);
        $role = Role::findById($id);
        if($role->is_fixed){
            return redirect()->back()->with('error', 'Эту роль нельзя изменять!');
        }
        if ($role->update($request->except('method', '_token'))) {
            return redirect()->back()->with('success', 'Роль успешно обновлена!');
        } else {
            return redirect()->back()->with('error', 'Ошибка! Попробуйте заново');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateColor(Request $request, $id) {
        $request->validate([
            'color' => 'required',
        ], [
            'color.required' => 'Укажите цвет роли',
        ]);
        $role = Role::findById($id);
        if($role->is_fixed){
            return response()->json([
                'success' => false,
                'message' => 'Эту роль нельзя изменять!'
            ]);
        }
        if ($role->update($request->except('method', '_token'))) {
            return response()->json([
                'success' => true,
                'message' => 'Роль успешно обновлена!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка! Попробуйте заново'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
