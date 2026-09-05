<x-app-layout
    :title="$occupations->occupation_name . ' career path | KAYISE IT'"
    :description="$occupations->description ?? 'Explore ICT career steps and qualifications with KAYISE IT.'"
>
    <section class="relative bg-kb-700 text-white py-16 md:py-24 overflow-hidden">
        @if ($occupations->occupation_banner)
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                 style="background-image: url('{{ asset('images/banner/'.$occupations->occupation_banner) }}')"></div>
        @endif
        <div class="relative container max-w-screen-xl mx-auto px-4 md:px-8 text-center" data-aos="fade-up">
            <a href="{{ route('career-mapping') }}" class="inline-flex items-center text-sm text-white/80 hover:text-white mb-4 min-h-[44px]">
                ← All careers
            </a>
            <h1 class="text-3xl md:text-5xl font-bold">{{ $occupations->occupation_name }}</h1>
            @if ($occupations->day_in_life)
                <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">{{ $occupations->day_in_life }}</p>
            @endif
            @if ($occupations->entry_salary_min && $occupations->entry_salary_max)
                <p class="mt-3 text-sm text-white/75">
                    Typical entry salary: R{{ number_format($occupations->entry_salary_min) }} – R{{ number_format($occupations->entry_salary_max) }} per year
                </p>
            @endif
        </div>
    </section>

    <section class="py-10 md:py-14 bg-white">
        <div class="container max-w-screen-xl mx-auto px-4 md:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-1 space-y-6">
                    <x-career.subjects-pill />
                    @if ($occupations->description)
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100" data-aos="fade-right">
                            <h3 class="font-bold text-kb-700 mb-2">About this career</h3>
                            <p class="text-sm text-gray-600">{{ $occupations->description }}</p>
                        </div>
                    @endif
                </div>

                <div class="md:col-span-2"
                     x-data="{ activeSpec: {{ $specializations->first()?->spec_id ?? 'null' }} }">
                    <h2 class="text-2xl font-bold text-kb-700 mb-4" data-aos="fade-up">Your roadmap</h2>
                    <p class="text-sm text-gray-600 mb-4" data-aos="fade-up">Pick a specialisation, then expand each step for what to do next.</p>

                    @if ($specializations->count())
                        <div class="flex gap-2 overflow-x-auto pb-3 snap-x snap-mandatory md:flex-col md:overflow-visible md:pb-0 mb-6 -mx-1 px-1"
                             data-aos="fade-up">
                            @foreach ($specializations as $spec)
                                <button type="button"
                                        @click="activeSpec = {{ $spec->spec_id }}"
                                        :class="activeSpec === {{ $spec->spec_id }} ? 'bg-kb-700 text-white border-kb-700 shadow-md' : 'bg-white text-kb-700 border-gray-200 hover:border-kb-100'"
                                        class="snap-start shrink-0 md:shrink md:w-full text-left px-4 py-3 rounded-xl border-2 text-sm font-semibold transition min-h-[44px] max-w-[85vw] md:max-w-none">
                                    {{ $spec->specialization_name }}
                                </button>
                            @endforeach
                        </div>

                        @foreach ($specializations as $spec)
                            <div x-show="activeSpec === {{ $spec->spec_id }}" x-transition class="mb-8">
                                <h3 class="text-lg font-bold text-kb-700 mb-4">{{ $spec->specialization_name }}</h3>
                                <x-career.roadmap :steps="$careerStepsArray[$spec->spec_id] ?? collect()" />
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Specialisations for this career are coming soon.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 p-4 bg-white/95 backdrop-blur border-t border-gray-200 shadow-lg">
        <a href="#career-roadmap-start"
           onclick="document.querySelector('[x-data]')?.scrollIntoView({behavior:'smooth'})"
           class="flex items-center justify-center min-h-[44px] w-full bg-kg-700 text-white font-semibold rounded-xl shadow-md">
            Show me the path
        </a>
    </div>
    <div class="h-20 md:hidden" aria-hidden="true"></div>
</x-app-layout>
