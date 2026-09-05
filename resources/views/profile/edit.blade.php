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
    @endphp

    <div class="profile-shell" @if(!$personalInfoComplete) data-initial-tab="personal-info" @endif>
        <div class="profile-layout">
            <!-- Top header -->
            <header class="profile-header">
                <div>
                    <p class="profile-kicker">Kayise IT account</p>
                    <h1 class="profile-title">Welcome back, {{ $user->name }}.</h1>
                    <p class="profile-subtitle">
                        Track your internships, TVET placements and short programme applications in one place.
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

            {{-- Personal info completion banner --}}
            @if(!$personalInfoComplete)
                <div id="pi-completion-banner" class="mx-6 mt-4 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-amber-800">Complete your personal information to unlock all features.</p>
                        <p class="text-xs text-amber-700 mt-0.5">Fill in your contact number, ID number, age, address and province in the <strong>Personal info</strong> tab below. Other tabs will become available once you save.</p>
                    </div>
                </div>
            @endif

            <div class="profile-layout-grid">
                <!-- Left column: overview -->
                <aside class="profile-sidebar-card">
                    <div class="profile-sidebar-section">
                        <h2 class="profile-sidebar-title">My overview</h2>
                        <p class="profile-sidebar-copy">
                            Manage your programme applications and documents from this workspace.
                        </p>
                        <dl class="profile-metrics">
                            <div class="profile-metric">
                                <dt>Programme applications</dt>
                                <dd>{{ $applicationsCount }}</dd>
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
                        @php $locked = !$personalInfoComplete; $lockAttr = $locked ? 'disabled data-locked="1" title="Complete your personal information first"' : ''; @endphp
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="applications" {!! $lockAttr !!}>
                            Applications
                        </button>
                        <button type="button" class="profile-tab" data-tab="personal-info">
                            Personal info @if($locked) <span class="ml-1 text-amber-500">&#9888;</span> @endif
                        </button>
                        @if($hasProgramRegistration)
                            <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="documents" {!! $lockAttr !!}>
                                Supporting documents
                            </button>
                        @endif
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="career" {!! $lockAttr !!}>
                            Career path
                        </button>
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="resources" {!! $lockAttr !!}>
                            Resources
                        </button>
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="portfolio" {!! $lockAttr !!}>
                            Portfolio
                        </button>
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="progress" {!! $lockAttr !!}>
                            Progress
                        </button>
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="notifications" {!! $lockAttr !!}>
                            Notifications
                        </button>
                        <button type="button" class="profile-tab{{ $locked ? ' opacity-40 cursor-not-allowed' : '' }}" data-tab="settings" {!! $lockAttr !!}>
                            Settings
                        </button>
                    </div>

                    <section id="tab-applications" class="profile-panel is-active" data-tab-panel="applications" role="tabpanel">

                        {{-- List view (default) --}}
                        <div id="apps-list-view">
                            <header class="profile-panel-header">
                                <div>
                                    <h2 class="profile-panel-title">Programme applications</h2>
                                    <p class="profile-panel-subtitle">
                                        View the status of your internship, TVET placement and short programme applications.
                                    </p>
                                </div>
                                <button type="button" onclick="showApplyForm()" class="btn-primary">
                                    Apply for a programme
                                </button>
                            </header>
                            <div id="apps-list-content">
                                @include('profile.partials.application')
                            </div>
                        </div>

                        {{-- Inline apply form (hidden by default) --}}
                        <div id="apps-apply-view" style="display:none;">
                            @include('profile.partials.apply-inline', ['activePrograms' => $activePrograms ?? collect()])
                        </div>

                    </section>

                    <section id="tab-personal-info" class="profile-panel" data-tab-panel="personal-info" role="tabpanel" hidden>
                        <header class="profile-panel-header">
                            <div>
                                <h2 class="profile-panel-title">Personal information</h2>
                                <p class="profile-panel-subtitle">
                                    Store your contact and identity details. This information is pre-filled when you apply for a programme.
                                </p>
                            </div>
                        </header>
                        @include('profile.partials.personal-info')
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
        <script>
        function viewApplicationDetail(id) {
            var row = document.getElementById('detail-' + id);
            if (row) row.classList.toggle('hidden');
        }
        function confirmDeleteApplication(id, appId) {
            if (confirm('Delete application ' + appId + '? This cannot be undone.')) {
                var form = document.getElementById('delete-application-' + id);
                if (form) form.submit();
            }
        }
        function showApplyForm() {
            var listView  = document.getElementById('apps-list-view');
            var applyView = document.getElementById('apps-apply-view');
            if (listView)  listView.style.display  = 'none';
            if (applyView) applyView.style.display = 'block';
            if (typeof iaResetForm === 'function') iaResetForm();
        }
        function hideApplyForm() {
            var listView  = document.getElementById('apps-list-view');
            var applyView = document.getElementById('apps-apply-view');
            if (listView)  listView.style.display  = 'block';
            if (applyView) applyView.style.display = 'none';
        }
        function switchToPersonalInfo() {
            hideApplyForm();
            var btn = document.querySelector('[data-tab="personal-info"]');
            if (btn) btn.click();
        }
        </script>

    @if(config('services.google_maps.api_key'))
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=__initGoogleAddressPI"
            async defer>
        </script>
    @endif
    @endpush
</x-app-layout>