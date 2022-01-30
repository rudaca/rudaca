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
		//DB::beginTransaction();
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
				
				/* $counter=0;
				foreach ($this->file_name as $key => $image) {
						$filename = md5( $this->file_name[$key] . microtime()).'.'. $this->file_name[$key]->extension();
						$this->file_name[$key]->storeAs($foldername,$filename,'public');
						$extension = $this->file_name[$key]->extension();
						$mime_type = $this->file_name[$key]->getMimeType();
						$filesize = $this->file_name[$key]->getSize();
						list($height,$width)=getimagesize(storage_path("app/public/$foldername/$filename"));
						
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
				
				UploadFile::insert($data); */
				//DB::commit();
				
				echo "<pre>";
				echo "-----uploadfile----";
				ech "<br />";
				print_r($this->file_name);
				die();
				
				$counter=0;
				foreach ($this->file_name as $key => $image) {
						$filename = time();
						$this->file_name[$key]->store($filename,'do');
				$counter++;		
				}
				
				session()->flash('message', 'File has been successfully Uploaded.');
				return redirect()->to('/upload')->with('success','File has been successfully Uploaded.');
		}catch(Exception $e) {
			echo $e->getMessage();
			die();
			//DB::rollBack();
			//return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
		
    }
	
    public function render()
    {
        return view('livewire.upload-files');
    }
}
