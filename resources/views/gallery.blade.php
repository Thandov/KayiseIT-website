<x-app-layout
    title="Project and event gallery | KAYISE IT"
    description="See photos from KAYISE IT training sessions, launches, and community ICT and drone programmes."
    keywords="KAYISE IT gallery, events, training photos, ICT programmes South Africa"
>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css">
        <style>
            .gallery-lightbox-links {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
            .glightbox-clean .gslide-description {
                background: rgba(0, 0, 0, 0.55);
            }
        </style>
    @endpush

    <x-page-header
        title="Our Gallery"
        subtitle="Capturing moments, creating memories"
        description="Explore our collection of memorable experiences and achievements"
        hero-id="gallery-hero-new"
        background-image="images/landing-page/banner3.png"
        height="h-96" />

    @if(session('error'))
        <div class="container mx-auto p-6">
            <div class="rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="container mx-auto ki-page">
        @if (!empty($galleries))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($galleries as $gallery)
                    <button
                        type="button"
                        class="js-open-album relative block w-full overflow-hidden rounded-xl text-left shadow-lg transition-shadow duration-300 hover:shadow-2xl"
                        data-gallery="gallery-{{ $gallery['gallery_id'] }}"
                    >
                        <div class="relative h-64">
                            @if(!empty($gallery['photos'][0]['path']))
                                <img
                                    src="{{ asset($gallery['photos'][0]['path']) }}"
                                    alt="{{ $gallery['name'] }} cover"
                                    class="absolute inset-0 h-full w-full object-cover"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.style.display='none'; this.parentElement.classList.add('bg-[#183ea4]');"
                                >
                                <div class="absolute inset-0 bg-black/50"></div>
                            @else
                                <div class="absolute inset-0 bg-[#183ea4]"></div>
                            @endif

                            <div class="relative flex h-full flex-col justify-end p-6 text-white">
                                <h3 class="mb-2 text-xl font-bold drop-shadow-lg">{{ $gallery['name'] }}</h3>
                                <div class="ki-cluster text-white/90">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold drop-shadow">{{ count($gallery['photos']) }} photos</span>
                                </div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>

            <div class="gallery-lightbox-links" aria-hidden="true">
                @foreach ($galleries as $gallery)
                    @foreach ($gallery['photos'] as $index => $photo)
                        @continue(empty($photo['path']))
                        <a
                            href="{{ asset($photo['path']) }}"
                            class="glightbox"
                            data-gallery="gallery-{{ $gallery['gallery_id'] }}"
                            data-glightbox="title: {{ e($gallery['name']) }}; description: {{ $index + 1 }} / {{ count($gallery['photos']) }}"
                        >
                            {{ $gallery['name'] }} photo {{ $index + 1 }}
                        </a>
                    @endforeach
                @endforeach
            </div>
        @else
            <div class="py-16 text-center text-gray-500">
                <p class="text-xl">No galleries available yet</p>
            </div>
        @endif
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js"></script>
        <script>
            (function () {
                if (typeof GLightbox !== 'function') {
                    return;
                }

                GLightbox({
                    selector: '.glightbox',
                    loop: true,
                    touchNavigation: true,
                    keyboardNavigation: true,
                    zoomable: true,
                    openEffect: 'fade',
                    closeEffect: 'fade',
                    slideEffect: 'slide',
                });

                document.querySelectorAll('.js-open-album').forEach(function (button) {
                    button.addEventListener('click', function () {
                        const galleryId = button.getAttribute('data-gallery');
                        const first = document.querySelector('a.glightbox[data-gallery="' + galleryId + '"]');
                        if (first) {
                            first.click();
                        }
                    });
                });
            })();
        </script>
    @endpush
</x-app-layout>
