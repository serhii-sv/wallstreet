<?php

namespace Database\Seeders;

use App\Models\DepositBonus;
use App\Models\RateGroup;
use Illuminate\Database\Seeder;

class RateGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!(RateGroup::count() > 0)) {
            RateGroup::create([
                'name' => '1 test',
                'description' => '1 тестовая группа',
                'refund_deposit' => 1,
                'reinvest' => 0,
            ]);
            RateGroup::create([
                'name' => '2 test',
                'description' => '2 тестовая группа',
                'refund_deposit' => 1,
                'reinvest' => 1,
            ]);
            RateGroup::create([
                'name' => '3 test',
                'description' => '3 тестовая группа',
                'refund_deposit' => 0,
                'reinvest' => 0,
            ]);
        }
    }
}
