@extends('admin.dashboard.layout')

@section('page-title', 'Partners Management')

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
                    <h1 class="text-3xl font-bold text-gray-900">Partners Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage your business partners and sponsors</p>
                </div>
                <a href="{{ route('dashboard.partners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Partner
                </a>
            </div>
        </div>

        <!-- Partners Content with Grid Layout -->
        @if(!$partners->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @include('admin.dashboard.partners._partial', ['partners' => $partners])
            </div>
        </div>
        
        <!-- Pagination -->
        @if($partners->hasPages())
        <div class="mt-6 flex justify-center">
            <nav class="flex items-center space-x-1">
                @if($partners->previousPageUrl())
                <a href="{{ $partners->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                @foreach(range(1, $partners->lastPage()) as $page)
                    @if($page == $partners->currentPage())
                    <span class="px-3 py-2 text-sm font-medium text-white bg-kb-100 border border-kb-100 rounded transition-colors duration-200">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $partners->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                @if($partners->nextPageUrl())
                <a href="{{ $partners->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @endif
            </nav>
        </div>
        @endif

        <!-- Summary stats -->
        @if($partners->hasPages())
        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Total partners: <strong>{{ $partners->total() }}</strong></span>
                <span>Page {{ $partners->currentPage() }} of {{ $partners->lastPage() }}</span>
            </div>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12">
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                    <i class="fas fa-handshake text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No partners found</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first partner.</p>
                <a href="{{ route('dashboard.partners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    Add Partner
                </a>
            </div>
        </div>
        @endif
    </div>
@endsection
