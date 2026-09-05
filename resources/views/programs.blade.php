@php
    $hasEnquiry = $enquiryPrograms->isNotEmpty();
    $hasRunning = $runningPrograms->isNotEmpty();
    $hasAny = $hasEnquiry || $hasRunning;
    $featured = $enquiryPrograms->first() ?? $runningPrograms->first();
@endphp

<x-app-layout
    title="Programmes | KAYISE IT"
    description="Browse and register for KAYISE IT skills development, internship, and training programmes across South Africa."
    keywords="KAYISE IT programmes, skills development, internship, TVET South Africa"
>

<x-page-header
    title="Programmes"
    subtitle="Skills & learning pathways"
    :description="$featured
        ? \Illuminate\Support\Str::limit(strip_tags($featured->description), 200)
        : 'Explore internship, TVET, and skills development programmes with KAYISE IT.'"
    hero-id="programs-hero"
    background-image="images/banner/developerProgrammer.png"
    height="h-[65vh]">

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        @if($hasEnquiry)
            <button type="button"
                    onclick="openProgramRegisterModal()"
                    class="ki-btn ki-btn-on-dark">
                Register
            </button>
        @endif
        @if($hasAny)
            <a href="#programmes"
               class="ki-btn ki-btn-on-dark ki-btn-ghost">
                View programmes
            </a>
        @endif
    </div>
</x-page-header>

@if(session('success'))
    <div class="bg-green-600 text-white">
        <div class="max-w-4xl mx-auto px-4 py-4 text-center text-sm sm:text-base font-medium">
            {{ session('success') }}
        </div>
    </div>
@endif

<section id="programmes" class="py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($hasAny)
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Available programmes</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Select a programme below and register, or apply where applications are open.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($enquiryPrograms as $program)
                    @include('programs._card', ['program' => $program, 'mode' => 'enquire'])
                @endforeach
                @foreach($runningPrograms as $program)
                    @include('programs._card', ['program' => $program, 'mode' => 'running'])
                @endforeach
            </div>
        @else
            <div class="max-w-xl mx-auto text-center ki-card">
                <p class="ki-card-title">Programmes coming soon</p>
                <p class="ki-card-body">Please check back later or get in touch with our team.</p>
                <a href="{{ route('contact') }}" class="ki-btn">Contact us</a>
            </div>
        @endif
    </div>
</section>

@if($hasEnquiry)
    @include('programs._register-modal')
@endif

</x-app-layout>
