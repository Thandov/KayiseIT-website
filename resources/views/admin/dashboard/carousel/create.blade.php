@extends('admin.dashboard.layout')

@section('page-title', 'Create New Carousel')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Create New Carousel</h2>
                <p class="text-sm text-gray-600">Add a new carousel slide to your homepage</p>
            </div>

            <!-- Create Form Content -->
            <div class="mt-6">
                @include('admin.dashboard.carousel.newcarousel')
            </div>
        </div>
    </div>
@endsection







