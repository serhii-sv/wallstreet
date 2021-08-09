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
        Schema::create('notification_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('template_name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->integer('template_id');
            $table->string('name');
            $table->string('text');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('notification_types')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('notification_templates')->onDelete('cascade');
        });
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->integer('notification_id');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
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
