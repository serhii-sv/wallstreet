<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

/**
 * Class PermissionsSeeder
 * @package database\seeds
 */
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Enums\Permissions::array() as $permissionKey => $permissionName) {
            $checkExists = \App\Models\Permission::where('slug', $permissionKey)->count();

            if ($checkExists > 0) {
                continue;
            }

            $newPermission = new \App\Models\Permission();
            $newPermission->fill([
                'name'          => $permissionName,
                'slug'          => $permissionKey,
                'description'   => $permissionName,
            ]);
            $newPermission->save();

            echo "permission ".$permissionKey." registered\r\n";
        }
    }
}
