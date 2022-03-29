<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableUploadFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('upload_files', function (Blueprint $table){
			if (!Schema::hasColumn('upload_files', 'target_upload_filename')) {
                $table->text('target_upload_filename')->after('file_name')->nullable();
            }
			
			if (!Schema::hasColumn('upload_files', 'date_taken_from_picture')) {
				$table->dateTime('date_taken_from_picture')->after('user_id')->nullable();
            }
			
			if (!Schema::hasColumn('upload_files', 'device_taken')) {
				$table->string('device_taken',255)->after('device_info')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upload_files', function($table){
			$table->dropColumn('target_upload_filename');
			$table->dropColumn('date_taken_from_picture');
			$table->dropColumn('device_taken');
		});
    }
}
