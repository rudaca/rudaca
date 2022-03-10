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
				
				$foldername='upload_files';
				
				$device_info = $request->header('User-Agent');
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
						$filename = md5( $file->getClientOriginalName() . microtime()).'.'. $file->extension();
						Storage::disk('do')->put($filename, file_get_contents($file), 'public');
						$uploadFilePath = Storage::disk('do')->url($filename);
						$extension = $file->extension();
						$mime_type = $file->getMimeType();
						$filesize = $file->getSize();
						list($height,$width)=getimagesize($uploadFilePath);
						
						$data[$counter]['file_name'] = $foldername.'/'.$filename;
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
						
				$counter++;		
				}
				
				UploadFile::insert($data);
				DB::commit();
				
				session()->flash('message', 'File has been successfully Uploaded.');
				return redirect()->to('/upload')->with('success','File has been successfully Uploaded.');
		}catch(Exception $e) {
			DB::rollBack();
			return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
		
    }
	
    public function render()
    {
        return view('livewire.upload-files');
    }
}
