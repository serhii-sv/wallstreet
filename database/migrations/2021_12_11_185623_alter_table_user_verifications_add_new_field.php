<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserVerificationsAddNewField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_verifications', function (Blueprint $table) {
            $table->string('passport_image')->nullable()->change();
            $table->string('id_card_front_image')->after('passport_image')->nullable();
            $table->string('id_card_back_image')->after('id_card_front_image')->nullable();
            $table->string('document_type')->after('accepted');
            $table->string('driver_license_image')->after('id_card_back_image')->nullable();
            $table->string('address_image')->after('driver_license_image');
            $table->renameColumn('full_name', 'first_name');
            $table->string('last_name')->after('full_name');
            $table->string('date_of_birth')->after('last_name');
            $table->string('country')->after('date_of_birth');
            $table->string('city')->after('country');
            $table->string('state')->after('city');
            $table->string('nationality')->after('state');
            $table->string('zip_code')->after('nationality');
            $table->string('address')->after('zip_code');
            $table->tinyInteger('confirmation_of_correctness')->after('accepted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user-verifications', function (Blueprint $table) {
            $table->renameColumn('first_name', 'full_name');
            $table->dropColumn('id_card_front_image');
            $table->dropColumn('id_card_back_image');
            $table->dropColumn('document_type');
            $table->dropColumn('driver_license_image');
            $table->dropColumn('address_image');
            $table->dropColumn('last_name');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('nationality');
            $table->dropColumn('zip_code');
            $table->dropColumn('address');
            $table->dropColumn('confirmation_of_correctness');
        });
    }
}
