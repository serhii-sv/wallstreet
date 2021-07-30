<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnused extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('blockio_notifications');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('mail_sents');
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('sys_loads');
        Schema::dropIfExists('user_task_actions');
        Schema::dropIfExists('user_task_propositions');
        Schema::dropIfExists('user_tasks');
        Schema::dropIfExists('task_actions');
        Schema::dropIfExists('task_coefficients');
        Schema::dropIfExists('task_scopes');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('telegram_bot_events');
        Schema::dropIfExists('telegram_bot_messages');
        Schema::dropIfExists('telegram_bot_scopes');
        Schema::dropIfExists('telegram_webhooks_info');
        Schema::dropIfExists('telegram_webhooks');
        Schema::dropIfExists('telegram_users');
        Schema::dropIfExists('telegram_bots');
        Schema::dropIfExists('tpl_default_langs');
        Schema::dropIfExists('users_social_meta');
        Schema::dropIfExists('user_ips');
        Schema::dropIfExists('youtube_video_watch');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
