@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Edit Case Study')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Edit case study</h2>
                <p class="mt-1 text-sm text-gray-600">Pick a type first — the form fields change to match that kind of work.</p>
            </div>

            <form action="{{ route('dashboard.case-studies.update', $caseStudy->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                @include('admin.dashboard.case-studies._form', ['caseStudy' => $caseStudy])
                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('dashboard.case-studies.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Update case study</button>
                </div>
            </form>
        </div>
    </div>
@endsection
