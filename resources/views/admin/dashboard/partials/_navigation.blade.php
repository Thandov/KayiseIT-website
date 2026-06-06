<!-- Dashboard -->
<a href="{{ route('dashboard') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21v-5a2 2 0 012-2h4a2 2 0 012 2v5"></path>
    </svg>
    Dashboard
</a>

<!-- Clients -->
<a href="{{ route('dashboard.clients') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.clients*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.clients*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    Clients
</a>

<!-- Staff -->
<a href="{{ route('admin.dashboard.staff') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('admin.dashboard.staff') || request()->routeIs('dashboard.staff*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard.staff') || request()->routeIs('dashboard.staff*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
    </svg>
    Staff
</a>

<!-- People -->
<a href="{{ route('dashboard.people') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.people*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.people*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    People
</a>

<!-- Gallery -->
<a href="{{ route('dashboard.gallery') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.gallery') || request()->routeIs('gallery') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.gallery') || request()->routeIs('gallery') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    </svg>
    Gallery
</a>

<!-- Carousel -->
<a href="{{ route('admin.dashboard.carousel') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('admin.dashboard.carousel*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard.carousel*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
    </svg>
    Carousel
</a>

<!-- Announcements -->
<a href="{{ route('admin.dashboard.announcements.index') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('admin.dashboard.announcements*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard.announcements*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
    </svg>
    Announcements
</a>

<!-- Partners -->
<a href="{{ route('dashboard.partners') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.partners*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.partners*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    Partners
</a>

<!-- Services -->
<a href="{{ route('dashboard.services') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.services*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.services*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
    </svg>
    Services
</a>

<!-- Applications -->
<a href="{{ route('dashboard.applications') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.applications*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.applications*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    Applications
</a>

<!-- Programs -->
<a href="{{ route('dashboard.programs') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.programs*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.programs*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
    </svg>
    Programs
</a>

<!-- Academy -->
<a href="{{ route('dashboard.academy.index') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.academy*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.academy*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
    </svg>
    Academy
</a>

<!-- Interns & Learners -->
<a href="{{ route('dashboard.interns-learners') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.interns-learners*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.interns-learners*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    Interns & Learners
</a>

<!-- Invoices -->
<a href="{{ route('dashboard.invoices') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.invoices*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.invoices*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
    </svg>
    Invoices
</a>

<!-- Quotations -->
<a href="{{ route('dashboard.quotations') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.quotations*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.quotations*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
    </svg>
    Quotations
</a>

<!-- Case Studies -->
<a href="{{ route('dashboard.case-studies.index') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.case-studies*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.case-studies*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    Case Studies
</a>

<!-- In-House Products -->
<a href="{{ route('dashboard.products') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.products*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.products*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
    </svg>
    In-House Products
</a>

<!-- Blogs -->
<a href="{{ route('dashboard.blogs') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.blogs*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.blogs*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
    </svg>
    Blogs
</a>

<!-- Career Mapping -->
<a href="{{ route('dashboard.careermapping') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.careermapping*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.careermapping*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
    </svg>
    Career Mapping
</a>

<!-- Navigation menu -->
<a href="{{ route('dashboard.nav-menu') }}"
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.nav-menu*') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.nav-menu*') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
    </svg>
    Navigation Menu
</a>

<!-- Settings -->
<a href="{{ route('dashboard.settings') }}" 
   class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 group no-underline {{ request()->routeIs('dashboard.settings') ? 'bg-kg-50 text-kg-700' : 'text-gray-700 hover:bg-gray-50' }}">
    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.settings') ? 'text-kg-700' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    Settings
</a>
