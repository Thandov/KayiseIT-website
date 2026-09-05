<!-- Top Navigation -->
<header class="bg-white border-b border-gray-200 px-6 h-16 flex items-center">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-4">
            <button x-on:click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-900 leading-none my-0">{{ $resolvedPageTitle ?? 'Dashboard' }}</h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span class="hidden sm:inline">View website</span>
            </a>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ userDropdownOpen: false }">
            <button @click="userDropdownOpen = !userDropdownOpen" 
                    class="flex items-center space-x-3 text-sm rounded-lg p-2 hover:bg-gray-50 transition-colors duration-200">
                <div class="w-8 h-8 bg-kb-100 rounded-full flex items-center justify-center flex-shrink-0">
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
                 @click.away="userDropdownOpen = false"
                 class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                <a href="{{ route('dashboard.profile') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 no-underline">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    My profile
                </a>
                <a href="{{ route('dashboard.settings') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 no-underline">
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
        </div>
    </div>
</header>
