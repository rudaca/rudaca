<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Storage;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\App;
class UploadFiles extends Component
{
	use WithFileUploads;
	public $file_name =[];
	public $latest_files;
	
	public function mount()
    {
		$this->latest_files = UploadFile::where('user_id',Auth::user()->id)->latest()->limit(2)->get();
    }
	
	public function submit(Request $request)
    {
		DB::beginTransaction();
		try {
				$this->validate([
					'file_name.*' => 'required',
				]);
				
				$data = [];
				$upload_directory='';
				$main_upload_folder_do='development';
				$upload_profile_folder_do=Auth::user()->id;
				
				if(App::environment('production')){
					$main_upload_folder_do='production';
					$upload_profile_folder_do=Auth::user()->id;
					$upload_directory=$main_upload_folder_do.'/'.$upload_profile_folder_do.'/';
				}else{
					$main_upload_folder_do='development';
					$upload_profile_folder_do=Auth::user()->id;
					$upload_directory=$main_upload_folder_do.'/'.$upload_profile_folder_do.'/';		
				}
				
				$device_info = $request->header('User-Agent');
				$device_taken = NULL;
				$device_info_pos1 = strpos($device_info, '(')+1;
				$device_info_pos2 = strpos($device_info, ')')-$device_info_pos1;
				$device_info_part = substr($device_info, $device_info_pos1, $device_info_pos2);
				$device_info_parts_array = explode(" ", $device_info_part);
				if(isset($device_info_parts_array[0]) && isset($device_info_parts_array[1]) && isset($device_info_parts_array[2]) && isset($device_info_parts_array[3]) && isset($device_info_parts_array[4])){
					$device_taken=$device_info_parts_array[0].' '.$device_info_parts_array[1].' '.$device_info_parts_array[2].' '.$device_info_parts_array[3].' '.$device_info_parts_array[4];
				}
				
				$ip_address = $request->getClientIp();
				$location = date('Y-m-d H:i:s');
				$year = date('Y');
				$created_at = date('Y-m-d H:i:s');
				
				$currentUserInfo = Location::get($request->getClientIp());
				$countryName=(isset($currentUserInfo->countryName) && !empty($currentUserInfo->countryName)?$currentUserInfo->countryName:null);
				$countryCode=(isset($currentUserInfo->countryCode) &&  !empty($currentUserInfo->countryCode)?$currentUserInfo->countryCode:null);
				$regionCode=(isset($currentUserInfo->regionCode) &&  !empty($currentUserInfo->regionCode)?$currentUserInfo->regionCode:null);
				$regionName=(isset($currentUserInfo->regionName) &&  !empty($currentUserInfo->regionName)?$currentUserInfo->regionName:null);
				$cityName=(isset($currentUserInfo->cityName) &&  !empty($currentUserInfo->cityName)?$currentUserInfo->cityName:null);
				$zipCode=(isset($currentUserInfo->zipCode) &&  !empty($currentUserInfo->zipCode)?$currentUserInfo->zipCode:null);
				$latitude=(isset($currentUserInfo->latitude) &&  !empty($currentUserInfo->latitude)?$currentUserInfo->latitude:null);
				$longitude=(isset($currentUserInfo->longitude) &&  !empty($currentUserInfo->longitude)?$currentUserInfo->longitude:null);
				
				$counter=0;
				foreach ($this->file_name as $key => $image) {
						$file=$this->file_name[$key];
						$target_upload_filename = $file->getClientOriginalName();
						$filename = $upload_directory.md5( $file->getClientOriginalName() . microtime()).'.'. $file->extension();
						$fileTempPath=$file->getRealPath();
						Storage::disk('do')->put($filename, file_get_contents($fileTempPath), 'public');
						$uploadFilePath = Storage::disk('do')->url($filename);
						$extension = $file->extension();
						$mime_type = $file->getMimeType();
						$filesize = $file->getSize();
						list($height,$width)=getimagesize($uploadFilePath);
						$data[$counter]['file_name'] = $filename;
						$data[$counter]['extension'] = $extension;
						$data[$counter]['mime_type'] = $mime_type;
						$data[$counter]['height'] = $height;
						$data[$counter]['width'] = $width;
						$data[$counter]['filesize'] = $filesize;
						$data[$counter]['device_info'] = $device_info;
						$data[$counter]['ip_address'] = $ip_address;
						$data[$counter]['year'] = $year;
						$data[$counter]['created_at'] = $created_at; 
						$data[$counter]['country_name'] = $countryName; 
						$data[$counter]['country_code'] = $countryCode; 
						$data[$counter]['region_code'] = $regionCode; 
						$data[$counter]['region_name'] = $regionName; 
						$data[$counter]['city_name'] = $cityName; 
						$data[$counter]['zip_code'] = $zipCode; 
						$data[$counter]['latitude'] = $latitude; 
						$data[$counter]['longitude'] = $longitude; 
						$data[$counter]['created_at'] = $created_at; 
						$data[$counter]['user_id'] = Auth::user()->id;
						$data[$counter]['target_upload_filename'] = $target_upload_filename;
						$data[$counter]['date_taken_from_picture'] = $created_at;
						$data[$counter]['device_taken'] = $device_taken;
						
				$counter++;		
				}
				
				UploadFile::insert($data);
				DB::commit();
				
				$this->reset('file_name');
				
				session()->flash('message_success', 'File has been successfully Uploaded.');
				return redirect()->to('/upload')->with('success','File has been successfully Uploaded.');
		}catch(Exception $e) {
			DB::rollBack();
			session()->flash('message_error',$e->getMessage());
			return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
		
    }
	
    public function render()
    {
        return view('livewire.upload-files');
    }
}
