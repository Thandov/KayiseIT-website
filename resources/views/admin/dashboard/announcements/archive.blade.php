@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Archived Announcements')

@section('content')
<div class="ki-page">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <div class="ki-cluster">
                <svg class="w-5 h-5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <div class="ki-cluster">
                <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="ki-panel">
        <div class="ki-toolbar">
            <div class="ki-toolbar-start">
                <div class="flex-shrink-0 bg-gray-100 rounded-md p-3">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-lg font-medium text-gray-900">Archived announcements</h3>
                    <p class="mt-1 text-sm text-gray-500">Expired announcements stored in JSON. Restore to put one back on the dashboard.</p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                <a href="{{ route('admin.dashboard.announcements.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to announcements
                </a>
            </div>
        </div>

        @if(count($archived) > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 items-stretch mt-6">
                @foreach($archived as $item)
                    @php
                        $originalId = (int) ($item['original_id'] ?? 0);
                        $expiresAt = !empty($item['expires_at']) ? \Carbon\Carbon::parse($item['expires_at']) : null;
                        $archivedAt = !empty($item['archived_at']) ? \Carbon\Carbon::parse($item['archived_at']) : null;
                    @endphp
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden h-full flex flex-col">
                        @if(!empty($item['image']))
                            <div class="relative h-48 overflow-hidden bg-[#f0f4ff]">
                                <img src="{{ asset($item['image']) }}"
                                     alt="{{ $item['title'] ?? 'Announcement' }}"
                                     class="w-full h-full object-cover">
                                @if(!empty($item['badge']))
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-green-600">
                                            {{ $item['badge'] }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="relative h-48 overflow-hidden bg-[#263a57]">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="mb-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    ARCHIVED
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mb-2">
                                @if($archivedAt)
                                    Archived: {{ $archivedAt->format('M d, Y g:i A') }}
                                @endif
                                @if($expiresAt)
                                    <br>Original expiry: {{ $expiresAt->format('M d, Y g:i A') }}
                                @endif
                            </p>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                {{ $item['title'] ?? 'Announcement' }}
                            </h3>
                            @if(!empty($item['description']))
                                <p class="text-gray-600 text-sm mb-4 flex-grow">
                                    {{ \Illuminate\Support\Str::limit($item['description'], 120) }}
                                </p>
                            @endif
                            <form action="{{ route('admin.dashboard.announcements.archive.restore', $originalId) }}" method="POST" class="mt-auto pt-4 border-t border-gray-200">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="return confirm('Restore this announcement to the dashboard? It will expire again in 30 days unless you edit the date.')">
                                    Restore
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <h3 class="text-lg font-medium text-gray-900 mb-2">No archived announcements</h3>
                <p class="text-gray-500 mb-6">Expired announcements will appear here after they are archived.</p>
                <a href="{{ route('admin.dashboard.announcements.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to announcements
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
