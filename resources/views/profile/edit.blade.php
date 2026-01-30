<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @push('styles')
    @vite(['resources/css/dashboard.css'])
    @endpush
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <span>
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </span>
                    <span>KAYISE IT</span>
                </div>
            </div>
            <nav class="sidebar-nav">
                @if(Auth::user()->hasRole('applicant'))
                <a href="#" class="nav-item active" data-tab="applications">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Applications</span>
                </a>
                <a href="#" class="nav-item" data-tab="career">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Career Path</span>
                </a>
                <a href="#" class="nav-item" data-tab="resources">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Resources</span>
                </a>
                <a href="#" class="nav-item" data-tab="portfolio">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    <span>Portfolio</span>
                </a>
                <a href="#" class="nav-item" data-tab="support">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Support</span>
                </a>
                <a href="#" class="nav-item" data-tab="progress">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Progress</span>
                </a>
                <a href="#" class="nav-item" data-tab="notifications">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 102.828 2.828L7.828 9.828l-3 3a2 2 0 11-2.828-2.828L4.828 7z"></path>
                    </svg>
                    <span>Notifications</span>
                </a>
                <a href="#" class="nav-item" data-tab="settings">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Settings</span>
                </a>
                @else
                <a href="#" class="nav-item active" data-tab="projects">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                    </svg>
                    <span>Projects</span>
                </a>
                <a href="#" class="nav-item" data-tab="invoices">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    <span>Invoices</span>
                </a>
                <a href="#" class="nav-item" data-tab="quotations">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Quotations</span>
                </a>
                <a href="#" class="nav-item" data-tab="settings">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Settings</span>
                </a>
                @endif
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Content Header -->
            <div class="content-header">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Manage your account and track your progress.</p>
            </div>

            <!-- Messages -->
    @if(session('success'))
            <div class="content-body">
                <div class="alert alert-success">
        {{ session('success') }}
                </div>
    </div>
    @endif

    @if(session('error'))
            <div class="content-body">
                <div class="alert alert-danger">
        {{ session('error') }}
                </div>
    </div>
    @endif

            <!-- Content Body -->
            <div class="content-body">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h2 class="welcome-title">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                    <p class="welcome-subtitle">Track your progress and manage your applications</p>
                </div>

                <!-- Quick Stats Section -->
                        @if(Auth::user()->hasRole('applicant'))
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number text-blue-600">3</div>
                        <div class="stat-label">Applications</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number text-green-600">2</div>
                        <div class="stat-label">Active</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number text-yellow-600">1</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number text-purple-600">0</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                @endif

                <!-- Content Panels -->
                @if(Auth::user()->hasRole('applicant'))
                <div id="applications-tab" class="content-panel show">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            My Applications
                        </h2>
                        <button class="btn-primary" id="newApplicationBtn">+ New Application</button>
                    </div>
                    @include('profile.partials.application')
                </div>
                
                <div id="career-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Career Path
                        </h2>
                    </div>
                    @include('profile.partials.career-path')
                </div>
                
                <div id="resources-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title">📚 Learning Resources</h2>
                    </div>
                    @include('profile.partials.resources')
                </div>

                <div id="portfolio-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                            My Portfolio
                        </h2>
                        <button class="btn-primary">+ Add Project</button>
                    </div>
                    @include('profile.partials.portfolio')
                </div>
                
                <div id="support-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Support & Help
                        </h2>
            </div>
                    @include('profile.partials.support')
        </div>

                <div id="progress-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            My Progress
                        </h2>
                    </div>
                    @include('profile.partials.progress')
                </div>
                
                <div id="notifications-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 102.828 2.828L7.828 9.828l-3 3a2 2 0 11-2.828-2.828L4.828 7z"></path>
                            </svg>
                            Notifications
                        </h2>
                        <button class="btn-primary">Mark All Read</button>
            </div>
                    @include('profile.partials.notifications')
                </div>
                
                <div id="settings-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </h2>
                </div>
                @include('profile.partials.settings')
            </div>
            @else
                <div id="projects-tab" class="content-panel show">
                    <div class="panel-header">
                        <h2 class="panel-title">📁 Projects</h2>
                    </div>
                    <!-- Projects content -->
                </div>
                
                <div id="invoices-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title">💰 Invoices</h2>
                    </div>
                    <!-- Invoices content -->
                </div>
                
                <div id="quotations-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Quotations
                        </h2>
            </div>
                    @include('profile.partials.quotations')
                </div>
                
                <div id="settings-tab" class="content-panel">
                    <div class="panel-header">
                        <h2 class="panel-title flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </h2>
            </div>
                    @include('profile.partials.settings')
                </div>
                @endif
            </div>
        </div>
        </div>

        <!-- Application Modal -->
        <div id="applicationModal" class="modal-overlay hidden">
            <div class="modal-container">
                <div class="modal-header">
                    <h2 class="modal-title">New Application</h2>
                    <button id="closeModal" class="modal-close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="modal-content">
                    <!-- Step 1: Select Application Type -->
                    <div id="step1" class="modal-step active">
                        <h3 class="step-title">Select Application Type</h3>
                        <div class="application-types">
                            <div class="type-card" data-type="job">
                                <div class="type-icon">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                    </svg>
                                </div>
                                <h4>Job Application</h4>
                                <p>Apply for employment opportunities</p>
                            </div>
                            
                            <div class="type-card" data-type="training">
                                <div class="type-icon">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h4>Training Program</h4>
                                <p>Enroll in skill development courses</p>
                            </div>
                            
                            <div class="type-card" data-type="internship">
                                <div class="type-icon">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                                <h4>Internship</h4>
                                <p>Gain practical work experience</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Available Applications -->
                    <div id="step2" class="modal-step">
                        <h3 class="step-title">Available Applications</h3>
                        <div class="form-section">
                            <div id="availableApplications">
                                <!-- Available applications will be loaded here based on selected type -->
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Personal Information -->
                    <div id="step3" class="modal-step">
                        <h3 class="step-title">Personal Information</h3>
                        <div class="form-section">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">First Name *</label>
                                    <input type="text" id="name" class="form-input" placeholder="Enter your first name" value="{{ explode(' ', Auth::user()->name)[0] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="surname">Surname *</label>
                                    <input type="text" id="surname" class="form-input" placeholder="Enter your surname" value="{{ explode(' ', Auth::user()->name)[1] ?? '' }}">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="dob">Date of Birth *</label>
                                    <input type="date" id="dob" class="form-input" value="{{ Auth::user()->dob ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender *</label>
                                    <select id="gender" class="form-select">
                                        <option value="">Select gender</option>
                                        <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ Auth::user()->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="id_no">ID Number *</label>
                                    <input type="text" id="id_no" class="form-input" placeholder="Enter your ID number" value="{{ Auth::user()->id_number ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="age">Age *</label>
                                    <input type="number" id="age" class="form-input" placeholder="Enter your age" value="{{ Auth::user()->age ?? '' }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Physical Address *</label>
                                <textarea id="address" class="form-textarea" rows="2" placeholder="Enter your full address">{{ Auth::user()->address ?? '' }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="number">Contact Number *</label>
                                <input type="tel" id="number" class="form-input" placeholder="Enter your contact number" value="{{ Auth::user()->phone ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Education Information -->
                    <div id="step4" class="modal-step">
                        <h3 class="step-title">Education Information</h3>
                        <div class="form-section">
                            <div class="form-group">
                                <label for="highest_level">Highest Education Level *</label>
                                <select id="highest_level" class="form-select">
                                    <option value="">Select education level</option>
                                    <option value="Grade 12">Grade 12</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Honours">Honours</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="school_name">School/Institution Name *</label>
                                <input type="text" id="school_name" class="form-input" placeholder="Enter school or institution name">
                            </div>
                            
                            <div class="form-group">
                                <label for="qualification">Qualification/Field of Study *</label>
                                <input type="text" id="qualification" class="form-input" placeholder="e.g., Computer Science, Business Management">
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="year_of_completion">Year of Completion *</label>
                                    <input type="number" id="year_of_completion" class="form-input" placeholder="2023" min="1990" max="2024">
                                </div>
                                <div class="form-group">
                                    <label for="year_obtained">Year Qualification Obtained</label>
                                    <input type="number" id="year_obtained" class="form-input" placeholder="2023" min="1990" max="2024">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Guardian/Next of Kin -->
                    <div id="step5" class="modal-step">
                        <h3 class="step-title">Guardian & Next of Kin</h3>
                        <div class="form-section">
                            <h4 class="section-subtitle">Guardian Information</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="guardian_name">Guardian Name *</label>
                                    <input type="text" id="guardian_name" class="form-input" placeholder="Enter guardian's full name">
                                </div>
                                <div class="form-group">
                                    <label for="relation">Relationship *</label>
                                    <select id="relation" class="form-select">
                                        <option value="">Select relationship</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Guardian">Guardian</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="guardian_number">Guardian Contact Number *</label>
                                    <input type="tel" id="guardian_number" class="form-input" placeholder="Enter guardian's contact number">
                                </div>
                                <div class="form-group">
                                    <label for="guardian_email">Guardian Email</label>
                                    <input type="email" id="guardian_email" class="form-input" placeholder="Enter guardian's email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="guardian_address">Guardian Address *</label>
                                <textarea id="guardian_address" class="form-textarea" rows="2" placeholder="Enter guardian's full address"></textarea>
                            </div>
                            
                            <h4 class="section-subtitle">Next of Kin Information</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="kin_name">Next of Kin Name *</label>
                                    <input type="text" id="kin_name" class="form-input" placeholder="Enter next of kin's full name">
                                </div>
                                <div class="form-group">
                                    <label for="kin_relation">Relationship *</label>
                                    <select id="kin_relation" class="form-select">
                                        <option value="">Select relationship</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="kin_number">Next of Kin Contact Number *</label>
                                <input type="tel" id="kin_number" class="form-input" placeholder="Enter next of kin's contact number">
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Documents & Final Details -->
                    <div id="step6" class="modal-step">
                        <h3 class="step-title">Documents & Final Details</h3>
                        <div class="form-section">
                            <h4 class="section-subtitle">Required Documents</h4>
                            <div class="form-group">
                                <label for="cv_path">Upload CV/Resume *</label>
                                <input type="file" id="cv_path" class="form-file" accept=".pdf,.doc,.docx">
                            </div>
                            
                            <div class="form-group">
                                <label for="id_copy_path">Upload ID Copy *</label>
                                <input type="file" id="id_copy_path" class="form-file" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            
                            <div class="form-group">
                                <label for="qualification_copy_path">Upload Qualification Certificate</label>
                                <input type="file" id="qualification_copy_path" class="form-file" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            
                </div>
            </div>
                </div>
                
                <div class="modal-footer">
                    <div class="step-indicator">
                        <div class="step-dot active" data-step="1"></div>
                        <div class="step-dot" data-step="2"></div>
                        <div class="step-dot" data-step="3"></div>
                        <div class="step-dot" data-step="4"></div>
                        <div class="step-dot" data-step="5"></div>
                        <div class="step-dot" data-step="6"></div>
                    </div>
                    
                    <div class="modal-buttons">
                        <button id="prevStep" class="btn-secondary" style="display: none;">Previous</button>
                        <button id="nextStep" class="btn-primary">Next</button>
                        <button id="submitApplication" class="btn-primary" style="display: none;">Submit Application</button>
            </div>
                </div>
            </div>
        </div>
    @push('scripts')
    @vite(['resources/js/dashboard.js'])
    @endpush
</x-app-layout>