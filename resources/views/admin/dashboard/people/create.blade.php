@extends('admin.dashboard.layout')

@section('page-title', 'Register Person')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.people') }}" class="text-kb-600 hover:text-kb-800">&larr; Back to People</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Register Person</h2>

            <form action="{{ route('dashboard.people.store') }}" method="POST">
                @csrf
                @include('admin.dashboard.people._form', ['programs' => $programs])

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('dashboard.people') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-kb-100 text-white rounded-md hover:bg-kb-600">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
