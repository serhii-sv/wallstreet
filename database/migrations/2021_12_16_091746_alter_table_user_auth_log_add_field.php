<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserAuthLogAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_auth_logs', function (Blueprint $table) {
            $table->boolean('is_teamlead')->after('is_admin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_auth_logs', function (Blueprint $table) {
            $table->dropColumn('is_teamlead');
        });
    }
}
