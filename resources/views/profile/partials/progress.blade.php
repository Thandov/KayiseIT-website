@php
    $user        = $user ?? Auth::user();
    $hasApp      = isset($applications) && $applications->count() > 0;
@endphp

<div class="space-y-6">
    {{-- Timeline with real milestones ──────────────────────────────── --}}
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <h4 class="text-lg font-semibold text-gray-900 mb-4">Your Timeline</h4>
        <div class="space-y-4">

            {{-- Always real: account created --}}
            <div class="flex items-center">
                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">✓</span>
                </div>
                <div class="ml-4">
                    <p class="font-medium text-gray-900">Profile Created</p>
                    <p class="text-sm text-gray-500">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>

            {{-- Application: only if they have one --}}
            @if($hasApp)
            <div class="flex items-center">
                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">✓</span>
                </div>
                <div class="ml-4">
                    <p class="font-medium text-gray-900">First Application Submitted</p>
                    <p class="text-sm text-gray-500">{{ $applications->sortBy('created_at')->first()->created_at->format('d F Y') }}</p>
                </div>
            </div>
            @else
            <div class="flex items-center opacity-50">
                <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-600 text-sm">○</span>
                </div>
                <div class="ml-4">
                    <p class="font-medium text-gray-500">Submit an Application</p>
                    <p class="text-sm text-gray-400">Not yet</p>
                </div>
            </div>
            @endif

            {{-- Future milestones (placeholder) --}}
            <div class="flex items-center opacity-40">
                <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-600 text-sm">○</span>
                </div>
                <div class="ml-4">
                    <p class="font-medium text-gray-500">Programme Placement</p>
                    <p class="text-sm text-gray-400">Upcoming</p>
                </div>
            </div>

            <div class="flex items-center opacity-40">
                <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-600 text-sm">○</span>
                </div>
                <div class="ml-4">
                    <p class="font-medium text-gray-500">Certification Completion</p>
                    <p class="text-sm text-gray-400">Upcoming</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Learning analytics coming soon ─────────────────────────────── --}}
    <div class="bg-white rounded-lg p-8 border border-gray-200 text-center">
        <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <h4 class="text-sm font-semibold text-gray-800 mb-1">Learning analytics coming soon</h4>
        <p class="text-xs text-gray-500">Study hours, course completion rates and achievement badges will appear here once you are active in a programme.</p>
    </div>
</div>

