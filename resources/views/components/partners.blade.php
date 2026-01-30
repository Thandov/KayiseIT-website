@php
    // Get partners from database if not passed as variable
    if (!isset($partners)) {
        $partners = \App\Models\Partner::active()->ordered()->get();
    }
@endphp

<div class="flex flex-wrap items-center justify-center gap-10 md:gap-12" id="client_logo_carousel">
    @forelse($partners as $partner)
        @if($partner->logo_path)
            <a href="{{ $partner->website_url ?? '#' }}" 
               @if($partner->website_url) target="_blank" rel="noopener noreferrer" @endif
               class="block">
                <img
                    class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
                    src="{{ asset($partner->logo_path) }}"
                    alt="{{ $partner->name ?? 'Partner logo' }}"
                    loading="lazy"
                >
            </a>
        @endif
    @empty
        {{-- Fallback to hardcoded partners if database is empty --}}
        <img
            class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
            src="{{ asset('images/partners/mict.png') }}"
            alt="MICT SETA"
            loading="lazy"
        >
        <img
            class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
            src="{{ asset('images/partners/Ehlanzeni.png') }}"
            alt="Ehlanzeni TVET College"
            loading="lazy"
        >
        <img
            class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
            src="{{ asset('images/partners/tarsus.png') }}"
            alt="Tarsus on Demand"
            loading="lazy"
        >
        <img
            class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
            src="{{ asset('images/partners/scg.png') }}"
            alt="SCG South Africa"
            loading="lazy"
        >
    @endforelse
</div>