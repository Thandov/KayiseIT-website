@extends('admin.dashboard.layout')

@section('page-title', 'Gallery Management')

@section('content')
    <div class="p-6">
        <!-- Gallery Header with Stats -->
        <div class="bg-kb-100 rounded-t-xl shadow-lg p-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Gallery Management</h1>
                    <p class="text-white text-opacity-90 text-lg">Organize and manage your image collections</p>
                </div>
                <div class="text-right">
                    <div class="bg-white bg-opacity-20 rounded-lg p-4">
                        <div class="text-2xl font-bold">
                            @if(isset($galleries))
                                {{ array_sum(array_map(function($g) { return count($g['photos']); }, $galleries)) }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="text-white text-opacity-90">Total Images</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Gallery Content -->
        <div class="bg-white shadow-xl rounded-b-xl border-l border-r border-b border-gray-200">
            @include('admin.dashboard.gallery')
        </div>
    </div>
@endsection
