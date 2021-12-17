<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDepositBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_deposit_bonuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('deposit_bonus_id')->nullable();
            $table->float('personal_turnover', 24, 12)->default(0);
            $table->float('total_turnover', 24, 12)->default(0);
            $table->float('deposit_bonus_personal_turnover', 24, 12)->default(0);
            $table->float('deposit_bonus_total_turnover', 24, 12)->default(0);
            $table->string('deposit_bonus_leadership_bonus')->nullable();
            $table->float('deposit_bonus_reward', 24, 12)->default(0);
            $table->boolean('delayed')->default(0);
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
        Schema::dropIfExists('user_deposit_bonuses');
    }
}
