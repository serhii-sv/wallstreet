<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_exchange', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('transaction_out');
            $table->uuid('transaction_in');
            $table->uuid('currency_out');
            $table->uuid('currency_in');
            $table->decimal('amount_out', 24,12);
            $table->decimal('amount_in', 24,12);
            $table->float('main_currency_amount_out', 24, 12)->default(0);
            $table->float('main_currency_amount_in', 24, 12)->default(0);
            $table->float('commission')->nullable();
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
        Schema::dropIfExists('currency_exchange');
    }
}
