<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class RolesAndPermissionsSeeder
 */
class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        if (Role::where('name', 'boss')->count() == 0) {
            Role::create(['name' => 'boss', 'color' => '#9c27b0']);
            echo "Role 'root' registered.\n";
        } else {
            Role::where('name', 'boss')->update(['is_fixed' => true]);
            echo "Role 'root' already registered.\n";
        }

//        if (Role::where('name', 'admin')->count() == 0) {
//            Role::create(['name' => 'admin', 'color' => '#ff4081']);
//            echo "Role 'admin' registered.\n";
//        } else {
//            Role::where('name', 'admin')->update(['is_fixed' => true]);
//            echo "Role 'admin' already registered.\n";
//        }

        if (Role::where('name', 'teamlead')->count() == 0) {
            Role::create(['name' => 'teamlead', 'color' => '#3b6eff']);
            echo "Role 'teamlead' registered.\n";
        } else {
            Role::where('name', 'teamlead')->update(['is_fixed' => true]);
            echo "Role 'teamlead' already registered.\n";
        }
    }
}
