<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @push('styles')
        @vite(['resources/css/dashboard.css'])
    @endpush

    @php
        $user = $user ?? Auth::user();
        $hasProgramRegistration = isset($applications) && $applications->count() > 0;
        $applicationsCount = (isset($applications) ? $applications->count() : 0) + (isset($droneapps) ? $droneapps->count() : 0);
        $quotationsCount = isset($quotations) ? $quotations->count() : 0;
    @endphp

    <div class="profile-shell">
        <div class="profile-layout">
            <!-- Top header -->
            <header class="profile-header">
                <div>
                    <p class="profile-kicker">Kayise IT account</p>
                    <h1 class="profile-title">Welcome back, {{ $user->name }}.</h1>
                    <p class="profile-subtitle">
                        Track your internships, TVET placements, short programmes and billing in one clean view.
                    </p>
                </div>
                <div class="profile-header-meta">
                    <div class="profile-avatar">
                        <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div class="profile-header-text">
                        <p class="profile-header-name">{{ $user->name }}</p>
                        <p class="profile-header-email">{{ $user->email }}</p>
                    </div>
                </div>
            </header>

            <!-- Flash messages -->
            @if (session('success') || session('error'))
                <div class="profile-flash">
                    @if (session('success'))
                        <div class="profile-alert profile-alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="profile-alert profile-alert-error">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            @endif

            <div class="profile-layout-grid">
                <!-- Left column: overview -->
                <aside class="profile-sidebar-card">
                    <div class="profile-sidebar-section">
                        <h2 class="profile-sidebar-title">Account overview</h2>
                        <p class="profile-sidebar-copy">
                            Manage your programme applications, documents and billing from this workspace.
                        </p>
                        <dl class="profile-metrics">
                            <div class="profile-metric">
                                <dt>Programme applications</dt>
                                <dd>{{ $applicationsCount }}</dd>
                            </div>
                            <div class="profile-metric">
                                <dt>Quotations</dt>
                                <dd>{{ $quotationsCount }}</dd>
                            </div>
                            <div class="profile-metric">
                                <dt>Profile status</dt>
                                <dd class="profile-badge">
                                    {{ $hasProgramRegistration ? 'In a programme' : 'Exploring opportunities' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="profile-sidebar-section profile-sidebar-section-muted">
                        <h3 class="profile-sidebar-subtitle">Next step</h3>
                        <p class="profile-sidebar-copy">
                            Ready to join a programme? Browse current opportunities and submit your application.
                        </p>
                        <a href="{{ route('opportunities') }}" class="btn-primary w-full justify-center">
                            View opportunities
                        </a>
                    </div>

                    <div class="profile-sidebar-section">
                        <h3 class="profile-sidebar-subtitle">Account details</h3>
                        <dl class="profile-sidebar-list">
                            <div>
                                <dt>Email</dt>
                                <dd>{{ $user->email }}</dd>
                            </div>
                            @if(!empty($user->phone))
                                <div>
                                    <dt>Phone</dt>
                                    <dd>{{ $user->phone }}</dd>
                                </div>
                            @endif
                        </dl>
                        <button type="button" class="profile-sidebar-link" data-tab-jump="settings">
                            Update profile & password
                        </button>
                    </div>
                </aside>

                <!-- Right column: tabbed content -->
                <main class="profile-main">
                    <!-- All users see applications and status tabs -->
                    <div class="profile-tabs" role="tablist">
                        <button type="button" class="profile-tab is-active" data-tab="applications">
                            Applications
                        </button>
                        @if($hasProgramRegistration)
                            <button type="button" class="profile-tab" data-tab="documents">
                                Supporting documents
                            </button>
                        @endif
                        <button type="button" class="profile-tab" data-tab="career">
                            Career path
                        </button>
                        <button type="button" class="profile-tab" data-tab="resources">
                            Resources
                        </button>
                        <button type="button" class="profile-tab" data-tab="portfolio">
                            Portfolio
                        </button>
                        <button type="button" class="profile-tab" data-tab="progress">
                            Progress
                        </button>
                        <button type="button" class="profile-tab" data-tab="notifications">
                            Notifications
                        </button>
                        <button type="button" class="profile-tab" data-tab="settings">
                            Settings
                        </button>
                    </div>

                    <section id="tab-applications" class="profile-panel is-active" data-tab-panel="applications" role="tabpanel">
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Programme applications</h2>
                                <p class="profile-panel-subtitle">
                                    View the status of your internship, TVET placement and short programme applications.
                                </p>
                            </div>
                            <a href="{{ route('opportunities') }}" class="btn-primary">
                                Apply for a programme
                            </a>
                        </header>
                        @include('profile.partials.application')
                    </section>

                    @if($hasProgramRegistration)
                        <section id="tab-documents" class="profile-panel" data-tab-panel="documents" role="tabpanel" hidden>
                            <header class="profile-panel-header">
                                <div>
                                    <h2 class="profile-panel-title">Supporting documents</h2>
                                    <p class="profile-panel-subtitle">
                                        Securely stored copies of your CV, ID and qualifications for each programme application.
                                    </p>
                                </div>
                            </header>
                            @include('profile.partials.documents')
                        </section>
                    @endif

                    <section id="tab-career" class="profile-panel" data-tab-panel="career" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Career path</h2>
                                <p class="profile-panel-subtitle">
                                    Map out where you are now and where you want your career to go.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.career-path')
                    </section>

                    <section id="tab-resources" class="profile-panel" data-tab-panel="resources" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Learning resources</h2>
                                <p class="profile-panel-subtitle">
                                    Curated articles, videos and tools to help you succeed in your programme.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.resources')
                    </section>

                    <section id="tab-portfolio" class="profile-panel" data-tab-panel="portfolio" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Portfolio</h2>
                                <p class="profile-panel-subtitle">
                                    Showcase the projects and work you are most proud of.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.portfolio')
                    </section>

                    <section id="tab-progress" class="profile-panel" data-tab-panel="progress" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Progress</h2>
                                <p class="profile-panel-subtitle">
                                    Keep an eye on milestones and how far you have come.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.progress')
                    </section>

                    <section id="tab-notifications" class="profile-panel" data-tab-panel="notifications" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Notifications</h2>
                                <p class="profile-panel-subtitle">
                                    See important updates about your applications and programmes.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.notifications')
                    </section>

                    <section id="tab-settings" class="profile-panel" data-tab-panel="settings" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Account & security</h2>
                                <p class="profile-panel-subtitle">
                                    Update your personal details, password and privacy preferences.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.settings')
                    </section>
                </main>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/dashboard.js'])
    @endpush
</x-app-layout>