@extends('admin.dashboard.layout')

@section('page-title', 'Gallery Management')

@section('content')
    <div class="ki-page">
        <div class="ki-page-hero bg-kb-100 text-white shadow-lg">
            <div class="min-w-0">
                <h1 class="text-3xl font-bold">Gallery Management</h1>
                <p class="text-white/90 mt-2">Organize and manage your image collections</p>
            </div>
            <div class="ki-page-hero-stat bg-white/20 text-right">
                <div class="text-2xl font-bold leading-none">
                    @if(isset($galleries))
                        {{ array_sum(array_map(function($g) { return count($g['photos']); }, $galleries)) }}
                    @else
                        0
                    @endif
                </div>
                <div class="text-sm text-white/90 mt-1">Total Images</div>
            </div>
        </div>

        @include('admin.dashboard.gallery')
    </div>
@endsection
