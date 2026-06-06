@extends('admin.dashboard.layout')

@section('content')
<div class="p-6">
    @include('admin.dashboard.careermapping._tabs', ['active' => 'modules'])

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-900">Training Modules</h3>
        <a href="{{ route('dashboard.modules.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-md hover:bg-indigo-700">
            Add Module
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Accreditation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Register</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($modules as $module)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $module->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $module->accreditation_body }} — {{ $module->accreditation_status }}
                            @if ($module->accreditation_number)
                                <span class="block text-xs text-gray-400">{{ $module->accreditation_number }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($module->isRegisterable())
                                <span class="text-green-600 font-semibold">Open</span>
                            @else
                                <span class="text-gray-400">Closed</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <a href="{{ route('dashboard.modules.edit', $module) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('dashboard.modules.destroy', $module) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this module?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No modules yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $modules->links() }}</div>
</div>
@endsection
