<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
	
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'upload_files';
	
	 /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
	
	/**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name','extension','mime_type','height','width','filesize','device_info','ip_address','country_name','country_code','region_code','region_name','city_name','zip_code','latitude','longitude','year','target_upload_filename','date_taken_from_picture','device_taken'];
}
