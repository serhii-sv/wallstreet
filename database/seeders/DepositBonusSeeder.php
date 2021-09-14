<?php

namespace Database\Seeders;

use App\Models\DepositBonus;
use Illuminate\Database\Seeder;

class DepositBonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        if (!(DepositBonus::count() > 0)) {
            DepositBonus::create([
                'status_name' => 'Партнёр',
                'status_stage' => 'Бронзовый',
                'personal_turnover' => 0,
                'total_turnover' => 0,
                'reward' => 0,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Партнёр',
                'status_stage' => 'Серебряный',
                'personal_turnover' => 100,
                'total_turnover' => 1000,
                'reward' => 50,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Партнёр',
                'status_stage' => 'Золотой',
                'personal_turnover' => 250,
                'total_turnover' => 3000,
                'reward' => 100,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Менеджер',
                'status_stage' => 'Серебряный',
                'personal_turnover' => 500,
                'total_turnover' => 7000,
                'reward' => 250,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Менеджер',
                'status_stage' => 'Золотой',
                'personal_turnover' => 700,
                'total_turnover' => 10000,
                'reward' => 300,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Менеджер',
                'status_stage' => 'Платиновый',
                'personal_turnover' => 1000,
                'total_turnover' => 15000,
                'reward' => 500,
                'leadership_bonus' => '',
            ]);
            DepositBonus::create([
                'status_name' => 'Директор',
                'status_stage' => 'Золотой',
                'personal_turnover' => 2000,
                'total_turnover' => 25000,
                'reward' => 2000,
                'leadership_bonus' => 'Apple Watch Series 6 44mm',
            ]);
            DepositBonus::create([
                'status_name' => 'Директор',
                'status_stage' => 'Платиновый',
                'personal_turnover' => 3000,
                'total_turnover' => 50000,
                'reward' => 4000,
                'leadership_bonus' => 'iPhone 12 Pro Max 512GB',
            ]);
            DepositBonus::create([
                'status_name' => 'Директор',
                'status_stage' => 'Изумрудный',
                'personal_turnover' => 5000,
                'total_turnover' => 100000,
                'reward' => 10000,
                'leadership_bonus' => 'Apple MacBook Pro 16in',
            ]);
            DepositBonus::create([
                'status_name' => 'Президент',
                'status_stage' => 'Платиновый',
                'personal_turnover' => 10000,
                'total_turnover' => 250000,
                'reward' => 15000,
                'leadership_bonus' => 'Samsung QE85Q950TSU',
            ]);
            DepositBonus::create([
                'status_name' => 'Президент',
                'status_stage' => 'Изумрудный',
                'personal_turnover' => 15000,
                'total_turnover' => 500000,
                'reward' => 25000,
                'leadership_bonus' => 'Four Season Resort Maldives',
            ]);
            DepositBonus::create([
                'status_name' => 'Президент',
                'status_stage' => 'Бриллиантовый',
                'personal_turnover' => 30000,
                'total_turnover' => 1000000,
                'reward' => 40000,
                'leadership_bonus' => 'Mercedes Benz C-Class 2021',
            ]);
            echo "Обороты депозитов добавлены!\r\n";
        }
        else{
            echo "Обороты депозитов уже добавлены!\r\n";
        }
    }
}
