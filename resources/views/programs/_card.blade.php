@props(['program', 'mode' => 'enquire'])

<article class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 h-full flex flex-col">
    <div class="flex items-start justify-between gap-3 mb-3">
        <h3 class="text-lg font-semibold text-gray-900 leading-snug">{{ $program->name }}</h3>
        <span class="flex-shrink-0 px-2.5 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
            {{ $program->program_type }}
        </span>
    </div>

    <p class="text-sm text-gray-600 flex-grow {{ $mode === 'enquire' ? 'mb-5' : 'mb-4' }}">{{ $program->description }}</p>

    @if($mode === 'enquire')
        <p class="text-sm text-sky-800/90 bg-sky-50 border border-sky-100 rounded-xl px-4 py-3 mb-5">
            Register your interest and we&rsquo;ll keep you informed as this programme develops.
        </p>
    @else
        <dl class="space-y-1.5 text-xs text-gray-500 mb-5">
            <div class="flex justify-between gap-4">
                <dt>Duration</dt>
                <dd class="font-medium text-gray-700 text-right">{{ $program->duration }}</dd>
            </div>
            @if($program->recruitment_end_date)
                <div class="flex justify-between gap-4">
                    <dt>Closes</dt>
                    <dd class="font-medium text-gray-700 text-right">{{ $program->recruitment_end_date->format('d M Y') }}</dd>
                </div>
            @endif
            @if($program->number_needed)
                <div class="flex justify-between gap-4">
                    <dt>Places</dt>
                    <dd class="font-medium text-gray-700 text-right">{{ $program->number_needed }}</dd>
                </div>
            @endif
        </dl>
    @endif

    @if($mode === 'enquire')
        <a href="#register"
           onclick="document.getElementById('internship_program_id').value='{{ $program->id }}'"
           class="mt-auto inline-flex w-full justify-center items-center py-2.5 rounded-xl text-sm font-semibold text-white"
           style="background: linear-gradient(135deg, #0ea5e9 0%, #22c55e 100%);">
            Register
        </a>
    @else
        <a href="{{ route('opportunities') }}"
           class="mt-auto inline-flex w-full justify-center items-center py-2.5 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700">
            Apply now
        </a>
    @endif
</article>
