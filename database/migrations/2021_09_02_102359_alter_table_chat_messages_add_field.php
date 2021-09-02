<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableChatMessagesAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasColumn('chat_messages', 'is_read')) {
            Schema::table('chat_messages', function (Blueprint $table) {
                $table->boolean('is_read')->default(false);
            });
        }
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('chat_messages', 'is_read')) {
            Schema::dropColumns('chat_messages', ['is_read']);
        }
    }
}
