<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecialPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('partner_level_1')->default(0);
            $table->float('partner_level_2')->default(0);
            $table->float('partner_level_3')->default(0);
            $table->float('partner_level_4')->default(0);
            $table->float('partner_level_5')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('partner_level_1');
            $table->dropColumn('partner_level_2');
            $table->dropColumn('partner_level_3');
            $table->dropColumn('partner_level_4');
            $table->dropColumn('partner_level_5');
        });
    }
}
