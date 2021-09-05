<?php

namespace Database\Seeders;

use App\Models\Permission;
use http\Client\Curl\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::where('email', 'jordan_belfort@gmail.com')->first();

        if (!is_null($user)) {
            $user = \App\Models\User::create([
                'name' => 'Jordan Belfort',
                'email' => 'jordan_belfort@gmail.com',
                'login' => 'korhand_bel',
                'password' => Hash::make('demopassword'),
                'unhashed_password' => 'demopassword',
                'my_id' => null,
            ]);

            $user->assignRole('admin');
            $permissions = Permission::all();
            if (!empty($permissions)) {
                foreach ($permissions as $permission) {
                    $user->givePermissionTo($permission->name);
                }
            }
            $user->save();

            echo "Jordan Belfort (jordan_belfort@gmail.com) registered.\n";
        } else {
            echo "Jordan Belfort (jordan_belfort@gmail.com) already registered.\n";
        }
    }
}
