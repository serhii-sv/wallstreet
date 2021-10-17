<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTransactionsAddCommissionUsdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->float('commission_usd', 24, 8)->default(0.00000000);
        });
        Schema::table('transaction_types', function (Blueprint $table) {
            $table->float('commission_usd', 24, 8)->default(0.00000000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('commission_usd');
        });
        Schema::table('transaction_types', function (Blueprint $table) {
            $table->dropColumn('commission_usd');
        });
    }
}
