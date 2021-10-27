<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhoneMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_phone_messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('code', 50)->nullable();
            $table->string('type')->nullable(); // Авторизация / верификация и т.п.
            $table->string('dispatch_method')->nullable(); // Авторизация / верификация и т.п.
            $table->boolean('used')->default(false);
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
        Schema::dropIfExists('user_phone_messages');
    }
}
