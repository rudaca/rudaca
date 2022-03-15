<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
</x-slot>

@php 
//echo "<pre>";
//print_r($media_list->toArray());
//echo "</pre>";
@endphp


<div class="container p-4 mx-auto">
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

					<p class="clear-both mt-2 text-gray-800">
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
					
					<p class="clear-both mt-2 text-gray-800">
						<svg class="float-left h-6 w-6" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 width="24" height="24" viewBox="0 0 466.583 466.582" style="enable-background:new 0 0 466.583 466.582;"
								 xml:space="preserve">
							<g>
								<path d="M233.292,0c-85.1,0-154.334,69.234-154.334,154.333c0,34.275,21.887,90.155,66.908,170.834
									c31.846,57.063,63.168,104.643,64.484,106.64l22.942,34.775l22.941-34.774c1.317-1.998,32.641-49.577,64.483-106.64
									c45.023-80.68,66.908-136.559,66.908-170.834C387.625,69.234,318.391,0,233.292,0z M233.292,233.291c-44.182,0-80-35.817-80-80
									s35.818-80,80-80c44.182,0,80,35.817,80,80S277.473,233.291,233.292,233.291z"/>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
						</svg>
						<span class="float-left">
							@if(is_object($media))
								{{$media->country_name}}		
							@else
								{{$media['country_name']}}		
							@endif
						</span>
					</p>
					
					@if((is_object($media) && strstr($media->mime_type,"image/")) || (isset($media['mime_type']) && strstr($media['mime_type'],"image/")))
					<p class="clear-both mt-2 text-gray-800">
						<svg class="float-left h-6 w-6" width="24" height="24" viewBox="0 0 48 48"  xmlns="http://www.w3.org/2000/svg"><path d="M38 24h-4v6h-6v4h10v-10zm-24-6h6v-4h-10v10h4v-6zm28-12h-36c-2.21 0-4 1.79-4 4v28c0 2.21 1.79 4 4 4h36c2.21 0 4-1.79 4-4v-28c0-2.21-1.79-4-4-4zm0 32.03h-36v-28.06h36v28.06z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
						<span class="float-left">
							@if(is_object($media))
								{{$media->height}}*{{$media->width}}			
							@else
								{{$media['height']}}*{{$media['width']}}		
							@endif
						</span>
					</p>
					@endif
					
					<p class="clear-both mt-2 text-gray-800">
						<h6 class="float-left h-6 w-30"><b>Filesize:</b></h6>
						<span class="float-left">
							@if(is_object($media))
								{{ number_format($media->filesize / 1048576,2).' MB' }}	
							@else
								{{ number_format($media['filesize'] / 1048576,2).' MB' }}	
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