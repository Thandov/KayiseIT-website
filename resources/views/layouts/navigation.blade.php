@php
    use App\Services\NavMenuService;

    $navMenu = app(NavMenuService::class)->buildFrontendConfig(request());
    $menuItems = $navMenu['menuItems'];
    $activeRoutes = $navMenu['activeRoutes'];
    $homeUrl = route('home') . '#hero-banner';
@endphp

<nav
    x-data="{ open: false }"
    id="main-navbar"
    class="kayise-site-nav fixed top-0 left-0 right-0 z-50 border-b border-white/10 transition-[transform,opacity] duration-300 ease-in-out"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <!-- Logo -->
            <a href="{{ $homeUrl }}" class="shrink-0 flex items-center">
                <img
                    src="{{ asset('images/logo.svg') }}"
                    alt="{{ config('app.name', 'KAYISE IT') }}"
                    class="h-8 w-auto brightness-0 invert"
                    width="120"
                    height="32"
                />
            </a>

            <!-- Desktop navigation -->
            <div class="hidden lg:flex flex-1 items-center justify-end gap-1 min-w-0">
                @include('layouts.partials.breeze-nav-menu', [
                    'menuItems' => $menuItems,
                    'activeRoutes' => $activeRoutes,
                    'responsive' => false,
                ])
            </div>

            <!-- Auth (desktop) -->
            <div class="hidden lg:flex items-center shrink-0">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="kayise-nav-user">
                                <span class="kayise-nav-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span class="kayise-nav-user-name">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 shrink-0 opacity-70" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if ((Auth::user()->hasRole('admin') || Auth::user()->isStaffMember()) && Route::has('dashboard'))
                                <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                            @endif
                            @if (Auth::user()->hasRole('student') && Route::has('student.portal'))
                                <x-dropdown-link :href="route('student.portal')">{{ __('Student Portal') }}</x-dropdown-link>
                            @endif
                            @if (Route::has('profile.edit'))
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            @endif
                            @if (Route::has('logout'))
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endif
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="kayise-nav-link kayise-nav-link--ghost">{{ __('Log in') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="kayise-nav-register">{{ __('Register') }}</a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button
                type="button"
                @click="open = ! open"
                class="lg:hidden inline-flex items-center justify-center rounded-md p-2 text-white/80 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/30"
                :aria-expanded="open"
                aria-controls="kayise-mobile-nav"
                aria-label="{{ __('Toggle navigation menu') }}"
            >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path x-show="!open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div
        id="kayise-mobile-nav"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="lg:hidden border-t border-white/10"
        style="display: none;"
    >
        <div class="py-3 space-y-0.5">
            @include('layouts.partials.breeze-nav-menu', [
                'menuItems' => $menuItems,
                'activeRoutes' => $activeRoutes,
                'responsive' => true,
            ])
        </div>

        <div class="border-t border-white/10 py-3">
            @auth
                <div class="px-4 pb-2">
                    <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</p>
                </div>
                <div class="space-y-0.5">
                    @if ((Auth::user()->hasRole('admin') || Auth::user()->isStaffMember()) && Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}" class="kayise-nav-link-mobile {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">{{ __('Dashboard') }}</a>
                    @endif
                    @if (Auth::user()->hasRole('student') && Route::has('student.portal'))
                        <a href="{{ route('student.portal') }}" class="kayise-nav-link-mobile {{ request()->routeIs('student.portal') ? 'is-active' : '' }}">{{ __('Student Portal') }}</a>
                    @endif
                    @if (Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}" class="kayise-nav-link-mobile {{ request()->routeIs('profile.edit') ? 'is-active' : '' }}">{{ __('Profile') }}</a>
                    @endif
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="kayise-nav-link-mobile w-full text-left">{{ __('Log Out') }}</button>
                        </form>
                    @endif
                </div>
            @else
                <div class="px-4 flex flex-col gap-2">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="kayise-nav-link-mobile text-center">{{ __('Log in') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="kayise-nav-register block text-center">{{ __('Register') }}</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>

@unless(request()->is('dashboard/*'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('main-navbar');
    if (!navbar) return;

    const isHomePage = @json(request()->routeIs('home'));
    let lastScrollY = window.scrollY || 0;
    let ticking = false;

    function handleScroll() {
        const currentScrollY = window.scrollY || 0;
        const scrollingDown = currentScrollY > lastScrollY;

        const mobileNav = document.getElementById('kayise-mobile-nav');
        const mobileMenuOpen = mobileNav && window.getComputedStyle(mobileNav).display !== 'none';

        if (isHomePage && currentScrollY > 100 && scrollingDown && !mobileMenuOpen) {
            navbar.style.transform = 'translateY(-100%)';
            navbar.style.opacity = '0';
            navbar.style.pointerEvents = 'none';
        } else {
            navbar.style.transform = '';
            navbar.style.opacity = '';
            navbar.style.pointerEvents = '';
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
@endunless
