<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "KAYISE IT - Specialized Software Development & IT Consulting";
    $metaDescription = "Professional software development, web development, and IT consulting services. Custom solutions for enterprise modernization and digital transformation.";
    $metaKeywords = "Software Development, Web Development, IT Consulting, Enterprise Solutions, Software Engineering, Digital Transformation, Business Automation, IT Services, South Africa, Professional Development";
    @endphp
    @endsection
    
    <!-- Hero banner -->
    <section id="hero-banner" style="margin-top:0;">
        @php
        // Use carousel slides passed from controller (with fallback to empty collection)
        $carouselSlides = $carouselSlides ?? collect();
        // Fallback to default if no carousel slides exist
        $hasSlides = $carouselSlides->count() > 0;
        @endphp
        <style>
        html, body { height: 100%; margin: 0; background: #000; color: #fff; }
        #hero-banner { background: #000; }
        #hero-banner .scene { position: relative; width: 100vw; height: 100vh; }
        #hero-banner #starfield { position: absolute; inset: 0; width: 100%; height: 100%; display: block; z-index: 1; }
        #hero-banner .photo { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: .25; z-index: 0; transition: opacity 0.8s ease-in-out; }
        #hero-banner .slide-bg { opacity: 0; }
        #hero-banner .slide-bg.active { opacity: .25; }
        #hero-banner .slide-bg[data-bg-image] { background-image: var(--bg-image); }
        #hero-banner .zoom { position: absolute; inset: 0; background: radial-gradient(100% 100% at 50% 50%, #01040a 0%, #000 60%); transform: scale(1); animation: zoomIn 60s linear infinite alternate; z-index: 0; }
        @keyframes zoomIn { from { transform: scale(1); } to { transform: scale(1.15); } }
        #hero-banner .center { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: min(92vw, 880px); text-align: center; z-index: 3; padding: 16px; }
        #hero-banner .logo { width: min(280px, 40vw); height: auto; display: block; margin: 0 auto 16px; filter: brightness(0) invert(1) drop-shadow(0 6px 30px rgba(124,199,255,.25)); }
        #hero-banner .title { font-size: clamp(28px, 4vw, 56px); letter-spacing: .06em; margin: 0 0 8px; text-transform: uppercase; text-shadow: 0 0 10px rgba(255,255,255,.25); min-height: 1.2em; }
        #hero-banner .subtitle { font-size: clamp(14px, 2vw, 18px); color: #cbd5e1; margin: 0 0 18px; min-height: 1.5em; }
        #hero-banner .cta { display: inline-block; padding: 10px 16px; border: 1px solid rgba(124,199,255,.3); color: #cfe9ff; border-radius: 999px; text-decoration: none; backdrop-filter: blur(4px); background: rgba(15,35,55,.35); box-shadow: inset 0 0 0 1px rgba(124,199,255,.08); }
        #hero-banner .cta:hover { background: rgba(15,35,55,.55); border-color: rgba(124,199,255,.55); }
        .slide { opacity: 0; transition: opacity 0.8s ease-in-out; position: absolute; width: 100%; }
        .slide.active { opacity: 1; position: relative; }
        #hero-banner .glow { position: absolute; left: 50%; top: 50%; width: 60vmax; height: 60vmax; transform: translate(-50%, -50%); background: radial-gradient(closest-side, rgba(124,199,255,.07), transparent 70%); filter: blur(30px); z-index: 2; }
        @media (prefers-reduced-motion: reduce) { #hero-banner .zoom { animation: none; } }
        </style>
        <div class="scene" role="img" aria-label="Moving forward through space with stars warping past">
            @if($hasSlides)
                @foreach($carouselSlides as $index => $slide)
                    @php
                        $bgImage = $slide->image ? (str_starts_with($slide->image, 'http') ? $slide->image : asset($slide->image)) : asset('images/KayiseIT-Team.jpg');
                    @endphp
                    <div class="photo slide-bg {{ $index === 0 ? 'active' : '' }}" 
                         data-bg-image="{{ $bgImage }}"
                         @if($index !== 0) style="display: none;" @endif></div>
                @endforeach
            @else
                <div class="photo" style="background-image: url('{{ asset('images/KayiseIT-Team.jpg') }}');"></div>
            @endif
            <div class="zoom"></div>
            <canvas id="starfield" aria-hidden="true"></canvas>
            <div class="glow" aria-hidden="true"></div>
            <main class="center">
                <img src="{{ asset('images/kayise-logo.png') }}" alt="KAYISE IT" class="logo">
                <div id="text-carousel" class="relative">
                    @if($hasSlides)
                        @foreach($carouselSlides as $index => $slide)
                            <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                <h1 class="title">{{ $slide->middletxt ?? 'Welcome to KAYISE IT' }}</h1>
                                <p class="subtitle">{{ $slide->btmtxt ?? 'Your trusted partner in digital transformation' }}</p>
                                @if($slide->title)
                                    <p class="text-sm text-blue-400 mt-2">{{ $slide->title }}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback content if no carousel slides exist -->
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
                    @endif
                </div>
                <a class="cta" href="mailto:info@kayiseit.com">Contact us: info@kayiseit.com</a>
            </main>
        </div>
        <script>
        (function() {
            const canvas = document.getElementById('starfield');
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
        })();

        // Text Carousel with Background Image Sync
        (function() {
            const slides = document.querySelectorAll('#text-carousel .slide');
            const bgSlides = document.querySelectorAll('.slide-bg');
            let currentSlide = 0;
            
            // Set background images from data attributes
            bgSlides.forEach((bgSlide) => {
                const bgImage = bgSlide.getAttribute('data-bg-image');
                if (bgImage) {
                    bgSlide.style.setProperty('--bg-image', 'url(' + bgImage + ')');
                    bgSlide.style.backgroundImage = 'url(' + bgImage + ')';
                }
            });
            
            function showSlide(index) {
                // Update text slides
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (i === index) {
                        slide.classList.add('active');
                    }
                });
                
                // Update background images
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
                        }, 800); // Match transition duration
                    }
                });
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            
            // Initialize first slide
            if (slides.length > 0) {
                showSlide(0);
            }
            
            // Change slide every 4 seconds
            if (slides.length > 1) {
                setInterval(nextSlide, 4000);
            }
        })();

        // Hypnotic abstract animation (Why Choose Us) - init after DOM ready
        (function() {
            function init(){
                // FULL SECTION BACKGROUND RINGS (no particles)
                const bg = document.getElementById('why-rings-bg');
                if (bg) {
                    const bctx = bg.getContext('2d');
                    const DPR = Math.max(1, Math.min(2, window.devicePixelRatio || 1));
                    let bw, bh, bcx, bcy, t=0;
                    function bresize(){
                        const rect = bg.getBoundingClientRect();
                        const cssW = rect.width; const cssH = rect.height;
                        bg.width = Math.floor(cssW * DPR); bg.height = Math.floor(cssH * DPR);
                        bctx.setTransform(DPR,0,0,DPR,0,0); bw = cssW; bh = cssH; bcx = bw*0.82; bcy = bh*0.28;
                    }
                    function bdraw(dt){
                        t += dt; bctx.clearRect(0,0,bw,bh);
                        const g = bctx.createLinearGradient(0,0,0,bh);
                        g.addColorStop(0,'#ffffff'); g.addColorStop(1,'#f8fafc');
                        bctx.fillStyle = g; bctx.fillRect(0,0,bw,bh);
                        const rings = 22;
                        for (let i=0;i<rings;i++){
                            const r = (i+1) * (Math.min(bw,bh)/(rings+2));
                        const phase = i*0.25; // static rings (no time-based animation)
                            bctx.beginPath();
                            bctx.arc(bcx, bcy, r*(0.98 + 0.02*Math.sin(phase)), 0, Math.PI*2);
                            bctx.strokeStyle = `rgba(34,197,94,${0.08 + i/(rings*60)})`;
                            bctx.lineWidth = 1;
                            bctx.stroke();
                        }
                    }
                    let last = performance.now();
                    function bloop(now){ const dt = Math.min(0.05,(now-last)/1000); last=now; bdraw(dt); requestAnimationFrame(bloop); }
                    window.addEventListener('resize', bresize); bresize(); requestAnimationFrame(bloop);
                }

                const canvas = document.getElementById('why-hypno');
                if (!canvas) return;
                const ctx = canvas.getContext('2d');
                let w, h, cx, cy, t = 0;
                const DPR = Math.max(1, Math.min(2, window.devicePixelRatio || 1));
                function resize() {
                    const cssW = canvas.parentElement.clientWidth;
                    const cssH = 448; // 28rem
                    canvas.style.width = cssW + 'px';
                    canvas.style.height = cssH + 'px';
                    canvas.width = Math.floor(cssW * DPR);
                    canvas.height = Math.floor(cssH * DPR);
                    ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
                    w = cssW; h = cssH; cx = w/2; cy = h/2;
                }
                function draw(dt) {
                    t += dt;
                    ctx.clearRect(0,0,w,h);
                    const g = ctx.createRadialGradient(cx, cy, 10, cx, cy, Math.max(w,h));
                    g.addColorStop(0, '#020617');
                    g.addColorStop(1, '#0b1220');
                    ctx.fillStyle = g; ctx.fillRect(0,0,w,h);
                    const rings = 18;
                    for (let i=0;i<rings;i++) {
                        const r = (i+1) * (Math.min(w,h)/ (rings+2));
                        const phase = t*0.6 + i*0.35;
                        const pulse = 0.55 + 0.45*Math.sin(phase);
                        ctx.beginPath();
                        ctx.arc(cx + Math.sin(phase*0.7)*8, cy + Math.cos(phase*0.5)*8, r * (0.96 + 0.04*Math.sin(phase*1.3)), 0, Math.PI*2);
                        ctx.strokeStyle = `rgba(34,197,94,${0.14 + 0.08*Math.sin(phase)})`;
                        ctx.lineWidth = 1.2 + 1.2*pulse;
                        ctx.stroke();
                    }
                    // No scatter dots inside the card per request
                    ctx.globalAlpha = 1;
                }
                let last = performance.now();
                function loop(now){
                    const dt = Math.min(0.05,(now-last)/1000); last = now; draw(dt); requestAnimationFrame(loop);
                }
                window.addEventListener('resize', resize); resize(); requestAnimationFrame(loop);
            }
            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                setTimeout(init, 0);
            } else {
                window.addEventListener('DOMContentLoaded', init);
            }
        })();
        </script>
    </section>

    <!-- NOTIFICATION BAR: Space-themed Announcements -->
    @php
        // Use announcements from backend (passed from DashboardController)
        // Filter out expired announcements for notification bar
        $activeAnnouncements = isset($announcements) && $announcements->count() > 0 
            ? $announcements->filter(function($announcement) {
                // Double-check expiration - must be null or in the future
                if (!isset($announcement->expires_at) || $announcement->expires_at === null) {
                    return true;
                }
                // Use timestamp comparison to avoid timezone issues
                $nowTimestamp = now()->timestamp;
                if (is_string($announcement->expires_at)) {
                    $expiresTimestamp = strtotime($announcement->expires_at);
                } elseif ($announcement->expires_at instanceof \Carbon\Carbon) {
                    $expiresTimestamp = $announcement->expires_at->timestamp;
                } else {
                    $expiresTimestamp = strtotime($announcement->expires_at);
                }
                // Must be strictly greater than now (expires timestamp > now timestamp)
                return $expiresTimestamp > $nowTimestamp;
            })
            : collect([]);
            
        $notificationAnnouncements = $activeAnnouncements->count() > 0
            ? $activeAnnouncements->take(3)->map(function($announcement) {
                return (object)[
                    'id' => $announcement->id,
                    'title' => $announcement->badge ?? 'NEW',
                    'message' => $announcement->message ?? $announcement->description ?? $announcement->title ?? '',
                    'link' => $announcement->link ?? route('announcements'),
                    'link_text' => 'Learn More',
                    'type' => 'info'
                ];
            })->toArray()
            : [];
        $hasAnnouncements = count($notificationAnnouncements) > 0;
    @endphp
    
    @if($hasAnnouncements)
    <section id="notification-bar" class="relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-top: 1px solid rgba(124,199,255,.1);">
        <!-- Subtle star particles background -->
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="notification-container relative" style="min-height: 60px;">
                @foreach($notificationAnnouncements as $index => $announcement)
                    <div class="notification-item {{ $index === 0 ? 'active' : '' }}" 
                         data-announcement-id="{{ $announcement->id }}"
                         @if($index === 0) style="display: flex;" @else style="display: none;" @endif>
                        <!-- Left side: Badge + Message -->
                        <div class="flex items-center gap-4 flex-1">
                            <span class="notification-badge px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider" 
                                  style="background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%); border: 1px solid rgba(34,197,94,0.5); color: #22C55E; box-shadow: 0 0 15px rgba(34,197,94,0.3);">
                                ✨ {{ $announcement->title }}
                            </span>
                            <p class="notification-message text-white text-sm md:text-base flex-1" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                {{ $announcement->message }}
                            </p>
                        </div>
                        
                        <!-- Right side: CTA + Close -->
                        <div class="flex items-center gap-3">
                            @if(isset($announcement->link) && isset($announcement->link_text))
                                <a href="{{ $announcement->link }}" 
                                   class="notification-cta px-4 py-2 rounded-full text-sm font-semibold text-white transition-all duration-300 hover:scale-105"
                                   style="background: linear-gradient(135deg, rgba(124,199,255,0.2) 0%, rgba(124,199,255,0.1) 100%); border: 1px solid rgba(124,199,255,0.4); box-shadow: 0 0 10px rgba(124,199,255,0.2);">
                                    {{ $announcement->link_text }} →
                                </a>
                            @endif
                            <button class="notification-close p-2 rounded-full hover:bg-white/10 transition-colors duration-200" 
                                    data-dismiss-id="{{ $announcement->id }}"
                                    aria-label="Close notification">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
                
                <!-- Indicators (if multiple announcements) -->
                @if(count($notificationAnnouncements) > 1)
                    <div class="notification-indicators flex justify-center gap-2 pb-3">
                        @foreach($notificationAnnouncements as $index => $announcement)
                            <button class="indicator-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'active' : '' }}" 
                                    data-slide-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .notification-item {
            transition: opacity 0.5s ease-in-out;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            gap: 16px;
            animation: slideDown 0.5s ease-out;
        }
        
        .notification-item.active {
            display: flex !important;
        }
        
        .indicator-dot {
            background: rgba(124,199,255,0.3);
        }
        
        .indicator-dot.active {
            background: rgba(124,199,255,0.8);
            box-shadow: 0 0 8px rgba(124,199,255,0.6);
        }
        
        .notification-close:hover {
            background: rgba(255,255,255,0.15);
        }
        
        .indicator-dot.active {
            transform: scale(1.3);
        }
        
        .notification-cta:hover {
            background: linear-gradient(135deg, rgba(124,199,255,0.35) 0%, rgba(124,199,255,0.25) 100%) !important;
            border-color: rgba(124,199,255,0.6) !important;
            box-shadow: 0 0 15px rgba(124,199,255,0.4) !important;
        }
        
        @media (max-width: 768px) {
            .notification-item {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px !important;
            }
            
            .notification-message {
                font-size: 0.875rem;
            }
            
            .notification-cta {
                font-size: 0.75rem;
                padding: 8px 16px;
            }
        }
    </style>
    
    <script>
        (function() {
            const notificationBar = document.getElementById('notification-bar');
            if (!notificationBar) return;
            
            const items = notificationBar.querySelectorAll('.notification-item');
            const indicators = notificationBar.querySelectorAll('.indicator-dot');
            const dismissButtons = notificationBar.querySelectorAll('.notification-close');
            const dismissedKey = 'kayiseit_dismissed_announcements';
            
            let currentIndex = 0;
            let autoRotateInterval = null;
            let dismissedIds = JSON.parse(localStorage.getItem(dismissedKey) || '[]');
            
            // Hide dismissed announcements
            items.forEach(item => {
                const id = item.getAttribute('data-announcement-id');
                if (dismissedIds.includes(id)) {
                    item.style.display = 'none';
                }
            });
            
            // Check if all announcements are dismissed
            const visibleItems = Array.from(items).filter(item => 
                item.style.display !== 'none' && !dismissedIds.includes(item.getAttribute('data-announcement-id'))
            );
            
            if (visibleItems.length === 0) {
                notificationBar.style.display = 'none';
                return;
            }
            
            // Update current index to first visible
            items.forEach((item, index) => {
                if (item.classList.contains('active') && !dismissedIds.includes(item.getAttribute('data-announcement-id'))) {
                    currentIndex = index;
                }
            });
            
            function showNotification(index) {
                const visibleItems = Array.from(items).filter(item => 
                    !dismissedIds.includes(item.getAttribute('data-announcement-id'))
                );
                
                if (visibleItems.length === 0) {
                    notificationBar.style.display = 'none';
                    return;
                }
                
                // Hide all items
                items.forEach((item, i) => {
                    if (!dismissedIds.includes(item.getAttribute('data-announcement-id'))) {
                        item.classList.remove('active');
                        item.style.display = 'none';
                    }
                });
                
                // Show current item
                if (items[index] && !dismissedIds.includes(items[index].getAttribute('data-announcement-id'))) {
                    items[index].classList.add('active');
                    items[index].style.display = 'flex';
                } else {
                    // Find next visible item
                    const nextVisible = visibleItems[0];
                    const nextIndex = Array.from(items).indexOf(nextVisible);
                    if (nextVisible) {
                        nextVisible.classList.add('active');
                        nextVisible.style.display = 'flex';
                        currentIndex = nextIndex;
                    }
                }
                
                // Update indicators
                indicators.forEach((indicator, i) => {
                    indicator.classList.toggle('active', i === index);
                    indicator.style.background = i === index ? 'rgba(124,199,255,0.8)' : 'rgba(124,199,255,0.3)';
                    indicator.style.boxShadow = i === index ? '0 0 8px rgba(124,199,255,0.6)' : 'none';
                });
            }
            
            function nextNotification() {
                const visibleItems = Array.from(items).filter((item, i) => 
                    !dismissedIds.includes(item.getAttribute('data-announcement-id'))
                );
                
                if (visibleItems.length <= 1) return;
                
                currentIndex = (currentIndex + 1) % items.length;
                
                // Skip dismissed items
                while (dismissedIds.includes(items[currentIndex].getAttribute('data-announcement-id'))) {
                    currentIndex = (currentIndex + 1) % items.length;
                }
                
                showNotification(currentIndex);
            }
            
            // Auto-rotate every 6 seconds if multiple announcements
            if (visibleItems.length > 1) {
                autoRotateInterval = setInterval(nextNotification, 6000);
            }
            
            // Indicator clicks
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    if (autoRotateInterval) {
                        clearInterval(autoRotateInterval);
                    }
                    currentIndex = index;
                    showNotification(index);
                    
                    // Restart auto-rotate after manual selection
                    if (visibleItems.length > 1) {
                        autoRotateInterval = setInterval(nextNotification, 6000);
                    }
                });
            });
            
            // Dismiss functionality
            dismissButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-dismiss-id');
                    dismissedIds.push(id);
                    localStorage.setItem(dismissedKey, JSON.stringify(dismissedIds));
                    
                    const item = button.closest('.notification-item');
                    item.style.display = 'none';
                    item.classList.remove('active');
                    
                    // Check if all dismissed
                    const remainingVisible = Array.from(items).filter(item => 
                        item.style.display !== 'none' && !dismissedIds.includes(item.getAttribute('data-announcement-id'))
                    );
                    
                    if (remainingVisible.length === 0) {
                        notificationBar.style.display = 'none';
                        if (autoRotateInterval) {
                            clearInterval(autoRotateInterval);
                        }
                    } else {
                        // Show next visible notification
                        const nextVisible = remainingVisible[0];
                        const nextIndex = Array.from(items).indexOf(nextVisible);
                        showNotification(nextIndex);
                    }
                });
            });
            
            // Pause auto-rotate on hover
            notificationBar.addEventListener('mouseenter', () => {
                if (autoRotateInterval) {
                    clearInterval(autoRotateInterval);
                }
            });
            
            notificationBar.addEventListener('mouseleave', () => {
                const visibleItems = Array.from(items).filter((item, i) => 
                    !dismissedIds.includes(item.getAttribute('data-announcement-id'))
                );
                if (visibleItems.length > 1) {
                    autoRotateInterval = setInterval(nextNotification, 6000);
                }
            });
        })();
    </script>
    @endif

    <!-- Announcements Section - Only show if there are active announcements -->
    @if(isset($announcements) && $announcements->count() > 0)
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Latest Updates</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Announcements</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Stay updated with our latest news, programs, and opportunities</p>
            </div>
            <x-announcements :announcements="$announcements"></x-announcements>
            <div class="text-center mt-12">
                <a href="{{ route('announcements') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-semibold">
                    <span>View All Announcements</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
    
    <!-- TRUSTED BY: Client Logos -->
    <section class="bg-white py-20 border-y border-gray-200">
        <div class="container mx-auto px-4 max-w-7xl">
            <p class="text-center text-sm uppercase tracking-wider text-gray-500 mb-8">Trusted by Leading Organizations</p>
            <x-partners></x-partners>
        </div>
    </section>
     
    <!-- CORE SERVICES GRID -->
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Our Services</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Specialized IT Solutions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Enterprise-grade technology services designed to accelerate your digital transformation</p>
            </div>
            
            <!-- Service Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <div class="bg-white rounded-lg shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center mb-6" style="background-color: rgba(34, 197, 94, 0.10);">
                        <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Software Development</h3>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Enterprise Applications</li>
                        <li>• Custom Business Logic</li>
                        <li>• API Development</li>
                        <li>• Integration Solutions</li>
                    </ul>
                </div>

                <div class="bg-white rounded-lg shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center mb-6" style="background-color: rgba(34, 197, 94, 0.10);">
                        <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.265.633l-4-12a1 1 0 011.265-.633L8 10l4.316-10.949z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Web Development</h3>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Progressive Web Apps</li>
                        <li>• E-Commerce Platforms</li>
                        <li>• Corporate Websites</li>
                        <li>• Mobile-First Design</li>
                    </ul>
                </div>

                <div class="bg-white rounded-lg shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center mb-6" style="background-color: rgba(34, 197, 94, 0.10);">
                        <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">IT Consulting</h3>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Technology Strategy</li>
                        <li>• Process Optimization</li>
                        <li>• Digital Transformation</li>
                        <li>• Infrastructure Planning</li>
                    </ul>
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                    View All Services
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CLIENT CASE STUDIES: Problems We've Solved -->
    @php
        $caseStudies = App\Models\CaseStudy::with('galleryImages')
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
    @endphp
    @if($caseStudies->count() > 0)
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Section Header with CTA -->
            <div class="text-center mb-10">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Case Studies</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Problems We've Solved</h2>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                        Share Your Challenge
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-full font-semibold transition-all duration-300 border-2 hover:shadow-lg" style="color: #22C55E; border-color: #22C55E;">
                        View Our Services
                    </a>
                </div>
            </div>

            <!-- Case Studies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($caseStudies as $caseStudy)
                <!-- Case Study Card -->
                <div class="bg-white rounded-lg border-2 border-gray-200 overflow-hidden hover:border-green-400 hover:shadow-xl transition-all duration-300 cursor-pointer case-study-card group" 
                     data-case-study-id="{{ $caseStudy->id }}"
                     data-case-study-title="{{ $caseStudy->title }}"
                     data-case-study-image="{{ $caseStudy->image ?? '' }}"
                     data-case-study-year="{{ $caseStudy->year ?? '' }}"
                     data-case-study-client="{{ $caseStudy->client_name ?? '' }}"
                     data-case-study-problem="{{ $caseStudy->problem }}"
                     data-case-study-solution="{{ $caseStudy->solution }}"
                     data-case-study-results="{{ $caseStudy->results ?? '' }}"
                     data-case-study-results-list="{{ json_encode($caseStudy->results_list ?? []) }}"
                     data-case-study-hyperlink="{{ $caseStudy->hyperlink ?? '' }}"
                     data-case-study-featured="{{ $caseStudy->is_featured ? '1' : '0' }}"
                     data-case-study-has-gallery="{{ $caseStudy->has_gallery ? '1' : '0' }}"
                     data-case-study-gallery-images="{{ json_encode($caseStudy->galleryImages->map(function($img) { return $img->image_path; })->toArray() ?? []) }}">
                    @if($caseStudy->image)
                        <div class="relative h-48 w-full overflow-hidden">
                            <img src="{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute top-0 left-0 right-0 p-4 flex items-center justify-between">
                                @if($caseStudy->is_featured)
                                    <span class="px-2 py-1 rounded text-xs font-medium text-white shadow-md" style="background-color: #22C55E;">Featured</span>
                                @else
                                    <span></span>
                                @endif
                                @if($caseStudy->year)
                                    <span class="px-2 py-1 rounded text-xs font-medium text-white bg-black bg-opacity-50 backdrop-blur-sm">{{ $caseStudy->year }}</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="h-48 w-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative">
                            <div class="absolute top-0 left-0 right-0 p-4 flex items-center justify-between">
                                @if($caseStudy->is_featured)
                                    <span class="px-2 py-1 rounded text-xs font-medium text-white shadow-md" style="background-color: #22C55E;">Featured</span>
                                @else
                                    <span></span>
                                @endif
                                @if($caseStudy->year)
                                    <span class="px-2 py-1 rounded text-xs font-medium text-gray-700 bg-white bg-opacity-80">{{ $caseStudy->year }}</span>
                                @endif
                            </div>
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1 line-clamp-2">{{ $caseStudy->title }}</h3>
                        @if($caseStudy->client_name)
                            <p class="text-xs text-gray-500 mb-3">{{ $caseStudy->client_name }}</p>
                        @endif
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2 font-medium">{{ Str::limit($caseStudy->problem, 80) }}</p>
                        <button class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold text-white transition-all duration-300 hover:shadow-lg group-hover:scale-105" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                            View Solution →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Section Break with CTA -->
            <div class="border-t border-gray-200 pt-12 mt-12">
                <div class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-2xl p-10 text-center overflow-hidden" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-green-200 rounded-full -mr-32 -mt-32 opacity-10"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-teal-200 rounded-full -ml-24 -mb-24 opacity-10"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Have a Challenge We Can Solve?</h3>
                        <p class="text-lg text-gray-700 mb-8 max-w-2xl mx-auto font-medium">Let's discuss how we can help your business overcome obstacles and achieve success.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-10 py-4 rounded-full text-white font-semibold text-base transition-all duration-300 hover:shadow-2xl hover:scale-105 transform" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%); box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.3), 0 4px 6px -2px rgba(34, 197, 94, 0.2);">
                                Get Free Consultation
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="tel:+27123456789" class="inline-flex items-center justify-center px-10 py-4 rounded-full font-semibold text-base transition-all duration-300 hover:shadow-xl hover:scale-105 transform bg-white border-2" style="color: #22C55E; border-color: #22C55E; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                Call Us Now
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- IN-HOUSE SOFTWARE PRODUCTS -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mb-3" style="color:#22C55E;border:1px solid rgba(34, 197, 94, 0.2);background-color: rgba(34, 197, 94, 0.08);">Our Products</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-3">In-House Developed Software</h2>
                <p class="text-base text-gray-600 max-w-2xl mx-auto">Powerful, reliable software solutions built by our team to streamline your business operations</p>
            </div>
            
            <!-- Software Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-12">
                @forelse($products as $product)
                    @php
                        $iconColors = [
                            'green' => 'rgba(34, 197, 94, 0.1)',
                            'blue' => 'rgba(59, 130, 246, 0.1)',
                            'purple' => 'rgba(147, 51, 234, 0.1)',
                            'indigo' => 'rgba(99, 102, 241, 0.1)',
                            'teal' => 'rgba(20, 184, 166, 0.1)',
                        ];
                        $iconColor = $iconColors[$product->icon_color] ?? $iconColors['green'];
                        $badgeText = $product->status === 'available'
                            ? ($product->slug === 'kit-accounting' ? 'Featured' : 'New')
                            : 'Coming Soon';
                        $badgeClass = $product->status === 'available'
                            ? 'text-white'
                            : 'text-gray-600 bg-gray-100';
                        $badgeBg = $product->status === 'available' ? '#22C55E' : '';
                    @endphp
                    <div class="bg-white rounded-lg border border-gray-200 p-5 hover:border-gray-300 hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: {{ $iconColor }};">
                                @if($product->slug === 'kit-accounting')
                                    <svg class="w-5 h-5" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @elseif($product->slug === 'qr-code-generator')
                                    <svg class="w-5 h-5" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                @elseif($product->slug === 'asset-management')
                                    <svg class="w-5 h-5" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                @elseif($product->slug === 'project-management')
                                    <svg class="w-5 h-5" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                @elseif($product->slug === 'document-management')
                                    <svg class="w-5 h-5" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                @endif
                            </div>
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $badgeClass }}" style="{{ $badgeBg ? 'background-color: ' . $badgeBg . ';' : '' }}">{{ $badgeText }}</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4 leading-snug">
                            {{ $product->description }}
                        </p>
                        @if($product->features && count($product->features) > 0)
                            <ul class="space-y-2 mb-4">
                                @foreach($product->features as $feature)
                                    <li class="flex items-center text-xs text-gray-600">
                                        <svg class="w-3.5 h-3.5 mr-2 flex-shrink-0" style="color:#22C55E;" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="{{ $product->cta_route ? route($product->cta_route) : route('contact') }}" class="inline-flex items-center w-full justify-center px-4 py-2 rounded-md text-sm font-medium text-white transition-colors hover:opacity-90" style="background-color: #22C55E;">
                            {{ $product->cta_text }}
                            <svg class="ml-1.5 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No products are currently visible on the frontend.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8">
                <p class="text-base text-gray-600 mb-4">Interested in our software solutions?</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-2.5 rounded-md text-sm font-medium text-white transition-colors hover:opacity-90" style="background-color: #22C55E;">
                    Contact Us for More Information
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Case Study Modal -->
    <div id="caseStudyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeCaseStudyModal()"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white">
                    <!-- Modal Header with Image -->
                    <div id="modalImageContainer" class="relative h-64 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                        <img id="modalImage" class="w-full h-full object-cover" src="" alt="" style="display: none;">
                        <div id="modalImagePlaceholder" class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 left-0 right-0 p-4 flex items-center justify-between">
                            <span id="modalFeatured" class="px-2 py-1 rounded text-xs font-medium text-white shadow-md" style="background-color: #22C55E; display: none;">Featured</span>
                            <span id="modalYear" class="px-2 py-1 rounded text-xs font-medium text-white bg-black bg-opacity-50 backdrop-blur-sm" style="display: none;"></span>
                        </div>
                        <button onclick="closeCaseStudyModal()" class="absolute top-4 right-4 w-8 h-8 bg-white bg-opacity-90 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all z-10">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="px-6 py-6 max-h-[60vh] overflow-y-auto">
                        <h3 id="modalTitle" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                        <p id="modalClient" class="text-sm text-gray-500 mb-6"></p>

                        <div class="space-y-6">
                            <!-- The Problem -->
                            <div>
                                <div class="flex items-start mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0" style="background-color: rgba(239, 68, 68, 0.1);">
                                        <svg class="w-4 h-4" style="color:#EF4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-semibold text-gray-900 mb-2">The Problem</h4>
                                        <p id="modalProblem" class="text-sm text-gray-600 leading-relaxed"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- How KAYISE IT Solved It -->
                            <div>
                                <div class="flex items-start mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0" style="background-color: rgba(34, 197, 94, 0.1);">
                                        <svg class="w-4 h-4" style="color:#22C55E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-semibold text-gray-900 mb-2">How KAYISE IT Solved It</h4>
                                        <p id="modalSolution" class="text-sm text-gray-600 leading-relaxed"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- The Results -->
                            <div>
                                <div class="flex items-start mb-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0" style="background-color: rgba(59, 130, 246, 0.1);">
                                        <svg class="w-4 h-4" style="color:#3B82F6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-semibold text-gray-900 mb-2">The Results</h4>
                                        <div id="modalResults" class="space-y-2">
                                            <p id="modalResultsText" class="text-sm text-gray-600 leading-relaxed"></p>
                                            <ul id="modalResultsList" class="text-sm text-gray-600 space-y-1 ml-4"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery Section -->
                            <div id="modalGallerySection" style="display: none;">
                                <div class="border-t border-gray-200 pt-6 mt-6">
                                    <h4 class="text-base font-semibold text-gray-900 mb-4">Project Gallery</h4>
                                    <div id="modalGalleryGrid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        <!-- Gallery images will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                        <div></div>
                        <div class="flex space-x-3">
                            <button onclick="closeCaseStudyModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                Close
                            </button>
                            <a id="modalHyperlink" href="#" target="_blank" rel="noopener noreferrer" 
                               class="px-4 py-2 text-sm font-medium text-white rounded-md transition-colors hover:opacity-90 inline-flex items-center"
                               style="background-color: #22C55E; display: none;">
                                Visit Project
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Case Study Modal Functions
        function openCaseStudyModal(card) {
            const modal = document.getElementById('caseStudyModal');
            const data = {
                title: card.dataset.caseStudyTitle,
                image: card.dataset.caseStudyImage,
                year: card.dataset.caseStudyYear,
                client: card.dataset.caseStudyClient,
                problem: card.dataset.caseStudyProblem,
                solution: card.dataset.caseStudySolution,
                results: card.dataset.caseStudyResults,
                resultsList: JSON.parse(card.dataset.caseStudyResultsList || '[]'),
                hyperlink: card.dataset.caseStudyHyperlink,
                featured: card.dataset.caseStudyFeatured === '1',
                hasGallery: card.dataset.caseStudyHasGallery === '1',
                galleryImages: JSON.parse(card.dataset.caseStudyGalleryImages || '[]')
            };

            // Set modal content
            document.getElementById('modalTitle').textContent = data.title;
            document.getElementById('modalClient').textContent = data.client || '';
            document.getElementById('modalProblem').textContent = data.problem;
            document.getElementById('modalSolution').textContent = data.solution;
            document.getElementById('modalResultsText').textContent = data.results || '';
            
            // Handle image
            const modalImage = document.getElementById('modalImage');
            const modalImagePlaceholder = document.getElementById('modalImagePlaceholder');
            if (data.image) {
                modalImage.src = data.image;
                modalImage.alt = data.title;
                modalImage.style.display = 'block';
                modalImagePlaceholder.style.display = 'none';
            } else {
                modalImage.style.display = 'none';
                modalImagePlaceholder.style.display = 'flex';
            }

            // Handle year
            const yearSpan = document.getElementById('modalYear');
            if (data.year) {
                yearSpan.textContent = data.year;
                yearSpan.style.display = 'block';
            } else {
                yearSpan.style.display = 'none';
            }

            // Handle featured badge
            const featuredSpan = document.getElementById('modalFeatured');
            if (data.featured) {
                featuredSpan.style.display = 'block';
            } else {
                featuredSpan.style.display = 'none';
            }

            // Handle results list
            const resultsList = document.getElementById('modalResultsList');
            resultsList.innerHTML = '';
            if (data.resultsList && data.resultsList.length > 0) {
                data.resultsList.forEach(result => {
                    const li = document.createElement('li');
                    li.className = 'flex items-center';
                    li.innerHTML = `
                        <span class="w-1.5 h-1.5 rounded-full mr-2" style="background-color: #22C55E;"></span>
                        <span>${result.text || ''}</span>
                    `;
                    resultsList.appendChild(li);
                });
            }

            // Handle hyperlink
            const hyperlinkBtn = document.getElementById('modalHyperlink');
            if (data.hyperlink) {
                hyperlinkBtn.href = data.hyperlink;
                hyperlinkBtn.style.display = 'inline-flex';
            } else {
                hyperlinkBtn.style.display = 'none';
            }

            // Handle gallery
            const gallerySection = document.getElementById('modalGallerySection');
            const galleryGrid = document.getElementById('modalGalleryGrid');
            if (data.hasGallery && data.galleryImages && data.galleryImages.length > 0) {
                gallerySection.style.display = 'block';
                galleryGrid.innerHTML = '';
                data.galleryImages.forEach((imgPath, index) => {
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'relative group cursor-pointer';
                    imgDiv.onclick = () => openGalleryLightbox(index, data.galleryImages);
                    imgDiv.innerHTML = `
                        <img src="${imgPath}" alt="Gallery image ${index + 1}" class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:shadow-lg transition-all">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all flex items-center justify-center">
                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                            </svg>
                        </div>
                    `;
                    galleryGrid.appendChild(imgDiv);
                });
            } else {
                gallerySection.style.display = 'none';
            }

            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Gallery Lightbox
        function openGalleryLightbox(index, images) {
            // Create lightbox if it doesn't exist
            let lightbox = document.getElementById('galleryLightbox');
            if (!lightbox) {
                lightbox = document.createElement('div');
                lightbox.id = 'galleryLightbox';
                lightbox.className = 'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center';
                lightbox.innerHTML = `
                    <button onclick="closeGalleryLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <button onclick="prevGalleryImage()" class="absolute left-4 text-white hover:text-gray-300 z-10">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button onclick="nextGalleryImage()" class="absolute right-4 text-white hover:text-gray-300 z-10">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <img id="lightboxImage" class="max-w-7xl max-h-screen object-contain" src="" alt="Gallery image">
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm">
                        <span id="lightboxImageCounter"></span>
                    </div>
                `;
                document.body.appendChild(lightbox);
            }

            window.currentGalleryImages = images;
            window.currentGalleryIndex = index;
            updateLightboxImage();
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeGalleryLightbox() {
            const lightbox = document.getElementById('galleryLightbox');
            if (lightbox) {
                lightbox.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        function updateLightboxImage() {
            const img = document.getElementById('lightboxImage');
            const counter = document.getElementById('lightboxImageCounter');
            if (window.currentGalleryImages && window.currentGalleryImages.length > 0) {
                img.src = window.currentGalleryImages[window.currentGalleryIndex];
                counter.textContent = `${window.currentGalleryIndex + 1} / ${window.currentGalleryImages.length}`;
            }
        }

        function nextGalleryImage() {
            if (window.currentGalleryImages && window.currentGalleryImages.length > 0) {
                window.currentGalleryIndex = (window.currentGalleryIndex + 1) % window.currentGalleryImages.length;
                updateLightboxImage();
            }
        }

        function prevGalleryImage() {
            if (window.currentGalleryImages && window.currentGalleryImages.length > 0) {
                window.currentGalleryIndex = (window.currentGalleryIndex - 1 + window.currentGalleryImages.length) % window.currentGalleryImages.length;
                updateLightboxImage();
            }
        }

        // Keyboard navigation for gallery
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('galleryLightbox');
            if (lightbox && lightbox.style.display === 'flex') {
                if (e.key === 'ArrowRight') nextGalleryImage();
                if (e.key === 'ArrowLeft') prevGalleryImage();
                if (e.key === 'Escape') closeGalleryLightbox();
            }
        });

        function closeCaseStudyModal() {
            const modal = document.getElementById('caseStudyModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Add click handlers to all case study cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.case-study-card');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't open modal if clicking on hyperlink
                    if (e.target.closest('a')) {
                        return;
                    }
                    openCaseStudyModal(this);
                });
            });

            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeCaseStudyModal();
                }
            });
        });
    </script>

    <!-- WHY CHOOSE KAYISE IT: Value Proposition -->
    <section class="bg-white py-20 relative overflow-hidden">
        <canvas id="why-rings-bg" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>
        <div class="container mx-auto px-4 max-w-7xl relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Why Choose Us</span>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Delivering Measurable Business Impact</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Our proven methodology combines technical excellence with business insight to drive real results
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0" style="background-color: rgba(34, 197, 94, 0.10);">
                                <svg class="w-5 h-5" style="color:#22C55E;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Proven Expertise</h3>
                                <p class="text-gray-600">10+ years delivering enterprise solutions across industries</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0" style="background-color: rgba(34, 197, 94, 0.10);">
                                <svg class="w-5 h-5" style="color:#22C55E;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Scalable Solutions</h3>
                                <p class="text-gray-600">Future-proof architectures that grow with your business</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0" style="background-color: rgba(34, 197, 94, 0.10);">
                                <svg class="w-5 h-5" style="color:#22C55E;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                                <p class="text-gray-600">Dedicated team ensuring your systems run smoothly</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/10">
                    <img src="{{ asset('images/KayiseIT-Team.jpg') }}" alt="Kayise IT team" class="absolute inset-0 w-full h-full object-cover" style="filter: brightness(1.06) contrast(1.08);" loading="lazy">
                    <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(2,6,23,.40) 0%, rgba(2,6,23,.55) 100%);"></div>
                    <canvas id="why-hypno" class="w-full" style="display:block; height: 28rem;"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- TECH STACK: Technologies We Master -->
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Our Tech Stack</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Technologies We Master</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Leveraging cutting-edge tools and frameworks to build robust solutions</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#22C55E"><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.565-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">HTML5</p>
                </div>
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#1572B6"><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm17.09 4.413L5.41 4.41l.213 2.622 10.125.002-.255 2.716h-6.64l.24 2.573h6.182l-.366 3.523-2.91.804-2.956-.81-.188-2.11h-2.61l.29 3.855L12 19.288l5.373-1.53L18.59 4.414z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">CSS3</p>
        </div>
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#F7DF1E"><path d="M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.205.24 1.17-.87 1.545-1.966 1.41-.811-.18-1.26-.586-1.755-1.336l-1.83 1.051c.21.48.45.689.81 1.109 1.74 1.756 6.09 1.666 6.871-1.004.029-.09.24-.705.074-1.65l.046.067zm-8.983-7.245h-2.248c0 1.938-.009 3.864-.009 5.805 0 1.232.063 2.363-.138 2.711-.33.689-1.18.601-1.566.48-.396-.196-.597-.466-.83-.855-.063-.105-.11-.196-.127-.196l-1.825 1.125c.305.63.75 1.172 1.324 1.517.855.51 2.004.675 3.207.405.783-.226 1.458-.691 1.811-1.411.51-.93.402-2.07.397-3.346.012-2.054 0-4.109 0-6.179l.004-.056z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">JavaScript</p>
            </div>
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#777BB4"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm.141 19.031c-.771 0-1.402-.63-1.402-1.402s.631-1.402 1.402-1.402c.771 0 1.402.63 1.402 1.402s-.631 1.402-1.402 1.402zm3.91-8.773c-.38.479-.968.835-1.762 1.068v.028c0 .074-.06.134-.134.134h-1.186a.134.134 0 0 1-.134-.134v-.137c0-1.051.509-1.568 1.523-1.551 1.027.017 1.448-.497 1.265-1.539-.184-1.042-1.266-1.042-2.298-1.042-.781 0-1.416.06-1.902.18v4.872c0 .074-.06.134-.134.134H9.102a.134.134 0 0 1-.134-.134V7.723c0-.062.042-.116.102-.13 1.267-.296 2.724-.436 4.371-.421 2.147.02 3.707.757 4.032 2.406.301 1.528-.394 2.712-1.422 3.68z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">PHP</p>
                </div>
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#FF2D20"><path d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.027c-.008.002-.016.008-.024.01a.348.348 0 01-.192 0c-.011-.002-.02-.008-.03-.012-.02-.008-.042-.014-.062-.025L.533 18.755a.376.376 0 01-.189-.326V2.974c0-.033.005-.066.014-.098.003-.012.01-.02.014-.032a.369.369 0 01.023-.058c.004-.013.015-.022.023-.033l.033-.045c.012-.01.025-.018.037-.027.014-.012.027-.024.041-.034H.53L5.043.05a.375.375 0 01.375 0l4.513 2.6h.001c.016.01.03.021.044.033.012.009.025.018.037.027.013.014.024.028.033.045.008.011.02.021.025.033.01.02.017.038.024.058.003.011.01.021.013.032.01.031.014.064.014.098v9.652l3.76-2.164V5.527c0-.033.004-.066.013-.098.003-.01.01-.02.013-.032a.487.487 0 01.024-.059c.007-.012.018-.02.025-.033.012-.015.021-.03.033-.043.012-.012.025-.02.037-.028.014-.01.026-.023.041-.032h.001l4.513-2.598a.375.375 0 01.375 0l4.513 2.598c.016.01.031.022.046.032.011.009.024.018.036.028.013.014.024.028.034.044.008.012.019.021.024.033.011.02.018.04.024.06.006.01.012.021.015.032zm-.74 5.032V6.179l-1.578.908-2.182 1.256v4.283zm-4.51 7.75v-4.287l-2.147 1.225-6.126 3.498v4.325zM1.093 3.624v14.588l8.273 4.761v-4.325l-4.322-2.445-.002-.003H5.04c-.014-.01-.025-.021-.04-.031-.011-.01-.024-.018-.035-.027l-.001-.002c-.013-.012-.021-.025-.031-.039-.01-.012-.021-.023-.028-.037h-.002c-.008-.014-.013-.031-.02-.047-.006-.016-.014-.027-.018-.043a.49.49 0 01-.008-.057c-.002-.014-.006-.027-.006-.041V5.789l-2.18-1.257zM5.23.81L1.47 2.974l3.76 2.164 3.758-2.164zm1.956 13.505l2.182-1.256V3.624l-1.58.91-2.182 1.255v9.435zm11.581-10.95l-3.76 2.163 3.76 2.163 3.759-2.164zm-.376 4.978L16.21 7.087 14.63 6.18v4.283l2.182 1.256 1.58.908zm-8.65 9.654l5.514-3.148 2.756-1.572-3.757-2.163-4.323 2.489-3.941 2.27z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">Laravel</p>
                </div>
                <div class="flex flex-col items-center justify-center p-6 bg-white rounded-xl hover:shadow-lg transition-shadow">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#06B6D4"><path d="M12.001,4.8c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 C13.666,10.618,15.027,12,18.001,12c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C16.337,6.182,14.976,4.8,12.001,4.8z M6.001,12c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 c1.177,1.194,2.538,2.576,5.512,2.576c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C10.337,13.382,8.976,12,6.001,12z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">Tailwind</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PLACEMENTS & INTERNSHIPS: Human impact -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34,197,94,.10);">Placements & Internships</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">TVET Placements We're Proud Of</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">A snapshot of our recent TVET placements and internship cohorts across South Africa</p>
            </div>
            @if(!empty($featuredGalleryPhotos) && count($featuredGalleryPhotos) > 0)
            @php
                $galleryWithUrls = array_map(fn($p) => array_merge($p, ['url' => asset($p['path'] ?? '')]), $featuredGalleryPhotos);
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6" x-data="{ 
                images: @js($galleryWithUrls),
                lightbox: false,
                selectedIndex: 0,
                openLightbox(index) {
                    this.selectedIndex = index;
                    this.lightbox = true;
                },
                nextImage() {
                    this.selectedIndex = (this.selectedIndex + 1) % this.images.length;
                },
                prevImage() {
                    this.selectedIndex = (this.selectedIndex - 1 + this.images.length) % this.images.length;
                }
            }">
                @foreach($featuredGalleryPhotos as $index => $photo)
                <div 
                    class="relative group cursor-pointer overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    @click="openLightbox({{ $index }})"
                    style="animation: fadeInUp 0.5s ease-out {{ $index * 0.1 }}s both;"
                >
                    <img 
                        src="{{ asset($photo['path']) }}" 
                        alt="Gallery Image {{ $index + 1 }}" 
                        class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-125"
                        loading="lazy"
                        onerror="this.onerror=null; this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-48 bg-gray-200 flex items-center justify-center rounded-xl\'><svg class=\'w-12 h-12 text-gray-400\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'></path></svg></div>'"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                        <svg class="w-8 h-8 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
            </div>
                </div>
                @endforeach
                
                <!-- Lightbox -->
                <div 
                    x-show="lightbox"
                    x-transition:enter="transition-opacity duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
                    @click.self="lightbox = false"
                    @keydown.escape.window="lightbox = false"
                >
                    <div class="relative max-w-6xl max-h-full">
                        <button 
                            @click="lightbox = false"
                            class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <button 
                            x-show="images.length > 1"
                            @click.stop="prevImage()"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        
                        <button 
                            x-show="images.length > 1"
                            @click.stop="nextImage()"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full p-3 hover:bg-opacity-75 transition-all duration-300 transform hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        
                        <img 
                            x-bind:src="images[selectedIndex] ? images[selectedIndex].url : ''"
                            alt="Gallery Image"
                            class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl"
                            x-transition:enter="transition-all duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                        >
                        
                        <div 
                            x-show="images.length > 1"
                            class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm"
                        >
                            <span x-text="selectedIndex + 1"></span> / <span x-text="images.length"></span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-600 mb-2">No featured gallery selected</p>
                <p class="text-sm text-gray-500">Please select a gallery in the admin dashboard to display here</p>
            </div>
            @endif
            <div class="mt-8 text-center">
                <a href="{{ route('gallery') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">View Gallery</a>
            </div>
        </div>
    </section>
    
    <style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>



    <!-- Contact info is now integrated into the footer -->
</x-app-layout>