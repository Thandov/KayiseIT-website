@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Announcement')

@section('content')
    <div class="p-6">
        <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Announcement Details</h2>
                    <p class="mt-1 text-sm text-gray-600">View announcement information.</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.dashboard.announcements.edit', $announcement->id) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Edit
                    </a>
                    <a href="{{ route('admin.dashboard.announcements.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Back
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Image -->
                @if($announcement->image)
                <div class="mb-6">
                    <img src="{{ asset($announcement->image) }}" 
                         alt="{{ $announcement->title }}" 
                         class="w-full h-64 object-cover rounded-lg border border-gray-300">
                </div>
                @endif

                <!-- Badge -->
                @if($announcement->badge)
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                          style="background: #16A34A; border: 1px solid #16A34A; color: #fff;">
                        {{ $announcement->badge }}
                    </span>
                </div>
                @endif

                <!-- Date -->
                @if($announcement->created_at)
                <div class="mb-4">
                    <p class="text-sm text-gray-500">Created: {{ $announcement->created_at->format('F d, Y \a\t g:i A') }}</p>
                    @if($announcement->updated_at != $announcement->created_at)
                        <p class="text-sm text-gray-500">Updated: {{ $announcement->updated_at->format('F d, Y \a\t g:i A') }}</p>
                    @endif
                </div>
                @endif

                <!-- Title -->
                <div class="mb-6">
                    <h3 class="text-3xl font-bold text-gray-900">{{ $announcement->title }}</h3>
                </div>

                <!-- Description -->
                @if($announcement->description)
                <div class="mb-6">
                    <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $announcement->description }}</p>
                </div>
                @endif

                <!-- Link -->
                @if($announcement->link)
                <div class="mb-6">
                    <a href="{{ $announcement->link }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <span>Visit Link</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection

