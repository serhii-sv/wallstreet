<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('admin_chat_messages');
        Schema::create('admin_chats', function (Blueprint $table){
            $table->uuid('id');
            $table->uuid('user_1');
            $table->uuid('user_2');
            $table->timestamps();
        });
        Schema::create('admin_chat_messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('chat_id');
            $table->uuid('user_id');
            $table->text('message');
            $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('admin_chats');
        Schema::dropColumns('admin_chat_messages', ['chat_id']);
    }
}
