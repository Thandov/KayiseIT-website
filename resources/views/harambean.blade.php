@php
    $videoUrl = config('services.harambean.video_url');
    $embedUrl = null;

    if ($videoUrl) {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([\w-]+)/', $videoUrl, $matches)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        } elseif (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $videoUrl, $matches)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
        }
    }
@endphp

<x-app-layout
    title="KAYISE IT — Harambean Alliance Application Video"
    description="Application video for KAYISE IT's membership in the Harambe Entrepreneur Alliance."
    :noindex="true"
>
    <section class="py-16 md:py-24 bg-slate-50 min-h-[70vh]">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-center text-kb-700 mb-10 md:mb-12">
                KAYISE IT — Harambean Alliance Application Video
            </h1>

            @if ($embedUrl)
                <div class="relative w-full overflow-hidden rounded-2xl bg-black aspect-video shadow-xl">
                    <iframe
                        class="absolute inset-0 w-full h-full"
                        src="{{ $embedUrl }}"
                        title="KAYISE IT Harambean Alliance Application Video"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            @else
                <div
                    class="relative w-full overflow-hidden rounded-2xl bg-[#183ea4] aspect-video flex items-center justify-center"
                    aria-label="Application video placeholder"
                >
                    <div class="absolute inset-0 bg-black/20"></div>

                    <div class="relative flex flex-col items-center text-white text-center px-6">
                        <div class="flex h-20 w-20 md:h-24 md:w-24 items-center justify-center rounded-full bg-white/15 backdrop-blur-sm ring-2 ring-white/30 shadow-lg">
                            <svg class="h-10 w-10 md:h-12 md:w-12 text-white ml-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <p class="mt-6 text-lg md:text-xl font-semibold">Application video coming soon</p>
                        <p class="mt-2 max-w-md text-sm md:text-base text-white/80">
                            This page will host the KAYISE IT video for the Harambe Entrepreneur Alliance application.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
