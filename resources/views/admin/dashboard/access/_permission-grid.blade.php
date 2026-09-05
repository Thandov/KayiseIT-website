@php
    $selectedNames = collect($selectedNames ?? []);
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach($permissions as $module => $perms)
        <div class="border border-gray-200 rounded-lg p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">{{ $moduleLabels[$module] ?? ucfirst(str_replace('-', ' ', $module)) }}</p>
            <div class="flex flex-col gap-2">
                @foreach($perms as $perm)
                    <label class="inline-flex items-center gap-2 text-sm text-gray-800">
                        <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                               @checked($selectedNames->contains($perm->name))>
                        <span>{{ $perm->display_name ?: $perm->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
