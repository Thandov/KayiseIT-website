<div class="space-y-6">
    {{-- Recent Notifications ───────────────────────────────────────── --}}
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <h4 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h4>

        {{-- Application status changes ──────────────────────────────── --}}
        @php
            $recentChanges = isset($applications)
                ? $applications->filter(fn($a) => $a->responded_at !== null)->sortByDesc('responded_at')
                : collect();
        @endphp

        @if($recentChanges->isNotEmpty())
            <div class="space-y-3">
                @foreach($recentChanges as $app)
                <div class="border-l-4 {{ $app->status === 'accepted' ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50' }} p-4 rounded-r-lg">
                    <p class="font-medium text-gray-900">
                        Application {{ $app->app_id }}
                        <span class="{{ $app->status === 'accepted' ? 'text-green-700' : 'text-red-700' }} font-semibold">
                            {{ ucfirst($app->status) }}
                        </span>
                    </p>
                    @if($app->admin_message)
                        <p class="text-sm text-gray-600 mt-1">{{ $app->admin_message }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ $app->responded_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10 text-gray-400">
                <svg class="mx-auto mb-3 w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <p class="text-sm">No notifications yet.</p>
                <p class="text-xs mt-1 text-gray-400">We will notify you here when your application status changes.</p>
            </div>
        @endif
    </div>

    {{-- Notification preferences ───────────────────────────────────── --}}
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <h4 class="text-lg font-semibold text-gray-900 mb-1">Notification preferences</h4>
        <p class="text-sm text-gray-500 mb-5">All important updates are sent to your registered email address.</p>
        <div class="space-y-4">
            @foreach([
                ['label' => 'Application status updates', 'sub' => 'When your application is accepted or rejected'],
                ['label' => 'New programmes available',   'sub' => 'When new internship or learnership programmes open'],
                ['label' => 'Important announcements',    'sub' => 'Updates and news from KAYISE IT'],
            ] as $pref)
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-900 text-sm">{{ $pref['label'] }}</p>
                    <p class="text-xs text-gray-500">{{ $pref['sub'] }}</p>
                </div>
                <span class="text-xs text-gray-400 italic">via email</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
