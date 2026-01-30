@extends('admin.dashboard.layout')

@section('page-title', 'View Client')

@section('content')
    <div class="p-6">
        <div class="mb-4">
            <a href="{{ route('dashboard.clients') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Clients
            </a>
        </div>
        <x-client-form :client="$client"/>
    </div>
@endsection