@extends('admin.dashboard.layout')

@section('page-title', 'View Partner')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Partner Details</h2>
                    <p class="text-sm text-gray-600">View partner information</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('dashboard.partners.edit', $partner->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <a href="{{ route('dashboard.partners') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Partner Name</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $partner->name }}</p>
                    </div>

                    @if($partner->website_url)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                        <a href="{{ $partner->website_url }}" 
                           target="_blank" 
                           class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                            {{ $partner->website_url }}
                            <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                        </a>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                        <p class="text-gray-900">{{ $partner->display_order }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        @if($partner->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-times-circle mr-1"></i>Inactive
                            </span>
                        @endif
                    </div>

                    @if($partner->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $partner->description }}</p>
                    </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Partner Logo</label>
                    @if($partner->logo_path)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-center" style="min-height: 200px;">
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-h-48 max-w-full object-contain">
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-center" style="min-height: 200px;">
                            <div class="text-gray-400 text-center">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <p class="text-sm">No logo uploaded</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- MOU Section -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Memorandum of Understanding
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">MOU Status</label>
                        @if($partner->mou_signed)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                MOU Signed
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                No MOU
                            </span>
                        @endif
                    </div>
                    @if($partner->mou_signed)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date Signed</label>
                        <p class="text-gray-900">{{ $partner->mou_date ? $partner->mou_date->format('d F Y') : '—' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">MOU Document</label>
                        @if($partner->mou_document)
                            <a href="{{ asset($partner->mou_document) }}" target="_blank"
                               class="inline-flex items-center gap-1 text-sm text-green-700 underline hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download MOU PDF
                            </a>
                        @else
                            <p class="text-gray-400 text-sm">No document uploaded</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Created: {{ $partner->created_at->format('M d, Y H:i') }}</span>
                    <span>Last Updated: {{ $partner->updated_at->format('M d, Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
