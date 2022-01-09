<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('withdraw_action')->nullable();
            $table->boolean('withdraw_waiting')->default(false);
            $table->boolean('withdraw_finish')->default(false);
            $table->boolean('withdraw_reason')->default(false);
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
            $table->dropColumn('withdraw_action');
            $table->dropColumn('withdraw_waiting');
            $table->dropColumn('withdraw_finish');
            $table->dropColumn('withdraw_reason');
        });
    }
}
