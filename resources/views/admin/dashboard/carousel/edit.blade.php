@extends('admin.dashboard.layout')

@section('page-title', 'Edit Carousel')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Carousel</h2>
                <p class="text-sm text-gray-600">Edit carousel slide details</p>
            </div>

            <!-- Edit Form Content -->
            <div class="mt-6">
                @include('admin.dashboard.carousel.editcarousel')
            </div>
        </div>
    </div>
@endsection







