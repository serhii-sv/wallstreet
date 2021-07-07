<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserStat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('stat_deposits')->default(0);
            $table->float('stat_withdraws')->default(0);
            $table->float('stat_different')->default(0);
            $table->float('stat_salary')->default(0);
            $table->float('stat_accepted')->default(0);
            $table->float('stat_left')->default(0);
            $table->float('stat_additional')->default(0);
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
            $table->dropColumn('stat_deposits');
            $table->dropColumn('stat_withdraws');
            $table->dropColumn('stat_different');
            $table->dropColumn('stat_salary');
            $table->dropColumn('stat_accepted');
            $table->dropColumn('stat_left');
            $table->dropColumn('stat_additional');
        });
    }
}
