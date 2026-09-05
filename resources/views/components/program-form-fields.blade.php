@props([
    'program' => null,
    'groupedFields' => [],
    'prefix' => '',
    'values' => [],
    'inputClass' => 'block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 text-sm',
    'labelClass' => 'block text-sm font-medium text-gray-700 mb-1.5',
])

@foreach($groupedFields as $section)
    <div class="program-form-section mb-6">
        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">{{ $section['label'] }}</h3>
        <div class="grid sm:grid-cols-2 gap-5">
            @foreach($section['fields'] as $field)
                @php
                    $key = $field['key'];
                    $name = $prefix . $key;
                    $id = $prefix . $key;
                    $value = old($name, $values[$key] ?? '');
                    $isFile = ($field['type'] ?? '') === 'file';
                @endphp

                <div class="{{ in_array($field['type'], ['textarea', 'file'], true) ? 'sm:col-span-2' : '' }}">
                    <label for="{{ $id }}" class="{{ $labelClass }}">
                        {{ $field['label'] }}
                        @if(!$isFile)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    @if($field['type'] === 'textarea')
                        <textarea id="{{ $id }}" name="{{ $name }}" rows="3" required
                                  class="{{ $inputClass }}">{{ $value }}</textarea>
                    @elseif($field['type'] === 'select')
                        <select id="{{ $id }}" name="{{ $name }}" required class="{{ $inputClass }}">
                            @if($key === 'province')
                                <option value="">Select province</option>
                            @endif
                            @if($key === 'location_type')
                                <option value="">Town or township?</option>
                            @endif
                            @foreach($field['options'] ?? [] as $optionValue => $optionLabel)
                                @php
                                    $optVal = is_int($optionValue) ? $optionLabel : $optionValue;
                                    $optLab = is_int($optionValue) ? $optionLabel : $optionLabel;
                                @endphp
                                <option value="{{ $optVal }}" {{ (string) $value === (string) $optVal ? 'selected' : '' }}>
                                    {{ $optLab }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field['type'] === 'file')
                        <input type="file" id="{{ $id }}" name="{{ $name }}"
                               accept="{{ $field['accept'] ?? '.pdf' }}"
                               class="{{ $inputClass }}">
                        <p class="text-xs text-gray-400 mt-1">PDF only, max 2 MB.</p>
                    @elseif($field['type'] === 'number')
                        <input type="number" id="{{ $id }}" name="{{ $name }}"
                               value="{{ $value }}"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               required class="{{ $inputClass }}">
                    @else
                        <input type="{{ $field['type'] === 'email' ? 'email' : ($field['type'] === 'tel' ? 'tel' : 'text') }}"
                               id="{{ $id }}" name="{{ $name }}"
                               value="{{ $value }}"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               required class="{{ $inputClass }}">
                    @endif

                    @error($name)
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>
@endforeach
