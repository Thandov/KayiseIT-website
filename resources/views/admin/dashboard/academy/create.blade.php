@extends('admin.dashboard.layout')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-3xl">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Add Academy Course</h2>
                <p class="mt-1 text-sm text-gray-600">New courses appear on the public page when visibility is enabled.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.academy.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.dashboard.academy._form', ['course' => null])

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-kg-700 hover:bg-kg-600">
                        Save course
                    </button>
                    <a href="{{ route('dashboard.academy.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
