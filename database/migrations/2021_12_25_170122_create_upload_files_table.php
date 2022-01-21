<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->increments('id');
			$table->string('file_name',255)->nullable();
			$table->string('extension',255)->nullable();
			$table->string('mime_type',255)->nullable();
			$table->string('height',255)->nullable();
			$table->string('width',255)->nullable();
			$table->string('filesize',255)->nullable();
			$table->string('device_info',255)->nullable();
			$table->string('ip_address',255)->nullable();
			$table->string('country_name',255)->nullable();
			$table->string('country_code',255)->nullable();
			$table->string('region_code',255)->nullable();
			$table->string('region_name',255)->nullable();
			$table->string('city_name',255)->nullable();
			$table->string('zip_code',255)->nullable();
			$table->string('latitude',255)->nullable();
			$table->string('longitude',255)->nullable();
			$table->integer('year')->index();
			
			$table->foreignId('user_id')->nullable()->index();
			
			$table->softDeletes();
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
        Schema::dropIfExists('upload_files');
    }
}
