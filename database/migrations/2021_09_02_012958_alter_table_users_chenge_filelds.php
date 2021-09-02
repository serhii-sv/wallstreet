<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersChengeFilelds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('stat_deposits', 12)->change();
            $table->decimal('stat_withdraws', 12)->change();
            $table->decimal('stat_different', 12)->change();
            $table->decimal('stat_salary', 12)->change();
            $table->decimal('stat_left', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
