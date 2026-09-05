@props(['url', 'title' => 'Career video'])

@php
    $embed = \App\Support\VideoEmbed::parse($url);
@endphp

@if ($embed)
    <motionless-div class="relative w-full overflow-hidden rounded-2xl bg-black aspect-video shadow-lg">
        @if ($embed['type'] === 'file')
            <video class="w-full h-full" controls playsinline preload="metadata" title="{{ $title }}">
                <source src="{{ str_starts_with($embed['embed'], 'http') ? $embed['embed'] : asset($embed['embed']) }}">
            </video>
        @else
            <iframe
                class="absolute inset-0 w-full h-full"
                src="{{ $embed['embed'] }}"
                title="{{ $title }}"
                loading="lazy"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        @endif
    </motionless-div>
@endif
