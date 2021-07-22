<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->boolean('is_admin')->default(false);
            $table->string('ip', 50)->nullable();
            $table->timestamps();
        });
    
        Schema::table('user_auth_logs', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_auth_logs');
    }
}
