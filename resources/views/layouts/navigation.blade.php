<nav 
    x-data="{ open: false }" 
    id="main-navbar"
    class="fixed top-0 left-0 right-0 z-50 bg-white/10 backdrop-blur-md transition-all duration-300 navbar-transparent"
    :style="open ? 'background-color: rgba(255, 255, 255, 0.95) !important;' : ''"
    style="transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}#starfield">
                    <img id="navbar-logo" src="/images/Logo_White_No_Background.png" alt="KAYISE IT" class="h-8 w-auto transition-opacity duration-300">
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
                <a href="{{ route('gallery') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('gallery') ? 'navbar-active' : '' }}">
                    {{ __('Gallery') }}
                </a>
                <a href="{{ route('contact') }}" class="navbar-link transition-colors duration-200 font-medium {{ request()->routeIs('contact') ? 'navbar-active' : '' }}">
                    {{ __('Contact') }}
                </a>
                
                <!-- Guest Auth Links -->
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" :class="scrolled ? 'text-gray-700 hover:text-gray-900' : 'text-white/90 hover:text-white'" class="transition-colors duration-200 font-medium">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" :class="scrolled ? 'bg-gray-100 hover:bg-gray-200 text-gray-700' : 'bg-white/20 hover:bg-white/30 text-white'" class="px-4 py-2 rounded-lg transition-all duration-200 font-medium">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endguest
                
                <!-- User Profile -->
                @auth
                <div class="relative group">
                    <button :class="scrolled ? 'text-gray-700 hover:text-gray-900' : 'text-white/90 hover:text-white'" class="flex items-center transition-colors duration-200 font-medium">
                        <div :class="scrolled ? 'bg-gray-200' : 'bg-white/20'" class="w-8 h-8 rounded-full flex items-center justify-center mr-2 transition-colors duration-200">
                            <span :class="scrolled ? 'text-gray-700' : 'text-white'" class="text-sm font-semibold transition-colors duration-200">{{ substr(Auth::user()->name, 0, 1) }}</span>
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
                <button @click="open = ! open" :class="scrolled ? 'text-gray-700 hover:text-gray-900' : 'text-white/90 hover:text-white'" class="transition-colors duration-200 p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden bg-white/95 backdrop-blur-md border-t border-white/20">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}#starfield" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-gray-900' : '' }}">
                    {{ __('Home') }}
                </a>
                
                <div class="space-y-2">
                    <div class="text-gray-700 font-medium">{{ __('Services') }}</div>
                    @if(isset($services) && $services->count() > 0)
                        @foreach ($services as $service)
                        @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
                        <a href="{{ route('service.show', $slug) }}" class="block pl-4 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                            {{ $service->name }}
                        </a>
                        @endforeach
                    @else
                        <div class="block pl-4 text-gray-500 text-sm">No services available</div>
                    @endif
                </div>
                
                <a href="{{ route('about') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-gray-900' : '' }}">
                    {{ __('About') }}
                </a>
                <a href="{{ route('opportunities') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('opportunities') ? 'text-gray-900' : '' }}">
                    {{ __('Opportunities') }}
                </a>
                <a href="{{ route('gallery') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('gallery') ? 'text-gray-900' : '' }}">
                    {{ __('Gallery') }}
                </a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-gray-900' : '' }}">
                    {{ __('Contact') }}
                </a>
                
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block bg-gray-100 hover:bg-gray-200 text-gray-700 text-center px-4 py-2 rounded-lg transition-all duration-200 font-medium">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endguest
                
                @auth
                <div class="border-t border-gray-200 pt-4">
                    @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-gray-900' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-gray-700 hover:text-gray-900 font-medium transition-colors duration-200">
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
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('main-navbar');
    if (!navbar) {
        console.error('Navbar not found!');
        return;
    }
    
    let lastScrollY = window.scrollY || 0;
    let ticking = false;
    
    function handleScroll() {
        const currentScrollY = window.scrollY || 0;
        const scrollingDown = currentScrollY > lastScrollY;
        
        const isScrolled = currentScrollY > 100;
        
        // Update navbar background and text colors based on scroll
        if (isScrolled) {
            navbar.classList.add('navbar-scrolled');
            navbar.classList.remove('navbar-transparent');
            // Remove Tailwind background and blur classes that conflict
            navbar.classList.remove('bg-white/10', 'backdrop-blur-md', 'bg-white/95', 'backdrop-blur-lg');
            // Set solid red background and remove blur with !important to override everything
            navbar.style.setProperty('background-color', '#dc2626', 'important'); // red-600
            navbar.style.setProperty('backdrop-filter', 'none', 'important');
            navbar.style.setProperty('-webkit-backdrop-filter', 'none', 'important');
            
            // Update logo
            const logo = document.getElementById('navbar-logo');
            if (logo) {
                logo.src = '/images/kayise_IT_logo_No_Background.png';
            }
            
            // Update all navbar links (preserve active state)
            const links = navbar.querySelectorAll('.navbar-link');
            links.forEach(link => {
                const isActive = link.classList.contains('navbar-active');
                link.classList.remove('text-white/90', 'hover:text-white', 'text-white');
                if (isActive) {
                    link.classList.add('text-green-600', 'hover:text-green-700', 'font-semibold');
                } else {
                    link.classList.add('text-gray-700', 'hover:text-gray-900');
                }
            });
            
            // Update register button
            const registerBtn = navbar.querySelector('.navbar-register');
            if (registerBtn) {
                registerBtn.classList.remove('bg-white/20', 'hover:bg-white/30', 'text-white');
                registerBtn.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
            }
            
            // Update avatar
            const avatar = navbar.querySelector('.navbar-avatar');
            const avatarText = navbar.querySelector('.navbar-avatar-text');
            if (avatar) {
                avatar.classList.remove('bg-white/20');
                avatar.classList.add('bg-gray-200');
            }
            if (avatarText) {
                avatarText.classList.remove('text-white');
                avatarText.classList.add('text-gray-700');
            }
        } else {
            navbar.classList.remove('navbar-scrolled');
            navbar.classList.add('navbar-transparent');
            // Restore Tailwind classes for transparent/blurred state
            navbar.classList.add('bg-white/10', 'backdrop-blur-md');
            navbar.classList.remove('bg-white/95', 'backdrop-blur-lg');
            // Remove inline styles to allow Tailwind classes to work
            navbar.style.removeProperty('background-color');
            navbar.style.removeProperty('backdrop-filter');
            navbar.style.removeProperty('-webkit-backdrop-filter');
            
            // Update logo
            const logo = document.getElementById('navbar-logo');
            if (logo) {
                logo.src = '/images/Logo_White_No_Background.png';
            }
            
            // Update all navbar links (preserve active state)
            const links = navbar.querySelectorAll('.navbar-link');
            links.forEach(link => {
                const isActive = link.classList.contains('navbar-active');
                link.classList.remove('text-gray-700', 'hover:text-gray-900', 'text-green-600', 'hover:text-green-700', 'font-semibold');
                if (isActive) {
                    link.classList.add('text-white', 'font-semibold');
                } else {
                    link.classList.add('text-white/90', 'hover:text-white');
                }
            });
            
            // Update register button
            const registerBtn = navbar.querySelector('.navbar-register');
            if (registerBtn) {
                registerBtn.classList.remove('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700');
                registerBtn.classList.add('bg-white/20', 'hover:bg-white/30', 'text-white');
            }
            
            // Update avatar
            const avatar = navbar.querySelector('.navbar-avatar');
            const avatarText = navbar.querySelector('.navbar-avatar-text');
            if (avatar) {
                avatar.classList.remove('bg-gray-200');
                avatar.classList.add('bg-white/20');
            }
            if (avatarText) {
                avatarText.classList.remove('text-gray-700');
                avatarText.classList.add('text-white');
            }
        }
        
        // Hide navbar when scrolling down past 100px
        if (currentScrollY > 100 && scrollingDown) {
            navbar.style.transform = 'translateY(-100%)';
            navbar.style.opacity = '0';
            navbar.style.pointerEvents = 'none';
        }
        // Show navbar when at top (<= 100px) or scrolling up
        else if (currentScrollY <= 100 || !scrollingDown) {
            navbar.style.transform = 'translateY(0)';
            navbar.style.opacity = '1';
            navbar.style.pointerEvents = 'auto';
        }
        
        lastScrollY = currentScrollY;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
    
    // Initial check
    handleScroll();
    
    // Set initial active states
    const links = navbar.querySelectorAll('.navbar-link');
    links.forEach(link => {
        const isActive = link.classList.contains('navbar-active');
        if (isActive) {
            if (window.scrollY > 100) {
                link.classList.add('text-green-600', 'hover:text-green-700', 'font-semibold');
                link.classList.remove('text-white/90', 'hover:text-white', 'text-white');
            } else {
                link.classList.add('text-white', 'font-semibold');
                link.classList.remove('text-white/90', 'hover:text-white');
            }
        }
    });
    
    console.log('Navbar scroll handler initialized');
});
</script>