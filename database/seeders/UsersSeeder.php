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
        $user = \App\Models\User::where('login', 'sprintbank')->first();
        // jordan_bel
        if (is_null($user)) {
            $user = \App\Models\User::create([
                'name' => 'Sprint Bank',
                'email' => 'sprint@bank.com',
                'login' => 'sprintbank',
                'password' => Hash::make('demopassword'),
                'unhashed_password' => 'demopassword',
                'my_id' => null,
            ]);
            $user->generateMyId();

//            $user->assignRole('root');
            $permissions = Permission::all();
            if (!empty($permissions)) {
                foreach ($permissions as $permission) {
                    $user->givePermissionTo($permission->name);
                }
            }
            $user->save();

            echo "Jordan Belfort (sprint@bank.com) registered.\n";
        } else {
            echo "Jordan Belfort (sprint@bank.com) already registered.\n";
        }
    }
}
