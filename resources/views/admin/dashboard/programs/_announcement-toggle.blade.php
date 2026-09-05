@php
    $announcement = $program?->announcement;
    $defaults = [
        'title' => old('announcement_title', $announcement?->title ?? ''),
        'description' => old('announcement_description', $announcement?->description ?? ''),
        'link' => old('announcement_link', $announcement?->link ?? route('programs')),
        'badge' => old('announcement_badge', $announcement?->badge ?? 'OPPORTUNITY'),
        'expires_at' => old(
            'announcement_expires_at',
            $announcement?->expires_at?->format('Y-m-d\TH:i')
                ?? ($program?->recruitment_end_date?->endOfDay()->format('Y-m-d\TH:i') ?? '')
        ),
    ];
    $showFields = old('create_announcement', $announcement && $announcement->is_active);
    $inputClass = 'w-full rounded border-gray-300 text-sm py-1.5 px-2 shadow-sm focus:border-kb-500 focus:ring-kb-500';
    $labelClass = 'block text-xs font-medium text-gray-600 mb-1';
@endphp

<div class="rounded border border-emerald-400 bg-white px-2 py-2 ring-1 ring-emerald-200"
     x-data="{
        enabled: @json((bool) $showFields),
        syncFromProgram() {
            if (!this.enabled) return;
            const name = document.querySelector('[name=name]')?.value?.trim();
            const description = document.querySelector('[name=description]')?.value?.trim();
            const endDate = document.querySelector('[name=recruitment_end_date]')?.value;
            const titleEl = document.getElementById('announcement_title');
            const descEl = document.getElementById('announcement_description');
            const expiresEl = document.getElementById('announcement_expires_at');
            if (titleEl && !titleEl.dataset.userEdited && name) titleEl.value = 'New programme: ' + name;
            if (descEl && !descEl.dataset.userEdited && description) descEl.value = description;
            if (expiresEl && !expiresEl.dataset.userEdited && endDate) expiresEl.value = endDate + 'T23:59';
        },
        markEdited(el) { el.dataset.userEdited = '1'; }
     }"
     x-init="
        syncFromProgram();
        ['name', 'description', 'recruitment_end_date'].forEach(field => {
            document.querySelector('[name=' + field + ']')?.addEventListener('input', () => syncFromProgram());
        });
     ">
    <div class="flex items-center justify-between gap-2">
        <label class="flex items-center gap-2 cursor-pointer min-w-0">
            <input type="checkbox" name="create_announcement" value="1"
                   x-model="enabled" @change="syncFromProgram()"
                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500 shrink-0">
            <span class="text-sm font-semibold text-emerald-800 truncate">Publish as announcement</span>
            <span class="text-[11px] text-emerald-700 hidden sm:inline truncate">— auto-creates on announcements page + homepage</span>
        </label>
        @if($announcement)
            <a href="{{ route('admin.dashboard.announcements.edit', $announcement->id) }}" target="_blank"
               class="text-[11px] text-kb-600 underline shrink-0">Edit linked</a>
        @endif
    </div>

    <div x-show="enabled" x-cloak class="mt-2 pt-2 border-t border-emerald-200/80 grid grid-cols-2 lg:grid-cols-4 gap-x-2 gap-y-2">
        <div class="col-span-2">
            <label for="announcement_title" class="{{ $labelClass }}">Title *</label>
            <input type="text" name="announcement_title" id="announcement_title"
                   value="{{ $defaults['title'] }}" @input="markEdited($event.target)" :required="enabled" :disabled="!enabled"
                   class="{{ $inputClass }}">
            @error('announcement_title') <p class="text-red-500 text-[11px]">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="announcement_badge" class="{{ $labelClass }}">Badge</label>
            <input type="text" name="announcement_badge" id="announcement_badge"
                   value="{{ $defaults['badge'] }}" maxlength="50" placeholder="OPPORTUNITY"
                   :disabled="!enabled" class="{{ $inputClass }}">
        </div>
        <div>
            <label for="announcement_expires_at" class="{{ $labelClass }}">Expires</label>
            <input type="datetime-local" name="announcement_expires_at" id="announcement_expires_at"
                   value="{{ $defaults['expires_at'] }}" @input="markEdited($event.target)"
                   :disabled="!enabled" class="{{ $inputClass }}">
        </div>
        <div class="col-span-2 lg:col-span-4">
            <label for="announcement_description" class="{{ $labelClass }}">Description *</label>
            <textarea name="announcement_description" id="announcement_description" rows="2"
                      @input="markEdited($event.target)" :required="enabled" :disabled="!enabled"
                      class="{{ $inputClass }} resize-none">{{ $defaults['description'] }}</textarea>
            @error('announcement_description') <p class="text-red-500 text-[11px]">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-2">
            <label for="announcement_link" class="{{ $labelClass }}">Link</label>
            <input type="url" name="announcement_link" id="announcement_link"
                   value="{{ $defaults['link'] }}" placeholder="{{ route('programs') }}"
                   :disabled="!enabled" class="{{ $inputClass }}">
        </div>
    </div>
</div>

<style>[x-cloak] { display: none !important; }</style>
