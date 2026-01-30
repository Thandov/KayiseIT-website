@extends('admin.dashboard.layout')

@section('page-title', 'Carousel Management')

@section('content')
    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Dashboard Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Carousel Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage carousel slides for the homepage</p>
                </div>
                <a href="{{ route('admin.dashboard.carousel.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Carousel
                </a>
            </div>
        </div>

        <!-- Carousel Content with Grid Layout -->
        @if(!$carousels->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @include('admin.dashboard.carousel._partial', ['carousels' => $carousels])
            </div>
        </div>
        
        <!-- Pagination -->
        @if($carousels->hasPages())
        <div class="mt-6 flex justify-center">
            <nav class="flex items-center space-x-1">
                @if($carousels->previousPageUrl())
                <a href="{{ $carousels->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                @foreach(range(1, $carousels->lastPage()) as $page)
                    @if($page == $carousels->currentPage())
                    <span class="px-3 py-2 text-sm font-medium text-white bg-kb-100 border border-kb-100 rounded transition-colors duration-200">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $carousels->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                @if($carousels->nextPageUrl())
                <a href="{{ $carousels->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @endif
            </nav>
        </div>
        @endif

        <!-- Summary stats -->
        @if($carousels->hasPages())
        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Total carousels: <strong>{{ $carousels->total() }}</strong></span>
                <span>Page {{ $carousels->currentPage() }} of {{ $carousels->lastPage() }}</span>
            </div>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12">
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                    <i class="fas fa-images text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No carousels found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first carousel slide.</p>
                <a href="{{ route('admin.dashboard.carousel.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    Add Carousel
                </a>
            </div>
        </div>
        @endif
    </div>
@endsection