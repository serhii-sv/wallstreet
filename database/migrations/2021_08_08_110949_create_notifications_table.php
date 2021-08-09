<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('notification_templates', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->string('template_name');
//            $table->boolean('active')->default(true);
//            $table->timestamps();
//        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->boolean('type_browser')->default(false);
            $table->boolean('type_sms')->default(false);
            $table->string('name');
            $table->string('subject');
            $table->string('text');
            $table->timestamps();
            //$table->integer('template_id');
        });
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->integer('notification_id');
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
        Schema::dropIfExists('notification_users');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('notification_types');
        Schema::dropIfExists('notification_templates');
    }
}
