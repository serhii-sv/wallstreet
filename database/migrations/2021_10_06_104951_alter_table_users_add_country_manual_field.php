<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddCountryManualField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('country_manual')->nullable();
            $table->string('city_manual')->nullable();
            $table->string('index')->nullable();
            $table->string('telegram')->nullable();
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
            $table->dropColumn('country_manual');
            $table->dropColumn('city_manual');
            $table->dropColumn('index');
            $table->dropColumn('telegram');
        });
    }
}
