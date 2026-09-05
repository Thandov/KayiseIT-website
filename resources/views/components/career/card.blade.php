@props(['career'])

@php
    $tags = match ($career->slug ?? '') {
        'software-developer', 'developer-programmer', 'programmer-analyst' => 'build,creative',
        'network-systems-engineer', 'ict-systems-analyst' => 'solve,organize',
        'ict-security-specialist' => 'protect,solve',
        'multimedia-specialist' => 'creative,build',
        'ict-project-manager' => 'lead,organize',
        'ict-sales-representative' => 'people,organize',
        default => 'solve',
    };
    $href = $career->slug
        ? route('careers.show', $career->slug)
        : url('viewoccupations/'.$career->occup_id);
@endphp

<a href="{{ $href }}"
   data-career-tags="{{ $tags }}"
   class="group relative block bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition duration-300 overflow-hidden ring-1 ring-gray-100 hover:ring-kg-700/40">
    <div class="absolute inset-x-0 top-0 h-1 bg-[#183ea4] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
    <div class="p-6 flex flex-col h-full relative">
        <div class="flex justify-center mb-4">
            @if($career->image && !str_starts_with(trim($career->image), '<'))
                <img src="{{ asset('images/occupations_logo/'.$career->image) }}" alt="{{ $career->occupation_name }}" class="h-20 w-20 object-contain" loading="lazy">
            @else
                <div class="h-20 w-20 rounded-xl bg-kb-50 flex items-center justify-center text-kb-100 font-bold text-2xl">{{ strtoupper(substr($career->occupation_name, 0, 1)) }}</div>
            @endif
        </div>
        <h3 class="text-xl font-bold text-kb-700 text-center group-hover:text-kb-100 transition">{{ $career->occupation_name }}</h3>
        @if($career->description)
            <p class="mt-3 text-sm text-gray-600 text-center line-clamp-3 flex-grow">{{ $career->description }}</p>
        @endif
        @if($career->entry_salary_min && $career->entry_salary_max)
            <p class="mt-4 text-xs text-center text-gray-500">Entry R{{ number_format($career->entry_salary_min / 1000) }}k – R{{ number_format($career->entry_salary_max / 1000) }}k / year</p>
        @endif
        <span class="mt-4 text-sm font-semibold text-kg-700 text-center block">See the path →</span>
    </div>
</a>