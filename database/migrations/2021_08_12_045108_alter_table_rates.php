<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumns('rates', ['payout', 'overall', 'currency_id'])) {
            Schema::table('rates', function (Blueprint $table) {
                $table->dropColumn('payout');
                $table->dropColumn('overall');
                $table->dropColumn('currency_id');
            });
        }

        Schema::table('rates', function (Blueprint $table) {
            $table->boolean('refund_deposit')->default(0);
            $table->boolean('upgradable')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropColumn('refund_deposit');
            $table->dropColumn('upgradable');
        });
    }
}
