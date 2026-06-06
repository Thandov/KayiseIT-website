@props(['step'])

@php
    $module = $step->modules?->first(fn ($m) => $m->isRegisterable());
@endphp

<div class="mt-4">
    @if ($module)
        <a href="{{ str_starts_with($module->registration_url, 'http') ? $module->registration_url : url($module->registration_url) }}"
           class="inline-flex items-center justify-center min-h-[44px] w-full sm:w-auto bg-kg-700 text-white font-semibold rounded-xl px-6 py-3 shadow-md hover:shadow-lg hover:bg-kg-600 transition">
            Register now — {{ $module->title }}
        </a>
        <p class="text-xs text-gray-500 mt-2">
            Accredited by {{ str_replace('_', ' ', $module->accreditation_body) }}
            @if ($module->accreditation_number)
                ({{ $module->accreditation_number }})
            @endif
        </p>
    @else
        <a href="{{ route('contact') }}"
           class="inline-flex items-center justify-center min-h-[44px] w-full sm:w-auto border-2 border-kb-100 text-kb-100 font-semibold rounded-xl px-6 py-3 hover:bg-kb-50 transition">
            Get notified when Kayise IT offers this
        </a>
    @endif
</div>
