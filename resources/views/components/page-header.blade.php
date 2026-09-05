@props([
    'heroId' => 'page-header',
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'backgroundImage' => null,
    'carouselSlides' => null,
    'showLogo' => false,
    'showCta' => false,
    'ctaText' => 'Contact us: info@kayiseit.com',
    'ctaHref' => 'mailto:info@kayiseit.com',
    'height' => 'h-96',
])

@php
    $carouselSlides = $carouselSlides instanceof \Illuminate\Support\Collection
        ? $carouselSlides
        : collect($carouselSlides ?? []);
    $hasCarousel = $carouselSlides->count() > 0;
    $isFullHeight = $height === 'full';
    $starfieldId = $heroId . '-starfield';
    $textCarouselId = $heroId . '-text-carousel';
    $defaultBg = asset('images/KayiseIT-Team.jpg');
@endphp

<section id="{{ $heroId }}" class="page-header {{ $isFullHeight ? '' : $height }}" style="margin-top:0;{{ $isFullHeight ? ' height:100vh;' : '' }} background:#000;">
    <style>
        #{{ $heroId }} { background: #000; position: relative; overflow: hidden; }
        #{{ $heroId }} .scene { position: relative; width: 100%; height: 100%; min-height: inherit; }
        #{{ $heroId }} .starfield { position: absolute; inset: 0; width: 100%; height: 100%; display: block; z-index: 1; }
        #{{ $heroId }} .photo { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: .25; z-index: 0; transition: opacity 0.8s ease-in-out; }
        #{{ $heroId }} .slide-bg { opacity: 0; }
        #{{ $heroId }} .slide-bg.active { opacity: .25; }
        #{{ $heroId }} .zoom { position: absolute; inset: 0; background: #000; transform: scale(1); animation: {{ $heroId }}-zoomIn 60s linear infinite alternate; z-index: 0; }
        @keyframes {{ $heroId }}-zoomIn { from { transform: scale(1); } to { transform: scale(1.15); } }
        #{{ $heroId }} .center { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: min(92vw, 880px); text-align: center; z-index: 3; padding: 16px; }
        #{{ $heroId }} .logo { width: min(280px, 40vw); height: auto; display: block; margin: 0 auto 16px; filter: brightness(0) invert(1) drop-shadow(0 6px 30px rgba(124,199,255,.25)); }
        #{{ $heroId }} .title { font-size: clamp(28px, 4vw, 56px); letter-spacing: .06em; margin: 0 0 8px; text-transform: uppercase; text-shadow: 0 0 10px rgba(255,255,255,.25); min-height: 1.2em; color: #fff; }
        #{{ $heroId }} .subtitle { font-size: clamp(14px, 2vw, 18px); color: #cbd5e1; margin: 0 0 18px; min-height: 1.5em; }
        #{{ $heroId }} .description { font-size: clamp(14px, 1.8vw, 17px); color: #94a3b8; margin: 0 0 18px; max-width: 42rem; margin-left: auto; margin-right: auto; }
        #{{ $heroId }} .cta { display: inline-block; padding: 10px 16px; border: 1px solid rgba(124,199,255,.3); color: #cfe9ff; border-radius: 999px; text-decoration: none; backdrop-filter: blur(4px); background: rgba(15,35,55,.35); box-shadow: inset 0 0 0 1px rgba(124,199,255,.08); }
        #{{ $heroId }} .cta:hover { background: rgba(15,35,55,.55); border-color: rgba(124,199,255,.55); }
        #{{ $heroId }} .slide { opacity: 0; transition: opacity 0.8s ease-in-out; position: absolute; width: 100%; }
        #{{ $heroId }} .slide.active { opacity: 1; position: relative; }
        @media (prefers-reduced-motion: reduce) { #{{ $heroId }} .zoom { animation: none; } }
    </style>

    <div class="scene" role="img" aria-label="Moving forward through space with stars warping past">
        @if($hasCarousel)
            @foreach($carouselSlides as $index => $slide)
                @php
                    $bgImage = $slide->image
                        ? (str_starts_with($slide->image, 'http') ? $slide->image : asset($slide->image))
                        : $defaultBg;
                @endphp
                <div class="photo slide-bg {{ $index === 0 ? 'active' : '' }}"
                     data-bg-image="{{ $bgImage }}"
                     @if($index !== 0) style="display: none;" @endif></div>
            @endforeach
        @else
            @php
                $staticBg = $backgroundImage
                    ? (str_starts_with($backgroundImage, 'http') ? $backgroundImage : asset($backgroundImage))
                    : $defaultBg;
            @endphp
            <div class="photo" style="background-image: url('{{ $staticBg }}');"></div>
        @endif

        <div class="zoom"></div>
        <canvas id="{{ $starfieldId }}" class="starfield" aria-hidden="true"></canvas>

        <main class="center">
            @if($showLogo)
                <img src="{{ asset('images/logo.svg') }}" alt="KAYISE IT" class="logo">
            @endif

            <div id="{{ $textCarouselId }}" class="relative">
                @if($hasCarousel)
                    @foreach($carouselSlides as $index => $slide)
                        <div class="slide {{ $index === 0 ? 'active' : '' }}">
                            <h1 class="title">{{ $slide->middletxt ?? 'Welcome to KAYISE IT' }}</h1>
                            <p class="subtitle">{{ $slide->btmtxt ?? 'Your trusted partner in digital transformation' }}</p>
                            @if($slide->title)
                                <p class="text-sm text-blue-400 mt-2">{{ $slide->title }}</p>
                            @endif
                        </div>
                    @endforeach
                @elseif($showLogo)
                    <div class="slide active">
                        <h1 class="title">Welcome on Board to KAYISE IT</h1>
                        <p class="subtitle">Your trusted partner in digital transformation and innovation</p>
                    </div>
                    <div class="slide">
                        <h1 class="title">What We Offer</h1>
                        <p class="subtitle">Custom software development, web solutions, and IT consulting services</p>
                    </div>
                    <div class="slide">
                        <h1 class="title">Why Us</h1>
                        <p class="subtitle">10+ years of experience delivering cutting-edge solutions with 24/7 support</p>
                    </div>
                @else
                    <div class="slide active">
                        @if($title)
                            <h1 class="title">{{ $title }}</h1>
                        @endif
                        @if($subtitle)
                            <p class="subtitle">{{ $subtitle }}</p>
                        @endif
                        @if($description)
                            <p class="description">{{ $description }}</p>
                        @endif
                    </div>
                @endif
            </div>

            @if($showCta)
                <a class="cta" href="{{ $ctaHref }}">{{ $ctaText }}</a>
            @endif

            @if($slot->isNotEmpty())
                <div class="mt-8">
                    {{ $slot }}
                </div>
            @endif
        </main>
    </div>

    <script>
    (function() {
        const heroId = @json($heroId);
        const canvas = document.getElementById(@json($starfieldId));
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let stars = [];
        let width = 0, height = 0, cx = 0, cy = 0;

        function resize() {
            const cssW = canvas.parentElement.clientWidth;
            const cssH = canvas.parentElement.clientHeight;
            const dpr = Math.max(1, Math.min(2, window.devicePixelRatio || 1));
            canvas.style.width = cssW + 'px';
            canvas.style.height = cssH + 'px';
            canvas.width = Math.floor(cssW * dpr);
            canvas.height = Math.floor(cssH * dpr);
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            width = cssW; height = cssH; cx = width / 2; cy = height / 2;
            const target = Math.max(400, Math.floor(width * height * 0.00020));
            if (stars.length < target) {
                for (let i = stars.length; i < target; i++) stars[i] = spawn();
            } else {
                stars.length = target;
            }
        }

        function spawn() {
            const angle = Math.random() * Math.PI * 2;
            const radius = Math.random() * Math.max(width, height) * 0.65;
            return { x: Math.cos(angle) * radius, y: Math.sin(angle) * radius, z: Math.random() * 800 + 200, s: Math.random() * 1.5 + 0.5 };
        }

        function updateAndDraw(dt) {
            ctx.clearRect(0, 0, width, height);
            ctx.fillStyle = '#fff';
            const speed = 40;
            for (let i = 0; i < stars.length; i++) {
                const st = stars[i];
                st.z -= speed * dt;
                if (st.z <= 1) { stars[i] = spawn(); continue; }
                const f = 200 / st.z;
                const sx = cx + st.x * f;
                const sy = cy + st.y * f;
                const r = Math.max(0.7, st.s * (1.2 - st.z / 1000));
                const a = Math.min(1, 1.1 - st.z / 1000);
                if (sx < -50 || sx > width + 50 || sy < -50 || sy > height + 50) { stars[i] = spawn(); continue; }
                ctx.globalAlpha = a;
                ctx.beginPath();
                ctx.arc(sx, sy, r, 0, Math.PI * 2);
                ctx.fill();
            }
            ctx.globalAlpha = 1;
        }

        let last = performance.now();
        function frame(now) {
            const dt = Math.min(0.05, (now - last) / 1000);
            last = now;
            updateAndDraw(dt);
            requestAnimationFrame(frame);
        }

        window.addEventListener('resize', resize);
        resize();
        requestAnimationFrame(frame);

        const slides = document.querySelectorAll('#' + @json($textCarouselId) + ' .slide');
        const bgSlides = document.querySelectorAll('#' + heroId + ' .slide-bg');

        bgSlides.forEach((bgSlide) => {
            const bgImage = bgSlide.getAttribute('data-bg-image');
            if (bgImage) {
                bgSlide.style.backgroundImage = 'url(' + bgImage + ')';
            }
        });

        if (slides.length <= 1) return;

        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });

            bgSlides.forEach((bgSlide, i) => {
                if (i === index) {
                    bgSlide.classList.add('active');
                    bgSlide.style.display = 'block';
                    bgSlide.style.opacity = '1';
                } else {
                    bgSlide.classList.remove('active');
                    bgSlide.style.opacity = '0';
                    setTimeout(() => {
                        if (!bgSlide.classList.contains('active')) {
                            bgSlide.style.display = 'none';
                        }
                    }, 800);
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        showSlide(0);
        setInterval(nextSlide, 4000);
    })();
    </script>
</section>
