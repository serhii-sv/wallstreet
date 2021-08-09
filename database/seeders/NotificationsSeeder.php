<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('notification_types')->insert([
            'name' => 'Email',
        ]);
        DB::table('notification_types')->insert([
            'name' => 'Информирование',
        ]);
        DB::table('notification_types')->insert([
            'name' => 'Смс',
        ]);
        DB::table('notification_templates')->insert([
            'name' => 'Свой',
            'template_name' => 'custom',
        ]);
        DB::table('notification_templates')->insert([
            'name' => 'Пополнение баланса',
            'template_name' => 'balance_replenishment',
        ]);
        
    }
}
