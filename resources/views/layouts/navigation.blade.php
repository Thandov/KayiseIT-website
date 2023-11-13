@if(!Route::is('dashboard'))
@if (empty(Auth::user()->name))
<nav class="grid grid-cols-2 bg-white border-b border-gray-100 px-5 py-3">
    <div class="col-start-2 md:grid md:grid-cols-4">
        @if (Route::has('login'))
        @auth @else @if (Route::has('login'))
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex col-start-3">
            <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="justify-end col-start-2">
                {{ __('Login') }}
            </x-nav-link>
        </div>
        @endif @if (Route::has('register'))
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex col-start-4">

            <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="justify-end">
                {{ __('Register') }}
            </x-nav-link>
        </div>
        @endif @endauth
        @endif
    </div>
</nav>
@endif
<nav x-data="{ open: false }" class="bg-white px-5 grid grid-cols-7">
    <!-- Logo -->
    <div class="">
        <a href="{{ route('home') }}" class="col-start-2">
            <x-application-logo class="block h-5 w-auto fill-current text-gray-600" />
        </a>
    </div>
    <div class="d-flex items-center justify-end col-span-6">

        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>Services</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @foreach ($services as $service)
                    @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
                    <x-dropdown-link :href="route('service.show', $slug)">
                        {{ $service->name }}
                    </x-dropdown-link>

                    @endforeach

                </x-slot>
            </x-dropdown>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('career-mapping')" :active="request()->routeIs('career-mapping')">
                {{ __('Career Mapping') }}
            </x-nav-link>
        </div>
        <!--         <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')">
                {{ __('Blogs') }}
            </x-nav-link>
        </div> 
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('events')" :active="request()->routeIs('events')">
                {{ __('Events') }}
            </x-nav-link>
        </div>-->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact Us') }}
            </x-nav-link>
        </div>

        <!-- dropdown profile and logout -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>@if (!empty(Auth::user()->name)){{ Auth::user()->name }}@endif</div>
                        @if (!empty(Auth::user()->name))
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @endif
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Navigation Links -->
                    @if (!empty(Auth::user()->name))
                    @if(Auth::user()->hasRole('admin'))
                    <x-dropdown-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>
                    @endif
                    @endif
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>


                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        <!-- Hamburger -->
        <div class="col-start-4 -mr-2 flex items-center md:hidden sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @if (!empty(Auth::user()->name))
        <div class="pt-2 pb-3 space-y-1">

        </div>
        @endif

        <!-- Navigation Links -->
        @if (!empty(Auth::user()->name))
        @if(Auth::user()->hasRole('admin'))
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>
        @endif
        @endif

        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>
        </div>

        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="px-1 flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>Services</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @foreach ($services as $service)
                    <x-dropdown-link :href="url('viewservice/'.$service->id)">
                        {{ $service->name }}
                    </x-dropdown-link>
                    @endforeach

                </x-slot>
            </x-dropdown>
        </div>

        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-nav-link>
        </div>
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('career-mapping')" :active="request()->routeIs('career-mapping')">
                {{ __('Career Mapping') }}
            </x-nav-link>
        </div>
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')">
                {{ __('Blogs') }}
            </x-nav-link>
        </div>
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('events')" :active="request()->routeIs('events')">
                {{ __('Events') }}
            </x-nav-link>
        </div>
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact Us') }}
            </x-nav-link>
        </div>

        <!-- dropdown profile and logout -->
        <div class=" sm:flex sm:items-center space-y-1 sm:ml-6">
            <x-dropdown align="right" width="">
                <x-slot name="trigger">
                    <button class="flex items-center  text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>@if (!empty(Auth::user()->name)){{ Auth::user()->name }}@endif</div>
                        @if (!empty(Auth::user()->name))
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @endif
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>


                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
@endif