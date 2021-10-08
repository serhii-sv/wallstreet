<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('wallet_id');
            $table->uuid('user_id');
            $table->uuid('payment_system_id');
            $table->uuid('currency_id');
            $table->string('external')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wallet_details');
    }
}
