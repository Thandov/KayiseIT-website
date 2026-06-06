@extends('admin.dashboard.layout')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <a href="{{ url()->previous() }}" class="text-sm text-indigo-600 hover:text-indigo-800">← Back</a>
    <h3 class="text-2xl font-bold text-gray-900 mt-4 mb-6">Edit Career Step</h3>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/dashboard/career_mapping/careersteps/editcareerstep') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        <input type="hidden" name="steps_id" value="{{ $careerstep->steps_id }}">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Step number</label>
                <input type="number" name="step_number" value="{{ old('step_number', $careerstep->step_number) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">NQF level</label>
                <input type="number" name="nqf_level" min="1" max="10" value="{{ old('nqf_level', $careerstep->nqf_level) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Title (display)</label>
            <input type="text" name="title" value="{{ old('title', $careerstep->title) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Qualification (legacy label)</label>
            <input type="text" name="qualification" value="{{ old('qualification', $careerstep->qualification) }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Summary</label>
            <textarea name="summary" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('summary', $careerstep->summary) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Duration</label>
                <input type="text" name="duration" value="{{ old('duration', $careerstep->duration) }}"
                       placeholder="2-3 years"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Typical cost</label>
                <input type="text" name="typical_cost" value="{{ old('typical_cost', $careerstep->typical_cost) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Next action</label>
            <input type="text" name="next_action" value="{{ old('next_action', $careerstep->next_action) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Linked modules (Register now gate)</label>
            <p class="text-xs text-gray-500 mb-2">Only accredited QCTO / MICT modules with registration open show "Register now" on the public site.</p>
            <div class="space-y-2 max-h-48 overflow-y-auto border rounded-md p-3">
                @foreach ($modules as $module)
                    <label class="flex items-start gap-2 text-sm">
                        <input type="checkbox" name="module_ids[]" value="{{ $module->id }}"
                               @checked($careerstep->modules->contains('id', $module->id))>
                        <span>
                            <strong>{{ $module->title }}</strong>
                            <span class="block text-xs text-gray-500">{{ $module->accreditation_body }} — {{ $module->accreditation_status }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">
            Save changes
        </button>
    </form>
</div>
@endsection
