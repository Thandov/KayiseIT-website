@php
    $p = $program ?? null;
    $inputClass = 'w-full rounded border-gray-300 text-sm py-2 px-2 shadow-sm focus:border-kb-500 focus:ring-kb-500';
    $labelClass = 'block text-xs font-medium text-gray-600 mb-1';
    $fieldClass = 'min-w-0';
@endphp

<div class="flex flex-col gap-2">
{{-- Announcement & enquire — shown first so it is never missed --}}
<div class="rounded-lg border border-emerald-300 bg-emerald-50 p-2">
    <p class="text-sm font-semibold text-emerald-900 mb-2 flex items-center gap-2">
        <i class="fas fa-bullhorn text-emerald-600"></i>
        Announcement &amp; visibility
    </p>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        @include('admin.dashboard.programs._enquire-toggle', ['program' => $p])
        @include('admin.dashboard.programs._announcement-toggle', ['program' => $p])
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-x-3 gap-y-2">
    <div class="{{ $fieldClass }} col-span-2 lg:col-span-2">
        <label class="{{ $labelClass }}">Program Name *</label>
        <input type="text" name="name" value="{{ old('name', $p?->name) }}" required class="{{ $inputClass }}">
        @error('name') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Type *</label>
        <select name="program_type" required class="{{ $inputClass }}">
            <option value="">Select</option>
            @foreach(['Internship', 'TVET Placement', 'Short Program'] as $type)
                <option value="{{ $type }}" {{ old('program_type', $p?->program_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
        @error('program_type') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }} col-span-2 lg:col-span-2">
        <label class="{{ $labelClass }}">Partner</label>
        <select name="partner_id" class="{{ $inputClass }}">
            <option value="">No partner</option>
            @foreach($partners as $partner)
                <option value="{{ $partner->id }}" {{ old('partner_id', $p?->partner_id) == $partner->id ? 'selected' : '' }}>
                    {{ $partner->name }}@if($partner->partner_type) ({{ $partner->partner_type }})@endif
                </option>
            @endforeach
        </select>
        @if($partners->isEmpty())
            <p class="text-[11px] text-amber-600 mt-1">
                No partners yet.
                <a href="{{ route('dashboard.partners.create') }}" class="underline">Add one</a>
            </p>
        @elseif($partners->contains(fn ($partner) => stripos($partner->name, 'MICT') !== false))
            <p class="text-[11px] text-gray-400 mt-1">MICT SETA uses the MICT beneficiaries table.</p>
        @endif
        @error('partner_id') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Duration *</label>
        <input type="text" name="duration" value="{{ old('duration', $p?->duration) }}" placeholder="12 months" required class="{{ $inputClass }}">
        @error('duration') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Needed *</label>
        <input type="number" name="number_needed" value="{{ old('number_needed', $p?->number_needed) }}" min="1" required class="{{ $inputClass }}">
        @error('number_needed') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Recruit start *</label>
        <input type="date" name="recruitment_start_date"
               value="{{ old('recruitment_start_date', $p?->recruitment_start_date?->format('Y-m-d')) }}" required class="{{ $inputClass }}">
        @error('recruitment_start_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Recruit end *</label>
        <input type="date" name="recruitment_end_date"
               value="{{ old('recruitment_end_date', $p?->recruitment_end_date?->format('Y-m-d')) }}" required class="{{ $inputClass }}">
        @error('recruitment_end_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }} col-span-2 lg:col-span-3">
        <label class="{{ $labelClass }}">Description *</label>
        <textarea name="description" rows="2" required class="{{ $inputClass }} resize-none">{{ old('description', $p?->description) }}</textarea>
        @error('description') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }} col-span-2 lg:col-span-3">
        <label class="{{ $labelClass }}">Requirements *</label>
        <textarea name="requirements" rows="2" required class="{{ $inputClass }} resize-none">{{ old('requirements', $p?->requirements) }}</textarea>
        @error('requirements') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="{{ $fieldClass }} flex items-end">
        <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
            <input type="checkbox" name="has_stipend" value="1" {{ old('has_stipend', $p?->has_stipend) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
            Stipend
        </label>
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Amount</label>
        <input type="number" name="stipend_amount" value="{{ old('stipend_amount', $p?->stipend_amount) }}" step="0.01" min="0" class="{{ $inputClass }}">
    </div>

    <div class="{{ $fieldClass }}">
        <label class="{{ $labelClass }}">Currency</label>
        <select name="stipend_currency" class="{{ $inputClass }}">
            <option value="ZAR" {{ old('stipend_currency', $p?->stipend_currency ?? 'ZAR') == 'ZAR' ? 'selected' : '' }}>ZAR</option>
            <option value="USD" {{ old('stipend_currency', $p?->stipend_currency) == 'USD' ? 'selected' : '' }}>USD</option>
        </select>
    </div>

    <div class="{{ $fieldClass }} flex items-end">
        <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
            <input type="checkbox" name="has_accreditation" value="1" {{ old('has_accreditation', $p?->has_accreditation) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
            Accredited
        </label>
    </div>

    <div class="{{ $fieldClass }} col-span-2">
        <label class="{{ $labelClass }}">Accreditation details</label>
        <input type="text" name="accreditation_details" value="{{ old('accreditation_details', $p?->accreditation_details) }}" class="{{ $inputClass }}">
    </div>

    <div class="{{ $fieldClass }} flex items-end">
        <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
            <input type="checkbox" name="youth_beneficiaries" value="1" {{ old('youth_beneficiaries', $p?->youth_beneficiaries) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
            Youth
        </label>
    </div>

    <div class="{{ $fieldClass }} flex items-end">
        @if(auth()->user()?->hasStaffPermission('programs.approve'))
            <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $p?->is_active ?? false) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                Active (public)
            </label>
        @else
            <p class="text-xs text-gray-500">Draft until a superadmin approves for public display.</p>
            <input type="hidden" name="is_active" value="0">
        @endif
    </div>
</div>

@include('admin.dashboard.programs._form-field-picker', ['program' => $p])
</div>
