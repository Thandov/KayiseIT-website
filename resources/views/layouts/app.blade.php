<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/imagecheckbox.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/ratingstars.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery3.js') }}"></script>
    <script src="/assets/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script src="{{ asset('/js/scripts.js') }}" defer></script>
    <script>
    let i = 0;
$("#duplicate-form").click(function(){
  i++;
  var form = $("#subservice-form").clone();
  form.attr("id", "subservice-form-" + (i+1));
  form.find("input[name=name]").attr("id", "name-" + (i+1));
  form.find("input[name=description]").attr("id", "description-" + (i+1));
  form.find("input[name=price]").attr("id", "price-" + (i+1));
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
        </div>
    </body>
</html>
