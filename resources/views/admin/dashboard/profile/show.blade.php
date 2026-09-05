@extends('admin.dashboard.layout')

@section('page-title', 'My Profile')

@section('content')
<div class="ki-page">
    <div class="ki-toolbar ki-panel">
        <div class="ki-toolbar-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 m-0">My profile</h1>
                <p class="mt-2 text-sm text-gray-600 m-0">Update your contact details and photo. Job title and permissions are managed by an admin.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="ki-panel bg-green-50 border border-green-200 text-green-800 text-sm" role="status">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="ki-panel bg-red-50 border border-red-200 text-red-800 text-sm" role="alert">{{ $errors->first() }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="ki-panel lg:col-span-2">
            <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="ki-stack">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-4">
                    @if($employee->photo_url)
                        <img src="{{ $employee->photo_url }}" alt="{{ $employee->full_name }}" class="h-20 w-20 rounded-full object-cover border border-gray-200">
                    @else
                        <div class="h-20 w-20 rounded-full bg-kb-50 flex items-center justify-center text-kb-100 font-semibold border border-gray-200">
                            {{ $employee->initials }}
                        </div>
                    @endif
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile photo</label>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/gif,image/webp"
                               class="mt-1 block w-full text-sm text-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First name</label>
                        <input type="text" value="{{ $employee->first_name }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last name</label>
                        <input type="text" value="{{ $employee->last_name }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Work email</label>
                        <input type="email" value="{{ $employee->email }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 sm:text-sm">
                    </div>
                    <div>
                        <label for="personal_email" class="block text-sm font-medium text-gray-700">Personal email</label>
                        <input type="email" name="personal_email" id="personal_email" value="{{ old('personal_email', $employee->personal_email) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                        <input type="text" name="phone" id="phone" required value="{{ old('phone', $employee->phone) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                    </div>
                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
                        <x-province-selected :client="(object)['province' => old('province', $employee->province)]" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                        <input type="text" name="address" id="address" required value="{{ old('address', $employee->address) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-kb-100 text-white text-sm font-semibold rounded-md hover:bg-kb-200">
                        Save profile
                    </button>
                </div>
            </form>
        </div>

        <div class="ki-stack">
            <div class="ki-panel">
                <h2 class="text-base font-semibold text-gray-900 m-0">Job title</h2>
                <p class="mt-2 text-sm text-gray-700">{{ $employee->assignedTitle?->name ?: ($employee->job_title ?: 'Not assigned') }}</p>
                @if($employee->assignedTitle?->permissionGroups?->isNotEmpty())
                    <p class="mt-2 text-xs text-gray-500">Permission groups: {{ $employee->assignedTitle->groupLabels() }}</p>
                @endif
            </div>
            <div class="ki-panel">
                <h2 class="text-base font-semibold text-gray-900 m-0">Your permissions</h2>
                @php
                    $perms = $employee->assignedTitle?->permissionGroups
                        ?->flatMap(fn ($g) => $g->permissions)
                        ->unique('id')
                        ->values() ?? collect();
                @endphp
                @if($perms->isEmpty())
                    <p class="mt-2 text-sm text-gray-500">No title-based permissions yet.</p>
                @else
                    <ul class="mt-3 flex flex-col gap-2 text-sm text-gray-700">
                        @foreach($perms as $perm)
                            <li>{{ $perm->display_name ?: $perm->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
