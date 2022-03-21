<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
</x-slot>

<div class="container mx-auto">
    <div class="flex flex-wrap -mx-4">
	@if($media_list->isNotEmpty())
        @foreach($media_list as $media)
			@php 
				$media_id=null;
				if(is_object($media)){
					$media_id=$media->id;	
				}else{
					$media_id=$media['id'];		
				}
			@endphp 
      <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
        <a href="" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-48 overflow-hidden">
		  @if(is_object($media))
							@if(strstr($media->mime_type,"image/"))
							<img class="absolute inset-0 h-full w-full object-cover" src="{{url('https://rudacadev.nyc3.digitaloceanspaces.com/'.$media->file_name)}}" alt="">
							@elseif(strstr($media->mime_type,"video/"))
								<video class="absolute inset-0 h-full w-full object-cover" width="320" height="240" controls>
								<source src="{{url('https://rudacadev.nyc3.digitaloceanspaces.com/'.$media->file_name)}}" type="video/mp4">
								Your browser does not support the video tag.
								</video>
							@endif		
						@else
							@if(strstr($media['mime_type'],"image/"))
							<img class="absolute inset-0 h-full w-full object-cover" src="{{url('https://rudacadev.nyc3.digitaloceanspaces.com/'.$media['file_name'])}}" alt="">
							@elseif(strstr($media['mime_type'],"video/"))
								<video class="absolute inset-0 h-full w-full object-cover" width="320" height="240" controls>
								<source src="{{url('https://rudacadev.nyc3.digitaloceanspaces.com/'.$media['file_name'])}}" type="video/mp4">
								Your browser does not support the video tag.
								</video>
							@endif		
		@endif
        </div>
        <div class="p-4" style="display:none;">
          <h2 class="mt-2 mb-2  font-bold">Purus Ullamcorper Inceptos Nibh</h2>
          <p class="text-sm">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla.</p>
        </div>
        <div class="p-4 border-t border-b text-xs text-gray-700">
          <span class="flex items-center mb-1">
            <svg class="h-4 w-4 mr-2 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  <polyline points="12 7 12 12 15 15" /></svg>
			@if(is_object($media))
				{{$media->created_at}}		
			@else
				{{$media['created_at']}}		
			@endif
          </span>
		  <span class="flex items-center mb-1">
            <svg class="h-4 w-4 mr-2 text-gray-900"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
			</svg>
			@if(is_object($media))
				{{$media->country_name}}		
			@else
				{{$media['country_name']}}		
			@endif
			
			@if(is_object($media))
				{{$media->city_name}}		
			@else
				{{$media['city_name']}}		
			@endif
			
			@if(is_object($media))
				{{$media->region_name}}		
			@else
				{{$media['region_name']}}		
			@endif
          </span>
		  <span class="flex items-center mb-1">
            <svg class="h-8 w-8 mr-2 text-gray-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />  <circle cx="12" cy="13" r="4" /></svg>
			@if(is_object($media))
				{{$media->device_info}}		
			@else
				{{$media['device_info']}}		
			@endif
          </span>
		  <span class="flex items-center mb-1">
            <svg class="h-4 w-4 mr-2 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="7" r="4" />  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
			{{auth()->user()->name}}
          </span>
		  <span class="flex items-center mb-1">
            <svg class="h-4 w-4 mr-2 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="15" y1="8" x2="15.01" y2="8" />  <rect x="4" y="4" width="16" height="16" rx="3" />  <path d="M4 15l4 -4a3 5 0 0 1 3 0l 5 5" />  <path d="M14 14l1 -1a3 5 0 0 1 3 0l 2 2" /></svg>
			@if(is_object($media))
				@if(!empty($media->height) && !empty($media->width))
					{{$media->height}}*{{$media->width}},
				@endif
			@else
				@if(!empty($media['height']) && !empty($media['width']))
					{{$media['height']}}*{{$media['width']}},
				@endif
			@endif
			@if(is_object($media))
				{{ number_format($media->filesize / 1048576,2).' MB' }}	
			@else
				{{ number_format($media['filesize'] / 1048576,2).' MB' }}	
			@endif
          </span>
        </div>
        <div class="p-4 flex justify-end text-sm text-gray-600"><button wire:click="delete({{$media_id}})" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button></div>
      </a>
      </div>
	  @endforeach
		@endif
    </div>
	 @if ($hasMorePages)
        <div class="flex items-center justify-center mt-4">
            <button class="px-4 py-3 text-lg font-semibold text-white rounded-xl bg-blue-500 hover:bg-blue-400" wire:click="loadMore">
                Load More
            </button>
        </div>
    @endif
  </div>
