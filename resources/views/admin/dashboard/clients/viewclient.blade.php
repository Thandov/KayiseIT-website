@extends('admin.dashboard.layout')

@section('page-title', 'View Client')

@section('content')
<div class="ki-page">
    <div class="ki-toolbar">
        <a href="{{ route('dashboard.clients') }}" class="text-sm font-medium text-kb-100 hover:text-kb-200">← Back to clients</a>
    </div>
    @if(session('success'))
        <div class="ki-panel bg-green-50 border border-green-200 text-green-800 text-sm" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="ki-panel bg-red-50 border border-red-200 text-red-800 text-sm" role="alert">{{ session('error') }}</div>
    @endif
    <x-client-form :client="$client"/>
</div>
@endsection
