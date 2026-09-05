@extends('admin.dashboard.layout')

@section('page-title', 'Access & Titles')

@section('content')
@php
    $moduleLabels = $moduleLabels ?? [];
    $tab = request('tab', 'groups');
    if (! in_array($tab, ['groups', 'titles'], true)) {
        $tab = 'groups';
    }

    $groupParam = request('group');
    $groupIds = $groups->pluck('id')->map(fn ($id) => (string) $id)->all();
    if ($groupParam === 'new') {
        $groupTab = 'new';
    } elseif ($groupParam && in_array((string) $groupParam, $groupIds, true)) {
        $groupTab = (string) $groupParam;
    } else {
        $groupTab = $groups->isNotEmpty() ? (string) $groups->first()->id : 'new';
    }
    $activeGroup = $groupTab !== 'new' ? $groups->firstWhere('id', (int) $groupTab) : null;
    if ($activeGroup) {
        $activeGroup->loadMissing('permissions');
    }
@endphp
<div class="ki-page">
    <div class="ki-toolbar ki-panel">
        <div class="ki-toolbar-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 m-0">Access &amp; titles</h1>
                <p class="mt-2 text-sm text-gray-600 m-0">Assign permissions to groups, then map groups to job titles. Staff inherit access from their title.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="ki-panel bg-green-50 border border-green-200 text-green-800 text-sm" role="status">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="ki-panel bg-red-50 border border-red-200 text-red-800 text-sm" role="alert">{{ $errors->first() }}</div>
    @endif

    <div class="ki-toolbar" role="tablist" aria-label="Access sections">
        <a href="{{ route('dashboard.access', ['tab' => 'groups']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md {{ $tab === 'groups' ? 'bg-kb-100 text-white' : 'bg-white border border-gray-300 text-gray-700' }}">
            Permission groups
        </a>
        <a href="{{ route('dashboard.access', ['tab' => 'titles']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md {{ $tab === 'titles' ? 'bg-kb-100 text-white' : 'bg-white border border-gray-300 text-gray-700' }}">
            Job titles
        </a>
    </div>

    @if($tab === 'groups')
        <div class="ki-stack">
            <div class="flex flex-wrap items-center gap-2 p-1 rounded-lg bg-slate-100" role="tablist" aria-label="Permission groups">
                <a href="{{ route('dashboard.access', ['tab' => 'groups', 'group' => 'new']) }}"
                   role="tab"
                   aria-selected="{{ $groupTab === 'new' ? 'true' : 'false' }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg {{ $groupTab === 'new' ? 'bg-white text-kb-100 border border-gray-200 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                    New group
                </a>
                @foreach($groups as $group)
                    <a href="{{ route('dashboard.access', ['tab' => 'groups', 'group' => $group->id]) }}"
                       role="tab"
                       aria-selected="{{ $groupTab === (string) $group->id ? 'true' : 'false' }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg {{ $groupTab === (string) $group->id ? 'bg-white text-kb-100 border border-gray-200 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                        {{ $group->display_name }}
                    </a>
                @endforeach
            </div>

            @if($groupTab === 'new')
                <div class="ki-panel" role="tabpanel">
                    <h2 class="text-lg font-semibold text-gray-900 m-0">Create group</h2>
                    <p class="mt-2 text-sm text-gray-600">Pick the permissions this group grants. Titles will use the group later.</p>
                    <form method="POST" action="{{ route('dashboard.access.groups.store') }}" class="mt-6 ki-stack">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="group_display_name">Name</label>
                                <input id="group_display_name" type="text" name="display_name" required value="{{ old('display_name') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="group_description">Description</label>
                                <input id="group_description" type="text" name="description" value="{{ old('description') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-3">Permissions</p>
                            @include('admin.dashboard.access._permission-grid', [
                                'permissions' => $permissions,
                                'moduleLabels' => $moduleLabels,
                                'selectedNames' => old('permissions', []),
                            ])
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-kb-100 text-white text-sm font-semibold rounded-md hover:bg-kb-200">
                                Create group
                            </button>
                        </div>
                    </form>
                </div>
            @elseif($activeGroup)
                <div class="ki-panel" role="tabpanel">
                    <form method="POST" action="{{ route('dashboard.access.groups.update', $activeGroup) }}" class="ki-stack">
                        @csrf
                        @method('PUT')
                        <div class="ki-toolbar">
                            <div class="ki-toolbar-start">
                                <h3 class="text-base font-semibold text-gray-900 m-0">{{ $activeGroup->display_name }}</h3>
                                <p class="text-xs text-gray-500 m-0">{{ $activeGroup->permissions_count }} permissions · {{ $activeGroup->job_titles_count }} titles</p>
                            </div>
                            <div class="ki-toolbar-end ki-table-actions">
                                <button type="submit" class="px-3 py-2 text-sm rounded-md bg-kb-100 text-white">Save</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="display_name" required value="{{ old('display_name', $activeGroup->display_name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <input type="text" name="description" value="{{ old('description', $activeGroup->description) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                            </div>
                        </div>
                        @include('admin.dashboard.access._permission-grid', [
                            'permissions' => $permissions,
                            'moduleLabels' => $moduleLabels,
                            'selectedNames' => $activeGroup->permissions->pluck('name'),
                        ])
                    </form>
                    <form method="POST" action="{{ route('dashboard.access.groups.destroy', $activeGroup) }}" class="mt-4"
                          onsubmit="return confirm('Delete this group? Titles will keep their name but lose the group link.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete group</button>
                    </form>
                </div>
            @endif
        </div>
    @else
        <div class="ki-stack">
            <div class="ki-panel">
                <h2 class="text-lg font-semibold text-gray-900 m-0">Create job title</h2>
                <p class="mt-2 text-sm text-gray-600">Assign one or more permission groups. Staff with this title inherit the combined permissions.</p>
                <form method="POST" action="{{ route('dashboard.access.titles.store') }}" class="mt-6 ki-stack">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="title_name">Title</label>
                            <input id="title_name" type="text" name="name" required value="{{ old('name') }}"
                                   class="ki-input mt-1"
                                   placeholder="e.g. Sales Consultant">
                        </div>
                        <div class="flex items-end gap-3">
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700 pb-2">
                                <input type="checkbox" name="is_active" value="1" checked>
                                Active
                            </label>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-kb-100 text-white text-sm font-semibold rounded-md hover:bg-kb-200">
                                Create title
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Permission groups</p>
                        <div class="ki-check-list">
                            @forelse($groups as $group)
                                <label>
                                    <input type="checkbox" name="permission_group_ids[]" value="{{ $group->id }}"
                                           @checked(collect(old('permission_group_ids', []))->contains($group->id))>
                                    <span>{{ $group->display_name }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-gray-500 m-0">Create a permission group first.</p>
                            @endforelse
                        </div>
                    </div>
                </form>
            </div>

            <div class="ki-stack">
                @forelse($titles as $title)
                    @php $selectedGroupIds = $title->permissionGroups->pluck('id')->all(); @endphp
                    <div class="ki-panel">
                        <form method="POST" action="{{ route('dashboard.access.titles.update', $title) }}" class="ki-stack">
                            @csrf
                            @method('PUT')
                            <div class="ki-toolbar">
                                <div class="ki-toolbar-start">
                                    <h3 class="text-base font-semibold text-gray-900 m-0">{{ $title->name }}</h3>
                                    <p class="text-xs text-gray-500 m-0">{{ $title->employees_count }} staff · {{ $title->groupLabels() ?: 'No groups' }}</p>
                                </div>
                                <div class="ki-toolbar-end ki-table-actions">
                                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                        <input type="checkbox" name="is_active" value="1" @checked($title->is_active)>
                                        Active
                                    </label>
                                    <button type="submit" class="px-3 py-2 text-sm rounded-md bg-kb-100 text-white">Save</button>
                                    <button type="submit" form="delete-title-{{ $title->id }}"
                                            class="px-3 py-2 text-sm rounded-md border border-red-200 text-red-600"
                                            onclick="return confirm('Delete this title?');">Delete</button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title name</label>
                                <input type="text" name="name" required value="{{ $title->name }}" class="ki-input mt-1">
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-2">Permission groups</p>
                                <div class="ki-check-list">
                                    @foreach($groups as $group)
                                        <label>
                                            <input type="checkbox" name="permission_group_ids[]" value="{{ $group->id }}"
                                                   @checked(in_array((int) $group->id, array_map('intval', $selectedGroupIds), true))>
                                            <span>{{ $group->display_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                        <form id="delete-title-{{ $title->id }}" method="POST" action="{{ route('dashboard.access.titles.destroy', $title) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @empty
                    <div class="ki-panel text-sm text-gray-500">No titles yet. Create one above.</div>
                @endforelse
            </div>
        </div>
    @endif
</div>
@endsection
