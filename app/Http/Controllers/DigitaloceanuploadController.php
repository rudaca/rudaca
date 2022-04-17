<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\UploadFile;
use App\Models\User;
class DigitaloceanuploadController extends Controller
{
    public function index()
    {
		
		$listUser = User::get();
		$list = UploadFile::get();
		echo "<pre>";
		print_r($listUser->toArray());
		echo "-----------------------------------";
		UploadFile::truncate();
		print_r($list->toArray());
		die();
		
		
		return view('digitalocean');  
    }
	
	public function create()
    {
		return view('digitalocean');  
    }
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$requestData=$request->all();
		$filename = isset($request->all()['image'])?$request->all()['image']:'';
		
		if ($request->hasFile('image')) {
			$file=$request->file('image');
			$filePath = time() . $file->getClientOriginalName();
			$t = Storage::disk('do')->put($filePath, file_get_contents($file), 'public');
			$imageName = Storage::disk('do')->url($filePath);	
			echo "<pre>";
			print_r($request->all());
			print_r($request->file('image'));
			print_r($imageName);
			die('here');
		}	
		die('here1');
	}
	

}
