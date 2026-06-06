@extends('admin.dashboard.layout')

@section('content')
@php
    $isEdit = $module->exists;
@endphp
<div class="p-6 max-w-2xl">
    <a href="{{ route('dashboard.modules.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">← Back to modules</a>
    <h3 class="text-2xl font-bold text-gray-900 mt-4 mb-6">{{ $isEdit ? 'Edit' : 'Add' }} Module</h3>

    <form method="POST"
          action="{{ $isEdit ? route('dashboard.modules.update', $module) : route('dashboard.modules.store') }}"
          class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $module->title) }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">NQF Level</label>
                <input type="number" name="nqf_level" min="1" max="10" value="{{ old('nqf_level', $module->nqf_level) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Duration (months)</label>
                <input type="number" name="duration_months" min="1" value="{{ old('duration_months', $module->duration_months) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $module->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Registration URL</label>
            <input type="text" name="registration_url" value="{{ old('registration_url', $module->registration_url) }}"
                   placeholder="/contact"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Accreditation body</label>
                <select name="accreditation_body" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach (['NONE', 'QCTO', 'MICT_SETA'] as $body)
                        <option value="{{ $body }}" @selected(old('accreditation_body', $module->accreditation_body) === $body)>{{ $body }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="accreditation_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach (['not_accredited', 'pending', 'accredited'] as $status)
                        <option value="{{ $status }}" @selected(old('accreditation_status', $module->accreditation_status) === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Accreditation number</label>
            <input type="text" name="accreditation_number" value="{{ old('accreditation_number', $module->accreditation_number) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Accreditation expires</label>
            <input type="date" name="accreditation_expires_at"
                   value="{{ old('accreditation_expires_at', $module->accreditation_expires_at?->format('Y-m-d')) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_registration_open" value="1"
                   @checked(old('is_registration_open', $module->is_registration_open))>
            <span class="text-sm text-gray-700">Registration open (shows Register now when accredited)</span>
        </label>

        <button type="submit" class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">
            {{ $isEdit ? 'Update' : 'Create' }} Module
        </button>
    </form>
</div>
@endsection
