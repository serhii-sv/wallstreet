<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'subject')) {
                $table->dropColumn('subject');
            }

            $table->text('short_content')->nullable()->after('content');
            $table->string('image')->nullable()->after('short_content');
            $table->string('title')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('short_content');
            $table->dropColumn('image');
            $table->dropColumn('title');
        });
    }
}
