<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_log', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->decimal('stat_left', 19);
            $table->decimal('stat_salary', 19);
            $table->decimal('stat_different', 19);
            $table->decimal('stat_withdraws', 19);
            $table->decimal('stat_deposits', 19);
            $table->decimal('stat_salary_percent', 19);
            $table->decimal('stat_worker_withdraw', 19);
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
        Schema::dropIfExists('salary_log');
    }
}
