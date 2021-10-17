<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePaymentSystemsAddImageField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('payment_systems', function (Blueprint $table) {
                $table->string('image')->nullable();
                $table->string('image_alt')->nullable();
                $table->string('image_title')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_systems', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('image_alt');
            $table->dropColumn('image_title');
        });
    }
}
