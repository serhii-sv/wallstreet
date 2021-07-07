<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserStatInputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('stat_salary_percent')->default(0);

            $table->string('stat_accepted')->nullable()->change();
            $table->string('stat_additional')->nullable()->change();
            $table->float('stat_worker_withdraw')->default(0);
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
            $table->dropColumn('stat_salary_percent');
            $table->dropColumn('stat_worker_withdraw');
        });
    }
}
