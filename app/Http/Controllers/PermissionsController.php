<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class PermissionsController extends Controller
{

    public function index() {
        //Auth::user()->givePermissionTo('test', 'test 5');
        return view('pages.sample.app-permissions-list', [
            'permissions' => Permission::orderByDesc('created_at')->get(),
        ]);
    }


    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ], [
            'name.required' => 'Название права не указано',
            'name.unique' => 'Права должны быть уникальными',
        ]);
        $role = new Permission(array_merge($request->except('_token'),
            [
                'description' => 'permission description',
            ]));
        if ($role->save()) {
            return redirect()->back()->with('success', 'Права успешно созданы!');
        } else {
            return redirect()->back()->with('errors', 'Попробуйте заново!');
        }
    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ], [
            'name.required' => 'Название права не указано',
            'name.unique' => 'Название прав уже занято',
        ]);
        $role = Permission::findById($id);

        if ($role->update($request->except('method', '_token'))) {
            return redirect()->back()->with('success', 'Права успешно обновлены!');
        } else {
            return redirect()->back()->with('errors', 'Ошибка! Попробуйте заново');
        }
    }

    public function delete($id) {
        $permission = Permission::where('id', $id)->firstOrFail();
        DB::beginTransaction();
        try {
            if ($permission) {
                $permission_deleted = Permission::where('id', $id)->delete();
                DB::table(config('permission.table_names.model_has_permissions'))->where('permission_id', $id)->delete();
                DB::table(config('permission.table_names.role_has_permissions'))->where('permission_id', $id)->delete();
                $permission->forgetCachedPermissions();
                DB::commit();
                return redirect()->back()->with('success', 'Права успешно удалены!');
            } else {
                return redirect()->back()->with('error', 'Ошибка! Попробуйте заново');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ошибка! Попробуйте заново');
        }
    }
}
