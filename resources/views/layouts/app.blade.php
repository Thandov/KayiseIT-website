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
    <link rel="icon" type="image/png" sizes="684x365" href="./images/kayise_IT_logo_No_Background.png">
    <!-- Fonts -->
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
    <!-- href -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/scripts.js') }}" defer></script>
    <script src="{{ asset('/js/live_img_change.js') }}" defer></script>
    <script>
    let i = 0;
    $("#duplicate-form").click(function() {
        i++;
        var form = $("#subservice-form").clone();
        form.attr("id", "subservice-form-" + (i + 1));
        form.find("input[name=name]").attr("id", "name-" + (i + 1));
        form.find("input[name=description]").attr("id", "description-" + (i + 1));
        form.find("input[name=price]").attr("id", "price-" + (i + 1));
        form.appendTo("body");
        form.find("input[type=text], textarea").val("");
    });
    </script>
    <script>
    $(document).ready(function() {
        $('button.nav-link').on('show.bs.tab', function(e) {
            console.log($(e.target).attr('data-bs-target').replace('#', ''));
            localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#pills-tab button[data-bs-target="' + activeTab + '"]').tab('show');
        }
    });
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

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