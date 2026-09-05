@php
    $partners = \App\Models\Partner::active()->ordered()->get();
@endphp

@if($partners->isNotEmpty())
<div class="flex flex-wrap items-center justify-center gap-10 md:gap-12" id="client_logo_carousel">
    @foreach($partners as $partner)
        @if($partner->logo_path)
            @php
                $logoUrl = $partner->logo_path;
                if (str_starts_with($logoUrl, 'partners/')) {
                    $logoUrl = 'images/partners/' . basename($logoUrl);
                }
            @endphp
            <a href="{{ $partner->website_url ?? '#' }}"
               @if($partner->website_url) target="_blank" rel="noopener noreferrer" @endif
               class="relative block group">
                <img
                    class="h-12 sm:h-14 md:h-16 lg:h-20 object-contain filter grayscale hover:grayscale-0 opacity-80 hover:opacity-100 transition"
                    src="{{ asset($logoUrl) }}"
                    alt="{{ $partner->name ?? 'Partner logo' }}"
                    loading="lazy"
                >
                @if($partner->mou_signed)
                    <span class="absolute -top-2 -right-2 bg-green-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full leading-none shadow">
                        MOU
                    </span>
                @endif
            </a>
        @endif
    @endforeach
</div>
@endif
