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

        if (Role::where('name', 'Фаундер')->count() == 0) {
            Role::create(['name' => 'Фаундер', 'color' => '#151313']);
            echo "Role 'Фаундер' registered.\n";
        } else {
            Role::where('name', 'Фаундер')->update(['is_fixed' => true]);
            echo "Role 'Фаундер' already registered.\n";
        }

        if (Role::where('name', 'Тимлидер')->count() == 0) {
            Role::create(['name' => 'Тимлидер', 'color' => '#5f19ee']);
            echo "Role 'Тимлидер' registered.\n";
        } else {
            Role::where('name', 'Тимлидер')->update(['is_fixed' => true]);
            echo "Role 'Тимлидер' already registered.\n";
        }

        if (Role::where('name', 'Конвершн')->count() == 0) {
            Role::create(['name' => 'Конвершн', 'color' => '#f2df31']);
            echo "Role 'Конвершн' registered.\n";
        } else {
            Role::where('name', 'Конвершн')->update(['is_fixed' => true]);
            echo "Role 'Конвершн' already registered.\n";
        }

        if (Role::where('name', 'Кикбан')->count() == 0) {
            Role::create(['name' => 'Кикбан', 'color' => '#ff460d']);
            echo "Role 'Кикбан' registered.\n";
        } else {
            Role::where('name', 'Кикбан')->update(['is_fixed' => true]);
            echo "Role 'Кикбан' already registered.\n";
        }

        if (Role::where('name', 'Кик')->count() == 0) {
            Role::create(['name' => 'Кик', 'color' => '#ff460d']);
            echo "Role 'Кик' registered.\n";
        } else {
            Role::where('name', 'Кик')->update(['is_fixed' => true]);
            echo "Role 'Кик' already registered.\n";
        }

        if (Role::where('name', 'Клиент')->count() == 0) {
            Role::create(['name' => 'Клиент', 'color' => '#1cd73f']);
            echo "Role 'Клиент' registered.\n";
        } else {
            Role::where('name', 'Клиент')->update(['is_fixed' => true]);
            echo "Role 'Клиент' already registered.\n";
        }
    }
}
