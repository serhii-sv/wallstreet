<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_bonuses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('status_name');
            $table->string('status_stage');
            $table->float('personal_turnover', 24, 12)->default(0);
            $table->float('total_turnover', 24, 12)->default(0);
            $table->float('reward', 24, 12)->default(0);
            $table->string('leadership_bonus')->nullable();
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
        Schema::dropIfExists('deposit_bonuses');
    }
}
