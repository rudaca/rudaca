<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UploadFile;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Collection;
use Storage;
class Media extends Component
{
	protected $listeners = [
        'load-more' => 'loadMore',
		'render' => '$refresh'
    ];
	public $media_types = [];
	public $perPage = 4;
	public $pageNumber = 1;
	public $hasMorePages;
	public $media_list;
	
    public function mount()
    {
		$this->media_types = ['image/*'=>'Photos','video/*'=>'Videos'];
		$this->media_list = new Collection();
		$this->loadMore();
    }
	
	public function loadMore()
    {
        $list = UploadFile::where('user_id',Auth::user()->id)->latest()->paginate($this->perPage, ['*'], 'page', $this->pageNumber);
        $this->pageNumber += 1;
        $this->hasMorePages = $list->hasMorePages();
        $this->media_list->push(...$list->items());
    }
	
	public function render()
    {
        return view('livewire.media');
    }
	
	public function delete($id){
		$media=UploadFile::findOrFail($id);
		$exist=Storage::disk('do')->exists($media->file_name);
		if($exist){
			$delete_file=Storage::disk('do')->delete($media->file_name);
			if($delete_file){
				$media->delete();
			}
		}
		session()->flash('message_success', 'Media deleted successfully.');
		return redirect()->to('/media');
	}
}
