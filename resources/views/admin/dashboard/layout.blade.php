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
    <title>{{ $pageTitle ?? 'Gallery Management - Kayise IT Dashboard' }}</title>
    <meta name="description" content="Gallery Management Dashboard">
    <meta name="keywords" content="gallery, dashboard, admin">
    <link rel="icon" type="image/png" sizes="684x365" href="../images/kayise_IT_logo_No_Background.png">

    <!-- Tailwind CSS - Loaded first for admin panels -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
    
    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased bg-gray-50">
    <div x-data="dashboardData()" class="flex h-screen bg-slate-50" @click.away="closeDropdowns()">
        
        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 flex z-40 md:hidden" 
             @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        </div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0"
             x-show="sidebarOpen || window.innerWidth >= 768">
            
            <div class="flex flex-col h-full">
                <!-- Logo & Brand -->
                <div class="flex items-center justify-between px-6 h-16 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-kb-100 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">K</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">KayiseIT</h2>
                    </div>
                    <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    @include('admin.dashboard.partials._navigation')
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            @include('admin.dashboard.partials._header')

            <!-- Main Content Area -->
            <main class="flex-1 overflow-auto bg-slate-50">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Toast Notifications -->
    <x-alerting />

    <!-- Alpine.js CDN must load first -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Alpine.js data and functions -->
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
            Alpine.data('dashboardData', () => ({
                activeTab: 'dashboard',
                sidebarOpen: false,
                userDropdownOpen: false,
                
                init() {
                    console.log('Dashboard data initialized');
                },
                
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },
                
                closeDropdowns() {
                    this.userDropdownOpen = false;
                },
                
                getCurrentTabTitle() {
                    const tabTitles = {
                        dashboard: 'Dashboard',
                        clients: 'Clients',
                        staff: 'Staff',
                        gallery: 'Gallery',
                        carousel: 'Carousel',
                        services: 'Services',
                        internships: 'Internships',
                        applications: 'Applications',
                        invoices: 'Invoices',
                        quotations: 'Quotations',
                        careermapping: 'Career Mapping',
                        blogs: 'Blogs'
                    };
                    return tabTitles[this.activeTab] || 'Dashboard';
                }
            }));
        });
    </script>
</body>
</html>
