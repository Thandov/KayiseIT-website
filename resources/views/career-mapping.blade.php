<x-app-layout
    title="Career mapping and digital career pathways | KAYISE IT"
    description="Explore ICT career paths in South Africa with simple steps, qualifications, and where Kayise IT can help you register for accredited programmes."
    keywords="career mapping, ICT careers South Africa, digital skills pathways, TVET careers, KAYISE IT"
>
    <x-page-header
        title="Career Mapping"
        hero-id="career-mapping-hero"
        background-image="images/banner/CareerMapping.png"
        height="h-96" />

    <section class="relative bg-white py-10 md:py-14">
        <div aria-hidden="true" class="pointer-events-none absolute -top-24 right-0 h-72 w-72 rounded-full bg-kg-700/10 blur-3xl"></div>
        <div aria-hidden="true" class="pointer-events-none absolute bottom-0 left-0 h-64 w-64 rounded-full bg-kb-100/15 blur-3xl"></div>
        <div class="container relative max-w-screen-xl mx-auto px-4 md:px-8">
            <div class="text-center max-w-3xl mx-auto mb-8"
                 x-data
                 x-init="
                    if (window.innerWidth >= 768 && window.gsap && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                        const el = $refs.headline;
                        if (el) {
                            const words = el.innerText.split(' ');
                            el.innerHTML = words.map(w => '<span class=\'inline-block overflow-hidden\'><span class=\'hero-word inline-block\'>' + w + '</span></span>').join(' ');
                            gsap.from(el.querySelectorAll('.hero-word'), { y: 40, opacity: 0, duration: 0.5, stagger: 0.08, ease: 'power2.out' });
                        }
                    }
                 ">
                <p class="text-sm font-bold text-kg-700 uppercase tracking-wide mb-2">Your future in tech</p>
                <h1 x-ref="headline" class="text-3xl md:text-5xl font-bold text-kb-700 leading-tight">
                    Find your ICT career path in 3 clicks
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Simple steps. Real qualifications. Built for young South Africans starting out.
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                <x-career.quiz />
            </div>

            <div id="career-grid" class="mt-12 md:mt-14 scroll-mt-24">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-bold text-kb-700">Choose your path</h2>
                    <p class="mt-2 text-gray-600">Tap a career to see qualifications, costs, and your next action.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($occupations as $occupation)
                        <x-career.card :career="$occupation" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-kb-50/30">
        <div class="container max-w-screen-xl mx-auto px-4 md:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-kb-700 text-center mb-8">Why ICT in South Africa?</h2>
            <x-career.stat-counter />
        </div>
    </section>

    <section class="py-12 md:py-16 bg-kb-700 text-white">
        <div class="container max-w-screen-xl mx-auto px-4 md:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Not sure where to start?</h2>
            <p class="text-white/90 max-w-xl mx-auto mb-6">Talk to the Kayise IT team — we'll help you pick a path that fits your subjects and budget.</p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center min-h-[44px] bg-kg-700 hover:bg-kg-600 text-white font-semibold rounded-xl px-8 py-3 transition shadow-lg">
                Speak to a mentor
            </a>
        </div>
    </section>
</x-app-layout>
