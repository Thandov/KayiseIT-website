<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HJTS8XQSPF"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-HJTS8XQSPF');
    </script>

    <!-- SEO META TAGS -->
    <title>{{ $metaTitle ?? config('app.name', 'Kayise IT') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Welcome to KAYISE IT, a leading IT company specializing in software and web development, as well as providing 4IR skills training.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'ICT, Technology, Computers and Information Technology, Software, IT Support, IT Company' }}">
    <link rel="icon" type="image/png" sizes="684x365" href="../images/kayise_IT_logo_No_Background.png">
    
    <!-- Sitemap -->
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Font Awesome for admin pages -->
    @if((isset($isAdmin) && $isAdmin) || request()->is('dashboard/*'))
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @endif
    <!-- Styles: Tailwind via Vite only -->
    
    @if((isset($isAdmin) && $isAdmin) || request()->is('dashboard/*'))
        <!-- Admin Tailwind CSS CDN Override - In production, you should use built assets -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                content: ['./resources/views/admin/**/*.blade.php', './resources/views/**/*.blade.php'],
                theme: {
                    extend: {
                        colors: {
                            'kb': {
                                50: '#f0f4ff',
                                100: '#183ea4',
                                200: '#0086c9',
                                300: '#0070b6',
                                400: '#0064ad',
                                500: '#1d53a0',
                                600: '#274698',
                                700: '#263a57',
                            },
                            'kg': {
                                50: '#f0fdf4',
                                100: '#c7e0c2',
                                200: '#a2cfa8',
                                300: '#7cbd81',
                                400: '#3fab5f',
                                500: '#368e4f',
                                600: '#28663d',
                                700: '#22C55E',
                                800: '#1a5a2f',
                                900: '#0f3421',
                            }
                        }
                    }
                }
            }
        </script>
    @endif
    
    <!-- Stack for additional styles -->
    @stack('styles')
    
    <!-- Scripts -->
    <!-- Optional vendor scripts removed to keep Tailwind-only front-end -->
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
</head>

<body class="antialiased">
    <div class="min-h-screen bg-white-100">
        @php
            $services = collect([]); // Default to empty collection
            try {
                if (class_exists('App\Models\Service')) {
                    $services = App\Models\Service::all();
                }
            } catch (\Exception $e) {
                // Silently fail - use empty collection
                $services = collect([]);
            } catch (\Throwable $e) {
                // Catch any other errors
                $services = collect([]);
            }
        @endphp

        @include('layouts.navigation')

        <!-- Page Heading -->
        @if(isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="pt-0">
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </main>
        @include('layouts.footer')
    </div>
    
    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>

</html>
