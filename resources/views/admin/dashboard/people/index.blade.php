@extends('admin.dashboard.layout')

@section('page-title', 'People')

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

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">People</h1>
                <p class="mt-1 text-sm text-gray-600">Program enquiries and internship applications in one place</p>
            </div>
            <a href="{{ route('dashboard.people.create') }}"
               class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600">
                Register Enquiry
            </a>
        </div>

        <div class="mb-4 flex flex-wrap gap-2">
            <a href="{{ route('dashboard.people') }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ !request('type') ? 'bg-kg-100 text-kg-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </a>
            <a href="{{ route('dashboard.people', ['type' => 'enquiry']) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('type') === 'enquiry' ? 'bg-kg-100 text-kg-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Enquiries
            </a>
            <a href="{{ route('dashboard.people', ['type' => 'application']) }}"
               class="px-3 py-1.5 rounded-full text-sm font-medium {{ request('type') === 'application' ? 'bg-kg-100 text-kg-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Applications
            </a>
        </div>

        @if($people->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <p class="text-gray-500">No records found.</p>
                <a href="{{ route('dashboard.people.create') }}" class="mt-4 inline-block text-kb-600 hover:text-kb-800">Register the first enquiry</a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($people as $person)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $person->full_name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $person->id_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $person->isApplication() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $person->record_type_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $person->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $person->cellphone ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $person->program?->name ?? '—' }}
                                        @if($person->isApplication() && $person->field)
                                            <div class="text-xs text-gray-500">{{ $person->field }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($person->isApplication())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $person->status === 'accepted' ? 'bg-green-100 text-green-800' : ($person->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ $person->status_label ?? 'Pending' }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $person->source === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($person->source) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('dashboard.people.view', $person) }}" class="text-kb-600 hover:text-kb-900 mr-3">View</a>
                                        @if($person->isEnquiry())
                                            <a href="{{ route('dashboard.people.edit', $person) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        @endif
                                        <form action="{{ route('dashboard.people.delete', $person) }}" method="POST" class="inline" onsubmit="return confirm('Delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($people->hasPages())
                <div class="mt-4">{{ $people->links() }}</div>
            @endif
        @endif
    </div>
@endsection
