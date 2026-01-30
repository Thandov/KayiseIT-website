@extends('admin.dashboard.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $caseStudy->title }}</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        @if($caseStudy->client_name)Client: {{ $caseStudy->client_name }}@endif
                        @if($caseStudy->year) | Year: {{ $caseStudy->year }}@endif
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('dashboard.case-studies.edit', $caseStudy->id) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Edit
                    </a>
                    <a href="{{ route('dashboard.case-studies.index') }}" 
                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Back
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Featured Image -->
                @if($caseStudy->image)
                    <div class="mb-6">
                        <img src="{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}" class="w-full h-64 object-cover rounded-lg border border-gray-200">
                    </div>
                @endif

                <!-- Status Badges -->
                <div class="flex space-x-2">
                    @if($caseStudy->is_active)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Active</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Inactive</span>
                    @endif
                    @if($caseStudy->is_featured)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Featured</span>
                    @endif
                </div>

                <!-- The Problem -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center mr-2 bg-red-100">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xs"></i>
                        </span>
                        The Problem
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $caseStudy->problem }}</p>
                </div>

                <!-- Solution -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center mr-2 bg-green-100">
                            <i class="fas fa-lightbulb text-green-600 text-xs"></i>
                        </span>
                        How KAYISE IT Solved It
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $caseStudy->solution }}</p>
                </div>

                <!-- Results -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center mr-2 bg-blue-100">
                            <i class="fas fa-chart-line text-blue-600 text-xs"></i>
                        </span>
                        The Results
                    </h3>
                    @if($caseStudy->results)
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $caseStudy->results }}</p>
                    @endif
                    @if($caseStudy->results_list && count($caseStudy->results_list) > 0)
                        <ul class="space-y-2">
                            @foreach($caseStudy->results_list as $result)
                                <li class="flex items-start text-gray-700">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mt-2 mr-3 flex-shrink-0"></span>
                                    <span>{{ $result['text'] ?? '' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Metadata -->
                <div class="pt-4 border-t border-gray-200">
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Created:</span> {{ $caseStudy->created_at->format('M d, Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Updated:</span> {{ $caseStudy->updated_at->format('M d, Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Display Order:</span> {{ $caseStudy->order }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

