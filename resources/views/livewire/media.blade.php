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

					<div class="break-inside-avoid">
					  <section class="break-inside-avoid">
						<ul class="list-inside pr-7">
						   <li class="leading-normal text-black transition duration-100 ease-in text-gray-550 text-md hover:text-gray-700 print:">
							  <span class="mr-2 text-lg font-semibold text-gray-700 leading-snugish">
								Created Date:
							  </span>
							  India
						  </li>
						  
						  <li class="leading-normal text-black transition duration-100 ease-in text-gray-550 text-md hover:text-gray-700 print:">
							  <span class="mr-2 text-lg font-semibold text-gray-700 leading-snugish">
								Country:
							  </span>
							  India
						  </li>
						  
						   <li class="leading-normal text-black transition duration-100 ease-in text-gray-550 text-md hover:text-gray-700 print:">
							  <span class="mr-2 text-lg font-semibold text-gray-700 leading-snugish">
								Height*Width:
							  </span>
							  1200*799
						  </li>
						  
						   <li class="leading-normal text-black transition duration-100 ease-in text-gray-550 text-md hover:text-gray-700 print:">
							  <span class="mr-2 text-lg font-semibold text-gray-700 leading-snugish">
								Filesize:
							  </span>
							  0.32 MB
						  </li>
						  
						   <li class="leading-normal text-black transition duration-100 ease-in text-gray-550 text-md hover:text-gray-700 print:">
							  <span class="mr-2 text-lg font-semibold text-gray-700 leading-snugish">
								Upload By:
							  </span>
							  Rudaca
						  </li>
						</ul>
					  </section>
					</div>
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