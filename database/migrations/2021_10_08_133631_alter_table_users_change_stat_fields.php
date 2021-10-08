<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersChangeStatFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('stat_deposits', 19)->change();
            $table->decimal('stat_withdraws', 19)->change();
            $table->decimal('stat_different', 19)->change();
            $table->decimal('stat_salary', 19)->change();
            $table->decimal('stat_left', 19)->change();
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
