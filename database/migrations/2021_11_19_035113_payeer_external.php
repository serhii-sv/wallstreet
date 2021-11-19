<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PayeerExternal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * TODO: remove this migration !!! after Sprintbank project
     */
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->string('external_payeer')->after('external')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('external_payeer');
        });
    }
}
