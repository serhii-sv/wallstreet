<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCloudFilesAddFolderIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cloud_files', function (Blueprint $table) {
            $table->foreignId('cloud_file_folder_id')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cloud_files', function (Blueprint $table) {
            $table->dropColumn('cloud_file_folder_id');
        });
    }
}
