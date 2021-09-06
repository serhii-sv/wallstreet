<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admin_chat_messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->text('message');
            $table->timestamps();
        });
//        Schema::create('admin_chat_users', function (Blueprint $table) {
//            $table->uuid('id');
//            $table->uuid('message_id');
//            $table->uuid('user_id');
//            $table->boolean('is_read')->default(false);
//            $table->timestamps();
//        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admin_chat_messages');
      //  Schema::dropIfExists('admin_chat_users');
    }
}
