<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

/**
 * Class TransactionTypesSeeder
 */
class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $transactionTypes = [
            'exchange_in',
            'exchange_out',
            'transfer_in',
            'transfer_out',
            'enter',
            'withdraw',
            'bonus',
            'partner',
            'dividend',
            'create_dep',
            'close_dep',
            'penalty',
            'reinvest',
            'partner_earnings',
        ];

        foreach ($transactionTypes as $type) {
            $searchType = TransactionType::where('name', $type)->count();

            if ($searchType > 0) {
                echo "Transaction type '" . $type . "' already registered.\n";
                continue;
            }

            if ($type == 'transfer_out' || $type == 'exchange_out' || $type == 'withdraw'){
                TransactionType::create([
                    'name' => $type,
                    'commission' => 0,
                    'commission_usd' => 1,
                ]);
            }else {
                TransactionType::create([
                    'name' => $type,
                    'commission' => 0,
                    'commission_usd' => 0,
                ]);
            }
            echo "Transaction type '" . $type . "' registered.\n";
        }
    }
}
