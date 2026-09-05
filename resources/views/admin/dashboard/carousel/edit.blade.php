@extends('admin.dashboard.layout')

@section('page-title', 'Edit slide')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Edit slide</h2>
            <p class="text-sm text-gray-600">Switch templates at any time. Existing classic slides stay classic until you choose another layout.</p>
        </div>

        @include('admin.dashboard.carousel._carousel_form', [
            'slides' => $carousel,
            'route' => 'admin.dashboard.carousel.update',
        ])
    </div>
@endsection
