    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Multiple Photos / Vidoes') }}
        </h2>
    </x-slot>
	
<div class="container mx-auto">
    <div class="w-full sm:w-1/1 md:w-1/1 xl:w-1/1 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				@if (session()->has('message_success'))
					<div class=" min-w-full bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 flash-alert" role="alert">
					  <p class="font-bold">Success</p>
					  <p class="text-sm">{{ session('message_success') }}</p>
					</div>
					@endif
				
					<div wire:loading wire:target="file_name" class="min-w-full bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
					  <p class="font-bold">Media alert</p>
					  <p class="text-sm">Uploading Media Images...</p>
					</div>
					
					<div wire:loading wire:target="submit" class="min-w-full bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
					  <p class="font-bold">Media alert</p>	
					  <p class="text-sm">Selected files are uploading to server please wait...</p>
					</div>
					
					<div  x-data="{ isUploading: false, progress: 0 }"
						x-on:livewire-upload-start="isUploading = true"
						x-on:livewire-upload-finish="isUploading = false"
						x-on:livewire-upload-error="isUploading = false"
						x-on:livewire-upload-progress="progress = $event.detail.progress"
					>
						<div class="relative flex items-center justify-center min-h-screen-- bg-gray-1001 dark:bg-gray-9001 sm:items-center p-40">
							<form class="w-full max-w-sm" wire:submit.prevent="submit" enctype="multipart/form-data">
							  <div class="md:flex md:items-center mb-6">
								<div class="md:w-1/3">
								  <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
									Select File
								  </label>
								</div>
								<div class="md:w-2/3">
									<input type="file" class="form-control" id="exampleInputName" wire:model="file_name" multiple>
									@error('file_name') <span class="text-danger">{{ $message }}</span> @enderror
									
									<div x-show="isUploading" class="min-w-full">
										<progress max="100" x-bind:value="progress"></progress>
									</div>
									
								</div>
							  </div>
							  <div class="md:flex md:items-center">
								<div class="md:w-1/3"></div>
								<div class="md:w-2/3">
								  <button wire:loading.class="bg-gray-500 cursor-default" wire:loading.class.remove="shadow bg-blue-500 hover:bg-blue-400"  wire:loading.attr="disabled" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
								  <span wire:loading wire:target="submit" class="float-left pr-2"><img src="{{ asset('images/loader-gray.gif') }}" /></span>
									Upload
								  </button>
								</div>
							  </div>
							</form>
						</div>
					</div>
        </div>
    </div>
</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 60000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        }).then((result) => {
		  // Reload the Page
		  location.reload(true);
		});
    })
</script>