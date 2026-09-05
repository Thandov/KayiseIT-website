<x-app-layout>
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
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-[#183ea4] rounded-lg flex items-center justify-center">
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
                    <!-- Dashboard -->
                    <a href="#" @click.prevent="activeTab = 'dashboard'" 
                       :class="activeTab === 'dashboard' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'dashboard' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21v-5a2 2 0 012-2h4a2 2 0 012 2v5"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Clients -->
                    <a href="#" @click.prevent="activeTab = 'clients'" 
                       :class="activeTab === 'clients' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'clients' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Clients
                    </a>

                    <!-- Staff -->
                    <a href="#" @click.prevent="activeTab = 'staff'" 
                       :class="activeTab === 'staff' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'staff' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Staff
                    </a>

                    <!-- Gallery -->
                    <a href="#" @click.prevent="activeTab = 'gallery'" 
                       :class="activeTab === 'gallery' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'gallery' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gallery
                    </a>

                    <!-- Carousel -->
                    <a href="#" @click.prevent="activeTab = 'carousel'" 
                       :class="activeTab === 'carousel' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'carousel' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Carousel
                    </a>

                    <!-- Announcements -->
                    <a href="#" @click.prevent="activeTab = 'announcements'" 
                       :class="activeTab === 'announcements' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'announcements' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Announcements
                    </a>

                    <!-- Services -->
                    <a href="#" @click.prevent="activeTab = 'services'" 
                       :class="activeTab === 'services' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'services' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Services
                    </a>

                    <!-- Applications -->
                    <a href="#" @click.prevent="activeTab = 'applications'" 
                       :class="activeTab === 'applications' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'applications' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Applications
                    </a>

                    <!-- Internships -->
                    <a href="#" @click.prevent="activeTab = 'internships'" 
                       :class="activeTab === 'internships' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'internships' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Internships
                    </a>

                    <!-- Invoices -->
                    <a href="#" @click.prevent="activeTab = 'invoices'" 
                       :class="activeTab === 'invoices' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'invoices' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                        </svg>
                        Invoices
                    </a>

                    <!-- Quotations -->
                    <a href="#" @click.prevent="activeTab = 'quotations'" 
                       :class="activeTab === 'quotations' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'quotations' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Quotations
                    </a>

                    <!-- Case Studies -->
                    <a href="#" @click.prevent="activeTab = 'case-studies'" 
                       :class="activeTab === 'case-studies' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'case-studies' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Case Studies
                    </a>

                    <!-- In-House Products -->
                    <a href="#" @click.prevent="activeTab = 'products'" 
                       :class="activeTab === 'products' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline">
                        <svg class="w-5 h-5 mr-3" :class="activeTab === 'products' ? 'text-blue-700' : 'text-gray-400 group-hover:text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        In-House Products
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between h-12">
                    <div class="flex items-center space-x-4">
                        <button @click="toggleSidebar()" class="text-gray-500 hover:text-gray-700 md:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-900 leading-none flex items-center h-full" x-text="getCurrentTabTitle()"></h1>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" 
                                class="flex items-center space-x-3 h-full text-sm rounded-lg p-2 hover:bg-gray-50 transition-colors duration-200">
                            <div class="w-8 h-8 bg-[#183ea4] rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-medium text-sm">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="text-left hidden md:block">
                                <div class="font-medium text-gray-900">{{ auth()->user()->name ?? 'Admin' }}</div>
                                <div class="text-gray-500 text-xs">{{ auth()->user()->email ?? 'admin@kayise.com' }}</div>
                            </div>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        </button>

                    <!-- Dropdown Menu -->
                    <div x-show="userDropdownOpen" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile Settings
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            General Settings
                        </a>
                        <div class="border-t border-gray-200 my-1"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-auto bg-slate-50">
                <div class="p-6">
                    <!-- Dashboard Content -->
                    <div x-show="activeTab === 'dashboard'" class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Dashboard Overview</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div class="lg:col-span-2">
                                    @include('admin.dashboard.sales._salestats')
                                </div>
                                <div>
                                    @include('admin.dashboard.clients._clientspanel')
                                </div>
                            </div>
                        </div>
            </div>

                    <!-- Clients Content -->
                    <div x-show="activeTab === 'clients'" class="space-y-6">
                @include('admin.clients')
            </div>

                    <!-- Staff Content -->
                    <div x-show="activeTab === 'staff'" class="space-y-6">
                @include('admin.staff')
            </div>

                    <!-- Gallery Content -->
                    <div x-show="activeTab === 'gallery'" class="space-y-6">
                @include('admin.dashboard.gallery')
            </div>

                    <!-- Carousel Content -->
                    <div x-show="activeTab === 'carousel'" class="space-y-6">
                @include('admin.dashboard.carousel.carousel')
            </div>

                    <!-- Announcements Content -->
                    <div x-show="activeTab === 'announcements'" class="space-y-6">
                @include('admin.dashboard.announcements.index')
            </div>

                    <!-- Services Content -->
                    <div x-show="activeTab === 'services'" class="space-y-6">
                @include('admin.services')
            </div>

                    <!-- Internships Content -->
                    <div x-show="activeTab === 'internships'" class="space-y-6">
                @include('admin.internships')
            </div>

                    <!-- Applications Content -->
                    <div x-show="activeTab === 'applications'" class="space-y-6">
                @include('admin.applications')
            </div>

                    <!-- Invoices Content -->
                    <div x-show="activeTab === 'invoices'" class="space-y-6">
                @include('admin.invoices')
            </div>

                    <!-- Quotations Content -->
                    <div x-show="activeTab === 'quotations'" class="space-y-6">
                @include('admin.quotations')
            </div>

                    <!-- Career Mapping Content -->
                    <div x-show="activeTab === 'careermapping'" class="space-y-6">
                @include('admin.dashboard.careermapping_dashboard')
            </div>

                    <!-- Blogs Content -->
                    <div x-show="activeTab === 'blogs'" class="space-y-6">
                @include('admin.blogs')
            </div>

                    <!-- Case Studies Content -->
                    <div x-show="activeTab === 'case-studies'" class="space-y-6">
                @include('admin.dashboard.case-studies.index')
            </div>

                    <!-- In-House Products Content -->
                    <div x-show="activeTab === 'products'" class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">In-House Developed Software</h2>
                        <a href="{{ route('home') }}#software" target="_blank" class="text-sm text-blue-600 hover:text-blue-700 inline-flex items-center">
                            View on Website
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-semibold text-yellow-800 mb-1">Software Products Management</h3>
                                <p class="text-sm text-yellow-700">The in-house software products (KIT Accounting, QR Code Generator, Asset Management, Project Management, Document Management) are currently displayed on the home page. To manage these products, edit the home page section directly or create a dedicated management interface.</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">KIT Accounting</h3>
                            </div>
                            <p class="text-sm text-gray-600">Comprehensive accounting software for businesses</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">QR Code Generator</h3>
                            </div>
                            <p class="text-sm text-gray-600">Generate QR codes for various business needs</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">Asset Management</h3>
                            </div>
                            <p class="text-sm text-gray-600">Track and manage company assets efficiently</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium text-orange-600 bg-orange-100 rounded">Coming Soon</span>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">Project Management</h3>
                            </div>
                            <p class="text-sm text-gray-600">Streamline project workflows and collaboration</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium text-orange-600 bg-orange-100 rounded">Coming Soon</span>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900">Document Management</h3>
                            </div>
                            <p class="text-sm text-gray-600">Organize and manage documents securely</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium text-orange-600 bg-orange-100 rounded">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </main>
        </div>
    </div>

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
                        announcements: 'Announcements',
                        services: 'Services',
                        internships: 'Internships',
                        applications: 'Applications',
                        invoices: 'Invoices',
                        quotations: 'Quotations',
                        careermapping: 'Career Mapping',
                        blogs: 'Blogs',
                        'case-studies': 'Case Studies',
                        products: 'In-House Products'
                    };
                    return tabTitles[this.activeTab] || 'Dashboard';
                }
            }));
        });
    </script>
</x-app-layout>