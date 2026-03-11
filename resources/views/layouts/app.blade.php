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
    <link rel="icon" type="image/png" sizes="684x365" href="{{ asset('images/kayise_IT_logo_No_Background.png') }}">
    
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

        @if(!request()->is('dashboard/*'))
            <div id="kayise-chatbot" class="kayise-chatbot" aria-live="polite">
                <button id="kayise-chatbot-toggle" class="kayise-chatbot-toggle" type="button" aria-label="Open chatbot" aria-expanded="false" title="Chat with us">
                    <span class="kayise-chatbot-toggle-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                            <path d="M11 2h2v2h3a3 3 0 013 3v7a3 3 0 01-3 3h-3.2l-2.8 3-2.8-3H5a3 3 0 01-3-3V7a3 3 0 013-3h3V2h2v2h1V2zm-6 6a1 1 0 100 2 1 1 0 000-2zm14 0a1 1 0 100 2 1 1 0 000-2zM7 12h10a3 3 0 01-3 3H10a3 3 0 01-3-3z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="kayise-chatbot-toggle-text" aria-hidden="true">Ask me</span>
                    <span class="kayise-chatbot-toggle-label">Open chatbot assistant</span>
                </button>

                <section id="kayise-chatbot-panel" class="kayise-chatbot-panel" hidden style="display: none;">
                    <header class="kayise-chatbot-header">
                        <h3>KAYISE IT Assistant</h3>
                        <button id="kayise-chatbot-close" type="button" aria-label="Close chatbot">&times;</button>
                    </header>

                    <div id="kayise-chatbot-messages" class="kayise-chatbot-messages">
                        <div class="kayise-chatbot-message bot">Welcome to KAYISE IT. Ask about our services, drone training, school ICT training, partnerships, or contact details.</div>
                    </div>

                    <div class="kayise-chatbot-quick-replies" aria-label="Quick questions">
                        <button type="button" class="kayise-chatbot-quick-reply" data-question="What services does Kayise IT offer?">Services</button>
                        <button type="button" class="kayise-chatbot-quick-reply" data-question="Do you offer drone training?">Drone Training</button>
                        <button type="button" class="kayise-chatbot-quick-reply" data-question="Do you provide ICT training for schools?">ICT Schools</button>
                        <button type="button" class="kayise-chatbot-quick-reply" data-question="How can I partner with Kayise IT?">Partnership</button>
                        <button type="button" class="kayise-chatbot-quick-reply" data-question="How do I contact Kayise IT?">Contact</button>
                    </div>

                    <form id="kayise-chatbot-form" class="kayise-chatbot-form">
                        <input id="kayise-chatbot-input" type="text" placeholder="Type your question..." maxlength="250" required>
                        <button type="submit">Send</button>
                    </form>
                </section>
            </div>

            <script>
                (function () {
                    var init = function () {
                        if (window.__kayiseChatbotStateControlInitialized) {
                            return;
                        }
                        window.__kayiseChatbotStateControlInitialized = true;

                        var toggleBtn = document.getElementById('kayise-chatbot-toggle');
                        var closeBtn = document.getElementById('kayise-chatbot-close');
                        var panel = document.getElementById('kayise-chatbot-panel');
                        var input = document.getElementById('kayise-chatbot-input');

                        if (!toggleBtn || !panel || !closeBtn) {
                            return;
                        }

                        var setPanelState = function (isOpen) {
                            panel.hidden = !isOpen;
                            panel.style.display = isOpen ? 'flex' : 'none';
                            toggleBtn.hidden = isOpen;
                            toggleBtn.style.display = isOpen ? 'none' : 'inline-flex';
                            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                            if (isOpen && input) {
                                input.disabled = false;
                                input.readOnly = false;
                                input.focus();
                            }
                        };

                        // Initialize in closed state for consistent behavior.
                        setPanelState(false);

                        if (input) {
                            // Prevent unrelated global key listeners from blocking typing in chat input.
                            input.addEventListener('keydown', function (event) {
                                event.stopPropagation();
                            });

                            input.addEventListener('click', function (event) {
                                event.stopPropagation();
                                input.disabled = false;
                                input.readOnly = false;
                            });
                        }
                        // Re-apply state after initial render cycle to prevent script race conditions.
                        setTimeout(function () {
                            setPanelState(false);
                        }, 0);

                        toggleBtn.addEventListener('click', function (event) {
                            event.preventDefault();
                            event.stopPropagation();
                            setPanelState(true);
                        });

                        closeBtn.addEventListener('click', function (event) {
                            event.preventDefault();
                            event.stopPropagation();
                            setPanelState(false);
                        });

                        document.addEventListener('click', function (event) {
                            if (!(event.target instanceof Element)) {
                                return;
                            }

                            if (event.target.closest('#kayise-chatbot-toggle') && event.isTrusted) {
                                setPanelState(true);
                                return;
                            }

                            if (event.target.closest('#kayise-chatbot-close') && event.isTrusted) {
                                setPanelState(false);
                            }
                        }, true);

                        document.addEventListener('keydown', function (event) {
                            if (event.key === 'Escape' && panel.hidden === false) {
                                setPanelState(false);
                            }
                        });
                    };

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', init);
                    } else {
                        init();
                    }
                })();
            </script>
        @endif
    </div>
    
    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>

</html>
