<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UploadFiles;
use App\Http\Livewire\Media;
use App\Http\Controllers\DigitaloceanuploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/digitalocean', DigitaloceanuploadController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
	
	Route::get('/upload',UploadFiles::class)->name('upload');
	Route::get('/media',Media::class)->name('media');
});