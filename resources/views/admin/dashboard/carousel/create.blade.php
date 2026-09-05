@extends('admin.dashboard.layout')

@section('page-title', 'New slide')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">New homepage slide</h2>
            <p class="text-sm text-gray-600">Pick a template, then add photography and a destination. Campaign is for work that should not be forced into the classic overlay.</p>
        </div>

        @include('admin.dashboard.carousel._carousel_form')
    </div>
@endsection
