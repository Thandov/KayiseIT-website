<nav 
    x-data="{ open: false, scrolled: false }" 
    x-init="
        scrolled = true;
        window.addEventListener('scroll', () => {
            scrolled = true
        });
    "
    id="main-navbar"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-black/95 backdrop-blur-lg navbar-scrolled"
    :style="open ? 'background-color: rgba(255, 255, 255, 0.95) !important;' : ''"
    style="transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}#starfield">
                    <img id="navbar-logo" src="{{ asset('images/kayise-logo.png') }}" alt="KAYISE IT" class="h-8 w-auto transition-opacity duration-300" x-bind:style="open ? 'filter: none' : 'filter: brightness(0) invert(1)'">
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8 navbar-links">
                <a href="{{ route('home') }}#starfield" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('home') ? 'navbar-active' : '' }}">
                    {{ __('Home') }}
                </a>
                
                <!-- Services Dropdown -->
                <div class="relative group">
                    <button class="navbar-link flex items-center transition-colors duration-200 font-medium">
                        {{ __('Services') }}
                        <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-48 bg-white/95 backdrop-blur-md rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                        @if(isset($services) && $services->count() > 0)
                            @foreach ($services as $service)
                            @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
                            <a href="{{ route('service.show', $slug) }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 first:rounded-t-lg last:rounded-b-lg {{ request()->routeIs('service.show') && request()->route('slug') === $slug ? 'bg-gray-50 font-semibold' : '' }}">
                                {{ $service->name }}
                            </a>
                            @endforeach
                        @else
                            <div class="block px-4 py-3 text-gray-500 text-sm">No services available</div>
                        @endif
                    </div>
                </div>
                
                <a href="{{ route('about') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('about') ? 'navbar-active' : '' }}">
                    {{ __('About') }}
                </a>
                <a href="{{ route('opportunities') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('opportunities') ? 'navbar-active' : '' }}">
                    {{ __('Opportunities') }}
                </a>
                <a href="{{ route('training-skills') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('training-skills') ? 'navbar-active' : '' }}">
                    {{ __('Training & Skills') }}
                </a>
                <a href="{{ route('gallery') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('gallery') ? 'navbar-active' : '' }}">
                    {{ __('Gallery') }}
                </a>
                <a href="{{ route('contact') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('contact') ? 'navbar-active' : '' }}">
                    {{ __('Contact') }}
                </a>
                
                <!-- Guest Auth Links -->
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition-colors duration-200 font-medium">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-all duration-200 font-medium">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endguest
                
                <!-- User Profile -->
                @auth
                <div class="relative group">
                    <button class="text-white/90 hover:text-white flex items-center transition-colors duration-200 font-medium">
                        <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center mr-2 transition-colors duration-200">
                            <span class="text-white text-sm font-semibold transition-colors duration-200">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        {{ Auth::user()->name }}
                        <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute top-full right-0 mt-2 w-48 bg-white/95 backdrop-blur-md rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                        @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 first:rounded-t-lg">
                            {{ __('Dashboard') }}
                        </a>
                        @endif
                        @if(Auth::user()->hasRole('student'))
                        <a href="{{ route('student.portal') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 first:rounded-t-lg">
                            {{ __('Student Portal') }}
                        </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 last:rounded-b-lg">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button @click="open = ! open" class="text-white/90 hover:text-white transition-colors duration-200 p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden bg-black/95 backdrop-blur-md border-t border-white/20">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}#starfield" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white' : '' }}">
                    {{ __('Home') }}
                </a>
                
                <div class="space-y-2">
                    <div class="text-white font-medium">{{ __('Services') }}</div>
                    @if(isset($services) && $services->count() > 0)
                        @foreach ($services as $service)
                        @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
                        <a href="{{ route('service.show', $slug) }}" class="block pl-4 text-white/80 hover:text-white transition-colors duration-200">
                            {{ $service->name }}
                        </a>
                        @endforeach
                    @else
                        <div class="block pl-4 text-white/60 text-sm">No services available</div>
                    @endif
                </div>
                
                <a href="{{ route('about') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-white' : '' }}">
                    {{ __('About') }}
                </a>
                <a href="{{ route('opportunities') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('opportunities') ? 'text-white' : '' }}">
                    {{ __('Opportunities') }}
                </a>
                <a href="{{ route('training-skills') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('training-skills') ? 'text-white' : '' }}">
                    {{ __('Training & Skills') }}
                </a>
                <a href="{{ route('gallery') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('gallery') ? 'text-white' : '' }}">
                    {{ __('Gallery') }}
                </a>
                <a href="{{ route('contact') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-white' : '' }}">
                    {{ __('Contact') }}
                </a>
                
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block bg-white/20 hover:bg-white/30 text-white text-center px-4 py-2 rounded-lg transition-all duration-200 font-medium">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endguest
                
                @auth
                <div class="border-t border-white/20 pt-4">
                    @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('dashboard') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-white' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    @endif
                    @if(Auth::user()->hasRole('student'))
                    <a href="{{ route('student.portal') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('student.portal') ? 'text-white' : '' }}">
                        {{ __('Student Portal') }}
                    </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block text-white/90 hover:text-white font-medium transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'text-white' : '' }}">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-white/90 hover:text-white font-medium transition-colors duration-200">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('main-navbar');
    if (!navbar) {
        return;
    }

    const isHomePage = @json(request()->routeIs('home'));

    let lastScrollY = window.scrollY || 0;
    let ticking = false;

    function handleScroll() {
        const currentScrollY = window.scrollY || 0;
        const scrollingDown = currentScrollY > lastScrollY;

        if (isHomePage && currentScrollY > 100 && scrollingDown) {
            navbar.style.transform = 'translateY(-100%)';
            navbar.style.opacity = '0';
            navbar.style.pointerEvents = 'none';
        } else {
            navbar.style.transform = 'translateY(0)';
            navbar.style.opacity = '1';
            navbar.style.pointerEvents = 'auto';
        }

        lastScrollY = currentScrollY;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    handleScroll();
});
</script>