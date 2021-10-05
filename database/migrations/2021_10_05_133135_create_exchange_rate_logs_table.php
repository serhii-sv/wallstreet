<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate_logs', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('rate_id');
            $table->float('old_rate', 24, 8)->default(0.00000000);
            $table->float('new_rate', 24, 8)->default(0.00000000);
            $table->integer('date');
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
        Schema::dropIfExists('exchange_rate_logs');
    }
}
