@php
session_start();
@endphp
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
    <!-- Fonts -->
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @vite('node_modules/bootstrap/dist/css/bootstrap.min.css')
    @vite('node_modules/owl.carousel/dist/assets/owl.carousel.min.css')
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script> -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=Aaq9Jhzs7pMXZLUEmCSwHWDB34sZP5LKoMMv8YEGKFPSLcnYX_No11nJEy87QxP9t9pvVNtAVUpj9BAh"></script>-->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script> -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    @vite('node_modules/jquery/dist/jquery.min.js')
    @vite('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')
    @vite('node_modules/owl.carousel/dist/owl.carousel.min.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- scripts for career mapping tabs  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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