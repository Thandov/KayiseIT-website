@php
    use App\Support\ProgramFormFields;

    $selected = old(
        'form_fields',
        $program?->application_form_schema ?? ProgramFormFields::defaultFieldKeys(
            old('program_type', $program?->program_type ?? 'Internship'),
            (bool) old('allows_enquiry', $program?->allows_enquiry ?? false)
        )
    );
    $definitions = ProgramFormFields::definitions();
    $sections = ProgramFormFields::sectionLabels();
    $grouped = [];

    foreach ($definitions as $key => $definition) {
        $section = $definition['section'];
        $grouped[$section][] = ['key' => $key, 'definition' => $definition];
    }
@endphp

<div class="rounded-lg border border-indigo-200 bg-indigo-50 p-2">
    <p class="text-sm font-semibold text-indigo-900 mb-1 flex items-center gap-2">
        <i class="fas fa-list-check text-indigo-600"></i>
        Applicant form fields
    </p>
    <p class="text-[11px] text-indigo-800/80 mb-2">
        Choose which inputs appear on the public form for this programme. Defaults follow programme type and enquiry mode.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
        @foreach($sections as $sectionKey => $sectionLabel)
            @if(empty($grouped[$sectionKey]))
                @continue
            @endif
            <div class="rounded-md border border-indigo-100 bg-white p-2">
                <p class="text-xs font-semibold text-gray-800 mb-2">{{ $sectionLabel }}</p>
                <div class="flex flex-col gap-1 max-h-40 overflow-y-auto pr-1">
                    @foreach($grouped[$sectionKey] as $item)
                        @php
                            $key = $item['key'];
                            $definition = $item['definition'];
                            $typeLabel = match ($definition['type']) {
                                'textarea' => 'textarea',
                                'file' => 'file upload',
                                'select' => 'dropdown',
                                'number' => 'number',
                                'email' => 'email',
                                default => 'text',
                            };
                        @endphp
                        <label class="flex items-start gap-2 text-xs text-gray-700 cursor-pointer">
                            <input type="checkbox"
                                   name="form_fields[]"
                                   value="{{ $key }}"
                                   {{ in_array($key, $selected, true) ? 'checked' : '' }}
                                   class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span>
                                <span class="font-medium">{{ $definition['label'] }}</span>
                                <span class="text-gray-400">({{ $typeLabel }})</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    @if ($errors->has('form_fields') || $errors->has('form_fields.*'))
        <p class="text-red-500 text-[11px] mt-2">
            {{ $errors->first('form_fields') ?: $errors->first('form_fields.*') }}
        </p>
    @endif
</div>
