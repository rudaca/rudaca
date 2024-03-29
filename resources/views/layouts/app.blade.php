<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
		
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
				@include('alerts.error')
				@include('alerts.success')
				@include('alerts.warning')
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

		<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				showCloseButton: true,
				timer: 120000,
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
			});
			
			document.getElementById("exampleInputName").addEventListener("change", function() {
				if(this.files.length > 20){
					this.value=null;
					alert('Maximum number of allowable file uploads has been exceeded.  Only 20 files are allowed at one time');
				}
			});
		</script>
        @livewireScripts
    </body>
</html>
