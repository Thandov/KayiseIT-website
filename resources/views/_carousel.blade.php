@php
    $slides = $carouselSlides ?? collect();
    if ($slides->isEmpty()) {
        try {
            $slides = \App\Models\Carousel::query()->latest()->get();
        } catch (\Throwable $e) {
            $slides = collect();
        }
    }
    $fallbackCta = \Illuminate\Support\Facades\Route::has('services') ? route('services') : url('/services');
@endphp

<style>
    #headercara.home-carousel {
        position: relative;
        min-height: min(70vh, 720px);
        height: min(70vh, 720px);
        overflow: hidden;
        background: #05070c;
        margin-top: 0;
    }
    #headercara .home-carousel-track,
    #headercara .home-carousel-slide {
        position: absolute;
        inset: 0;
        height: 100%;
        width: 100%;
    }
    #headercara .home-carousel-slide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        /* Keep the image fade; delay visibility:hidden so the outgoing photo can dissolve. */
        transition: opacity 0.55s ease, visibility 0s linear 0.55s;
        z-index: 0;
        background-size: cover;
        background-position: center right;
        background-repeat: no-repeat;
    }
    #headercara .home-carousel-slide.is-active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        z-index: 2;
        transition: opacity 0.55s ease, visibility 0s linear 0s;
    }
    #headercara .home-carousel-slide::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(5, 7, 12, 0.62);
        z-index: 1;
    }
    #headercara .home-carousel-slide.is-editorial::after {
        background: linear-gradient(to top, rgba(5, 7, 12, 0.82) 0%, rgba(5, 7, 12, 0.18) 52%, rgba(5, 7, 12, 0.28) 100%);
    }
    #headercara .home-carousel-slide.is-campaign::after {
        background: linear-gradient(to top, rgba(5, 7, 12, 0.55) 0%, rgba(5, 7, 12, 0.08) 38%, transparent 62%);
    }
    #headercara .home-carousel-copy {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
        padding: 5.5rem 5.5rem 4.5rem clamp(1.5rem, 6vw, 5.5rem);
        max-width: 44rem;
        opacity: 0;
        transition: none;
    }
    #headercara .home-carousel-slide.is-active .home-carousel-copy {
        opacity: 1;
    }
    #headercara .home-carousel-slide.is-editorial .home-carousel-copy,
    #headercara .home-carousel-slide.is-campaign .home-carousel-copy {
        align-items: flex-end;
        max-width: min(44rem, 92%);
        padding-bottom: 4.75rem;
    }
    #headercara .home-carousel-kicker {
        margin: 0 0 0.75rem;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #86efac;
    }
    #headercara .home-carousel-title {
        margin: 0 0 1rem;
        font-size: clamp(2.25rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -0.02em;
        color: #fff;
        text-wrap: balance;
    }
    #headercara .home-carousel-slide.is-editorial .home-carousel-title,
    #headercara .home-carousel-slide.is-campaign .home-carousel-title {
        font-size: clamp(1.6rem, 3.4vw, 2.75rem);
        margin-bottom: 0.65rem;
    }
    #headercara .home-carousel-subtitle {
        margin: 0 0 1.75rem;
        font-size: clamp(1rem, 1.6vw, 1.2rem);
        line-height: 1.55;
        color: #d1d5db;
        max-width: 28rem;
    }
    #headercara .home-carousel-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 1.5rem;
        border-radius: 999px;
        background: #22c55e;
        color: #052e16;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(34, 197, 94, 0.28);
        transition: background 0.2s ease, transform 0.2s ease;
    }
    #headercara .home-carousel-cta:hover {
        background: #16a34a;
        color: #fff;
        transform: translateY(-1px);
    }
    #headercara .home-carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 4;
        width: 3rem;
        height: 3rem;
        display: grid;
        place-items: center;
        border-radius: 999px;
        border: 0;
        background: rgba(5, 7, 12, 0.72);
        color: #fff;
        font-size: 1.6rem;
        line-height: 1;
        cursor: pointer;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 24px rgba(0,0,0,.35);
    }
    #headercara .home-carousel-nav:hover { background: rgba(34, 197, 94, 0.9); color: #052e16; }
    #headercara .home-carousel-prev { left: clamp(0.75rem, 2vw, 1.5rem); }
    #headercara .home-carousel-next { right: clamp(0.75rem, 2vw, 1.5rem); }
    #headercara .home-carousel-dots {
        position: absolute;
        bottom: 1.5rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 4;
        display: flex;
        gap: 0.55rem;
    }
    #headercara .home-carousel-dot {
        width: 0.55rem;
        height: 0.55rem;
        border-radius: 999px;
        border: 0;
        padding: 0;
        background: rgba(255,255,255,.4);
        cursor: pointer;
        transition: width 0.2s ease, background 0.2s ease;
    }
    #headercara .home-carousel-dot.is-active {
        width: 1.5rem;
        background: #22c55e;
    }
    @media (max-width: 768px) {
        #headercara.home-carousel {
            min-height: 62vh;
            height: 62vh;
        }
        #headercara .home-carousel-copy {
            padding: 5rem 3.5rem 6.25rem 1.25rem;
            max-width: 100%;
            align-items: flex-end;
        }
        #headercara .home-carousel-slide {
            background-position: center;
        }
        #headercara .home-carousel-slide.is-classic::after {
            background: rgba(5, 7, 12, 0.72);
        }
        #headercara .home-carousel-nav {
            width: 2.5rem;
            height: 2.5rem;
            top: auto;
            bottom: 1.25rem;
            transform: none;
        }
        #headercara .home-carousel-prev { left: 1rem; }
        #headercara .home-carousel-next { right: 1rem; }
        #headercara .home-carousel-dots { bottom: 1.4rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        #headercara .home-carousel-slide { transition: none; }
        #headercara .home-carousel-cta { transition: none; }
        #headercara .home-carousel-copy { transition: none; }
    }
</style>

<section class="home-carousel" id="headercara" aria-label="Homepage highlights" aria-roledescription="carousel">
    <div class="home-carousel-track">
        @forelse ($slides as $index => $slide)
            @php
                $pic = $slide->image ?? '';
                if ($pic && ! str_starts_with($pic, 'http')) {
                    $pic = asset(ltrim(preg_replace('#^\.\./#', '', $pic), '/'));
                }
                $isActive = $index === 0;
                $template = method_exists($slide, 'templateKey') ? $slide->templateKey() : 'classic';
                $ctaHref = method_exists($slide, 'destinationUrl') ? $slide->destinationUrl() : $fallbackCta;
                $ctaLabel = method_exists($slide, 'destinationLabel') ? $slide->destinationLabel() : 'Explore services';
                $kicker = $slide->title ?? '';
                $headline = $slide->middletxt ?? '';
                $support = $slide->btmtxt ?? '';
                $showKicker = filled($kicker) && $template !== 'campaign';
                $showHeadline = filled($headline) || $template === 'classic';
                $showSupport = filled($support);
                $aria = $headline ?: $kicker ?: 'Homepage slide';
            @endphp
            <article
                class="home-carousel-slide is-{{ $template }} {{ $isActive ? 'is-active' : '' }}"
                style="background-image: url('{{ $pic }}');"
                aria-hidden="{{ $isActive ? 'false' : 'true' }}"
                aria-label="{{ $aria }}"
            >
                <div class="home-carousel-copy">
                    <div>
                        @if($showKicker)
                            <p class="home-carousel-kicker">{{ $kicker }}</p>
                        @endif
                        @if($showHeadline)
                            <{{ $index === 0 && $headline ? 'h1' : 'p' }} class="home-carousel-title">
                                {{ $headline ?: ($template === 'classic' ? 'KAYISE IT' : '') }}
                            </{{ $index === 0 && $headline ? 'h1' : 'p' }}>
                        @endif
                        @if($showSupport)
                            <p class="home-carousel-subtitle">{{ $support }}</p>
                        @endif
                        @if($ctaHref && $ctaLabel)
                            <a class="home-carousel-cta" href="{{ $ctaHref }}">{{ $ctaLabel }}</a>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <article class="home-carousel-slide is-classic is-active" style="background-image: url('{{ asset('images/KayiseIT-Team.jpg') }}');">
                <div class="home-carousel-copy">
                    <div>
                        <p class="home-carousel-kicker">KAYISE IT</p>
                        <h1 class="home-carousel-title">Welcome on board</h1>
                        <p class="home-carousel-subtitle">Your trusted partner in digital transformation</p>
                        <a class="home-carousel-cta" href="{{ $fallbackCta }}">Explore services</a>
                    </div>
                </div>
            </article>
        @endforelse
    </div>

    @if($slides->count() > 1)
        <button type="button" class="home-carousel-nav home-carousel-prev" aria-label="Previous slide">&lsaquo;</button>
        <button type="button" class="home-carousel-nav home-carousel-next" aria-label="Next slide">&rsaquo;</button>
        <div class="home-carousel-dots" role="tablist" aria-label="Choose a slide">
            @foreach ($slides as $index => $slide)
                <button type="button" class="home-carousel-dot {{ $index === 0 ? 'is-active' : '' }}" data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>
    @endif
</section>

<script>
(function () {
    const root = document.getElementById('headercara');
    if (!root || root.dataset.ready) return;
    root.dataset.ready = '1';

    const slides = root.querySelectorAll('.home-carousel-slide');
    const dots = root.querySelectorAll('.home-carousel-dot');
    if (slides.length < 2) return;

    let current = 0;
    let timer = null;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function show(index) {
        current = (index + slides.length) % slides.length;
        slides.forEach(function (slide, i) {
            const active = i === current;
            slide.classList.toggle('is-active', active);
            slide.setAttribute('aria-hidden', active ? 'false' : 'true');
        });
        dots.forEach(function (dot, i) {
            const active = i === current;
            dot.classList.toggle('is-active', active);
            dot.setAttribute('aria-current', active ? 'true' : 'false');
        });
    }

    function next() { show(current + 1); }
    function start() {
        stop();
        if (!reduceMotion) timer = setInterval(next, 6000);
    }
    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    const prevBtn = root.querySelector('.home-carousel-prev');
    const nextBtn = root.querySelector('.home-carousel-next');
    if (prevBtn) prevBtn.addEventListener('click', function () { show(current - 1); start(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { next(); start(); });
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            show(parseInt(dot.getAttribute('data-index'), 10));
            start();
        });
    });

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    start();
})();
</script>
