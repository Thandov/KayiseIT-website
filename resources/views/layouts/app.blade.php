<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO META TAGS -->
    <title>{{ $metaTitle ?? config('app.name', 'Kayise IT') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Welcome to KAYISE IT, a leading IT company specializing in software and web development, as well as providing 4IR skills training.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'ICT, Technology, Computers and Information Technology, Software, IT Support, IT Company' }}">
    <link rel="icon" type="image/png" sizes="684x365" href="../images/kayise_IT_logo_No_Background.png">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @vite('node_modules/bootstrap/dist/css/bootstrap.min.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/owl.carousel/dist/owl.carousel.min.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white-100">

        @if (session('error'))
        <script>
            // Display SweetAlert for error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        </script>
        @endif

        @if (session('success'))
        <script>
            // Display SweetAlert for success message
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
            });
        </script>
        @endif

        @php
        $services = App\Models\Service::all(); // Replace "YourModel" with the actual model you want to retrieve data from.
        @endphp

        @include('layouts.navigation')

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
            {{ $slot }}
        </main>
        @include('layouts.footer')
    </div>
</body>

</html>