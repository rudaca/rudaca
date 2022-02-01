<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
</x-slot>

<div class="container p-4 mx-auto">
	<?php 
/* 	echo "<pre>";
	echo "Media list";
	print_r($media_list);
	echo "</pre>"; */
	
	?>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-4">
		@if($media_list->isNotEmpty())
        @foreach($media_list as $media)
				<a href="#" class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
					<h2 class="truncate font-semibold text-lg text-gray-800">
						@if(is_object($media))
							@if(strstr($media->mime_type,"image/"))
								<img src="{{Storage::url($media->file_name)}}" alt="img" />
							@elseif(strstr($media->mime_type,"video/"))
								<video width="320" height="240" controls>
								<source src="{{Storage::url($media->file_name)}}" type="video/mp4">
								Your browser does not support the video tag.
								</video>
							@endif		
						@else
							@if(strstr($media['mime_type'],"image/"))
								<img src="{{Storage::url($media['file_name'])}}" alt="img" />
							@elseif(strstr($media['mime_type'],"video/"))
								<video width="320" height="240" controls>
								<source src="{{Storage::url($media['file_name'])}}" type="video/mp4">
								Your browser does not support the video tag.
								</video>
							@endif		
						@endif
					</h2>

					<p class="mt-2 text-gray-800">
							<svg xmlns="http://www.w3.org/2000/svg" class="float-left h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
							</svg>

							<span class="float-left">
							@if(is_object($media))
								{{$media->created_at}}		
							@else
								{{$media['created_at']}}		
							@endif
							</span>
					</p>
				</a>
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