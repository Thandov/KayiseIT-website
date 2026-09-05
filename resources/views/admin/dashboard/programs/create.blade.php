@extends('admin.dashboard.layout')

@section('page-title', 'Add New Program')

@section('content')
    <form action="{{ route('dashboard.programs.store') }}" method="POST"
          class="flex flex-col h-[calc(100vh-4rem)] overflow-hidden bg-slate-50">
        @csrf

        <div class="shrink-0 flex items-center justify-between gap-2 px-3 py-2 bg-white border-b border-gray-200">
            <a href="{{ route('dashboard.programs') }}" class="inline-flex items-center gap-2 text-sm text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left text-xs"></i> Programs
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard.programs') }}"
                   class="px-3 py-2 text-sm border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-3 py-2 text-sm bg-kb-100 text-white rounded hover:bg-kb-600">
                    Create Program
                </button>
            </div>
        </div>

        <div class="flex-1 min-h-0 overflow-y-auto px-3 py-2">
            <div class="bg-white rounded-lg border border-gray-200 p-2">
                @include('admin.dashboard.programs._form-fields', ['program' => null])
            </div>
        </div>
    </form>
@endsection
