@extends('admin.dashboard.layout')

@section('page-title', $person->full_name)

@section('content')
    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('dashboard.people') }}" class="text-kb-600 hover:text-kb-800">&larr; Back to People</a>
            <div class="space-x-3">
                <a href="{{ route('dashboard.people.edit', $person) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">Edit</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $person->full_name }}</h2>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->id_number }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Cellphone</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->cellphone }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Country</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->country }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Province</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->province }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->location_name }} ({{ $person->location_type_label }})</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Program</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->program?->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Source</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($person->source) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Registered</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->created_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
