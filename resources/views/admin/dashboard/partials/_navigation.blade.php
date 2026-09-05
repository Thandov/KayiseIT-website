@php
    $navItem = 'flex items-center w-full px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline text-left';
    $navActive = 'bg-kg-50 text-kg-700';
    $navIdle = 'text-gray-700 hover:bg-gray-50';
    $navParentActive = 'text-kg-700 hover:bg-gray-50';
    $icon = 'w-5 h-5 mr-3 shrink-0';
    $iconActive = 'text-kg-700';
    $iconIdle = 'text-gray-400 group-hover:text-gray-600';

    $authUser = auth()->user();
    $isAdmin = $authUser && method_exists($authUser, 'isDashboardAdmin') && $authUser->isDashboardAdmin();
    $canClients = $authUser && method_exists($authUser, 'canAccessClients') && $authUser->canAccessClients();
    $canPrograms = $authUser && method_exists($authUser, 'hasAnyStaffPermission')
        && $authUser->hasAnyStaffPermission(['programs.read', 'programs.create', 'programs.update', 'programs.approve']);
    $canProfile = $authUser && (
        (method_exists($authUser, 'hasStaffPermission') && $authUser->hasStaffPermission('profile.own'))
        || (method_exists($authUser, 'isStaffMember') && $authUser->isStaffMember() && $authUser->employee)
    );
    $canSiteSettings = $authUser && method_exists($authUser, 'hasStaffPermission') && $authUser->hasStaffPermission('site-settings.manage');

    $isPeople = request()->routeIs('dashboard.clients*', 'admin.dashboard.staff', 'dashboard.staff*', 'dashboard.people*', 'dashboard.partners*', 'dashboard.interns-learners*', 'dashboard.access*');
    $isContent = request()->routeIs('dashboard.gallery', 'gallery*', 'admin.dashboard.carousel*', 'admin.dashboard.announcements*', 'dashboard.blogs*', 'dashboard.case-studies*');
    $isTraining = request()->routeIs('dashboard.services*', 'dashboard.programs*', 'dashboard.academy*', 'dashboard.careermapping*');
    $isBusiness = request()->routeIs('dashboard.invoices*', 'dashboard.quotations*', 'dashboard.products*');
@endphp

<div class="flex flex-col gap-1">
    <a href="{{ route('dashboard') }}"
       class="{{ $navItem }} {{ request()->routeIs('dashboard') ? $navActive : $navIdle }}">
        <svg class="{{ $icon }} {{ request()->routeIs('dashboard') ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21v-5a2 2 0 012-2h4a2 2 0 012 2v5"></path>
        </svg>
        Dashboard
    </a>

    @if($canProfile)
    <a href="{{ route('dashboard.profile') }}"
       class="{{ $navItem }} {{ request()->routeIs('dashboard.profile') ? $navActive : $navIdle }}">
        <svg class="{{ $icon }} {{ request()->routeIs('dashboard.profile') ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        My profile
    </a>
    @endif

    <div x-data="{ open: {{ $isPeople ? 'true' : 'false' }} }">
        <button type="button"
                class="{{ $navItem }} {{ $isPeople ? $navParentActive : $navIdle }}"
                @click="open = !open"
                :aria-expanded="open">
            <svg class="{{ $icon }} {{ $isPeople ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="flex-1">People</span>
            <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div x-show="open" x-cloak class="mt-1 ml-4 pl-3 border-l border-gray-200 flex flex-col gap-1">
            @if($canClients)
            <a href="{{ route('dashboard.clients') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.clients*') ? $navActive : $navIdle }}">
                Clients
            </a>
            @endif
            <a href="{{ route('admin.dashboard.staff') }}"
               class="{{ $navItem }} {{ request()->routeIs('admin.dashboard.staff') || request()->routeIs('dashboard.staff*') ? $navActive : $navIdle }}">
                Staff
            </a>
            @if($isAdmin)
            <a href="{{ route('dashboard.access') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.access*') ? $navActive : $navIdle }}">
                Access &amp; titles
            </a>
            <a href="{{ route('dashboard.people') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.people*') ? $navActive : $navIdle }}">
                People
            </a>
            <a href="{{ route('dashboard.partners') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.partners*') ? $navActive : $navIdle }}">
                Partners
            </a>
            <a href="{{ route('dashboard.interns-learners') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.interns-learners*') ? $navActive : $navIdle }}">
                Interns & Learners
            </a>
            @endif
        </div>
    </div>

    @if($isAdmin || $canPrograms)
    @if($isAdmin)
    <div x-data="{ open: {{ $isContent ? 'true' : 'false' }} }">
        <button type="button"
                class="{{ $navItem }} {{ $isContent ? $navParentActive : $navIdle }}"
                @click="open = !open"
                :aria-expanded="open">
            <svg class="{{ $icon }} {{ $isContent ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="flex-1">Content</span>
            <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div x-show="open" x-cloak class="mt-1 ml-4 pl-3 border-l border-gray-200 flex flex-col gap-1">
            <a href="{{ route('dashboard.gallery') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.gallery') || request()->routeIs('gallery') ? $navActive : $navIdle }}">
                Gallery
            </a>
            <a href="{{ route('admin.dashboard.carousel') }}"
               class="{{ $navItem }} {{ request()->routeIs('admin.dashboard.carousel*') ? $navActive : $navIdle }}">
                Carousel
            </a>
            <a href="{{ route('admin.dashboard.announcements.index') }}"
               class="{{ $navItem }} {{ request()->routeIs('admin.dashboard.announcements*') ? $navActive : $navIdle }}">
                Announcements
            </a>
            <a href="{{ route('dashboard.blogs') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.blogs*') ? $navActive : $navIdle }}">
                Blogs
            </a>
            <a href="{{ route('dashboard.case-studies.index') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.case-studies*') ? $navActive : $navIdle }}">
                Case Studies
            </a>
        </div>
    </div>
    @endif

    <div x-data="{ open: {{ $isTraining ? 'true' : 'false' }} }">
        <button type="button"
                class="{{ $navItem }} {{ $isTraining ? $navParentActive : $navIdle }}"
                @click="open = !open"
                :aria-expanded="open">
            <svg class="{{ $icon }} {{ $isTraining ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="flex-1">Training</span>
            <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div x-show="open" x-cloak class="mt-1 ml-4 pl-3 border-l border-gray-200 flex flex-col gap-1">
            @if($isAdmin)
            <a href="{{ route('dashboard.services') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.services*') ? $navActive : $navIdle }}">
                Services
            </a>
            @endif
            @if($canPrograms)
            <a href="{{ route('dashboard.programs') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.programs*') ? $navActive : $navIdle }}">
                Programs
            </a>
            @endif
            @if($isAdmin)
            <a href="{{ route('dashboard.academy.index') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.academy*') ? $navActive : $navIdle }}">
                Academy
            </a>
            <a href="{{ route('dashboard.careermapping') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.careermapping*') ? $navActive : $navIdle }}">
                Career Mapping
            </a>
            @endif
        </div>
    </div>

    @if($isAdmin)
    <div x-data="{ open: {{ $isBusiness ? 'true' : 'false' }} }">
        <button type="button"
                class="{{ $navItem }} {{ $isBusiness ? $navParentActive : $navIdle }}"
                @click="open = !open"
                :aria-expanded="open">
            <svg class="{{ $icon }} {{ $isBusiness ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span class="flex-1">Business</span>
            <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div x-show="open" x-cloak class="mt-1 ml-4 pl-3 border-l border-gray-200 flex flex-col gap-1">
            <a href="{{ route('dashboard.invoices') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.invoices*') ? $navActive : $navIdle }}">
                Invoices
            </a>
            <a href="{{ route('dashboard.quotations') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.quotations*') ? $navActive : $navIdle }}">
                Quotations
            </a>
            <a href="{{ route('dashboard.products') }}"
               class="{{ $navItem }} {{ request()->routeIs('dashboard.products*') ? $navActive : $navIdle }}">
                In-House Products
            </a>
        </div>
    </div>
    @endif

    @if($canSiteSettings)
    <a href="{{ route('dashboard.settings') }}"
       class="{{ $navItem }} {{ request()->routeIs('dashboard.settings') ? $navActive : $navIdle }}">
        <svg class="{{ $icon }} {{ request()->routeIs('dashboard.settings') ? $iconActive : $iconIdle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Settings
    </a>
    @endif
    @endif
</div>
