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

    @php
        $defaultMetaDescription = 'Welcome to KAYISE IT, a leading IT company specializing in software and web development, as well as providing 4IR skills training.';
        $defaultMetaKeywords = 'ICT, Technology, Computers and Information Technology, Software, IT Support, IT Company';
        $resolvedTitle = $metaTitle ?? config('app.name', 'KAYISE IT');
        $resolvedDescription = $metaDescription ?? $defaultMetaDescription;
        $resolvedKeywords = $metaKeywords ?? $defaultMetaKeywords;
        $canonicalUrl = url()->current();
        $ogImagePath = $metaOgImage ?? 'images/banner/businessAnalyst.png';
        $ogImageAbsolute = \Illuminate\Support\Str::startsWith($ogImagePath, ['http://', 'https://'])
            ? $ogImagePath
            : asset($ogImagePath);
        $siteUrl = rtrim((string) config('app.url'), '/');
        $organizationLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'KAYISE IT',
            'url' => $siteUrl ?: url('/'),
            'logo' => asset('images/logo.svg'),
            'email' => 'info@kayiseit.com',
            'telephone' => '+27-87-702-2625',
            'sameAs' => [
                'https://www.facebook.com/KAYISEIT?mibextid=ZbWKwL',
                'https://instagram.com/kayiseit?igshid=ZDdkNTZiNTM=',
                'https://www.linkedin.com/company/kayise-it/',
                'https://www.youtube.com/channel/UCrAixDqFR92LBqC7OBF3Eqw',
            ],
        ];
    @endphp

    <!-- SEO META TAGS -->
    <title>{{ $resolvedTitle }}</title>
    <meta name="description" content="{{ e($resolvedDescription) }}">
    @if($resolvedKeywords !== '')
        <meta name="keywords" content="{{ e($resolvedKeywords) }}">
    @endif
    @if(!empty($metaNoindex))
        <meta name="robots" content="noindex,follow">
    @endif
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name', 'KAYISE IT') }}">
    <meta property="og:title" content="{{ e($resolvedTitle) }}">
    <meta property="og:description" content="{{ e($resolvedDescription) }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImageAbsolute }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ e($resolvedTitle) }}">
    <meta name="twitter:description" content="{{ e($resolvedDescription) }}">
    <meta name="twitter:image" content="{{ $ogImageAbsolute }}">

    <script type="application/ld+json">{!! json_encode($organizationLd, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}</script>

    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">

    <!-- Sitemap -->
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">

    @stack('meta')

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

        <!-- Page Content: offset fixed navbar on public site (dashboard uses own chrome) -->
        <main @class(['pt-16' => ! request()->is('dashboard/*'), 'pt-0' => request()->is('dashboard/*')])>
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </main>
        @include('layouts.footer')

        @php
            $showWhatsappFloating = $showWhatsappFloating ?? true;
            $showChatbotFloating = $showChatbotFloating ?? true;
        @endphp
        @if(!request()->is('dashboard/*') && ($showWhatsappFloating || $showChatbotFloating))
            <div id="kayise-chatbot" class="kayise-chatbot" aria-live="polite">
                @if($showWhatsappFloating)
                    <a
                        class="kayise-chatbot-whatsapp"
                        href="https://wa.me/27693907862"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Chat with us on WhatsApp"
                        title="Chat with us on WhatsApp"
                    >
                        <span class="kayise-chatbot-whatsapp-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
                                <path d="M19.05 4.94A9.9 9.9 0 0012 2a9.93 9.93 0 00-8.63 14.84L2 22l5.31-1.39A9.93 9.93 0 1019.05 4.94zm-7.05 15.37a8.28 8.28 0 01-4.22-1.16l-.3-.18-3.15.82.84-3.07-.2-.31A8.28 8.28 0 1112 20.31zm4.54-6.19c-.25-.13-1.47-.72-1.7-.8-.23-.08-.39-.13-.56.12-.16.25-.64.8-.78.97-.14.16-.28.19-.53.06-.25-.13-1.04-.38-1.98-1.2-.74-.66-1.24-1.46-1.38-1.71-.14-.25-.02-.38.11-.5.11-.11.25-.28.38-.42.13-.14.17-.25.25-.41.08-.16.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.84-.2-.48-.4-.42-.56-.43l-.48-.01c-.16 0-.42.06-.64.31-.22.25-.84.82-.84 2 0 1.18.86 2.31.98 2.47.13.16 1.7 2.6 4.12 3.65.58.25 1.03.4 1.38.51.58.18 1.1.15 1.52.09.46-.07 1.47-.6 1.68-1.17.21-.57.21-1.06.15-1.17-.07-.11-.23-.18-.48-.31z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="kayise-chatbot-whatsapp-text" aria-hidden="true">WhatsApp</span>
                        <span class="kayise-chatbot-toggle-label">Open WhatsApp chat</span>
                    </a>
                @endif

                @if($showChatbotFloating)
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
                        <textarea id="kayise-chatbot-input" rows="1" wrap="soft" placeholder="Type your question..." maxlength="250" required></textarea>
                        <button type="submit">Send</button>
                    </form>
                </section>
                @endif
            </div>

            @if($showChatbotFloating)
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
        @endif
    </div>
    
    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>

</html>
