<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "KAYISE IT - Specialized Software Development & IT Consulting";
    $metaDescription = "Professional software development, web development, and IT consulting services. Custom solutions for enterprise modernization and digital transformation.";
    $metaKeywords = "Software Development, Web Development, IT Consulting, Enterprise Solutions, Software Engineering, Digital Transformation, Business Automation, IT Services, South Africa, Professional Development";
    @endphp
    @endsection
    
    @include('_carousel')

    <script>
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
                        bctx.fillStyle = '#ffffff'; bctx.fillRect(0,0,bw,bh);
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
                    ctx.fillStyle = '#020617'; ctx.fillRect(0,0,w,h);
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
    <section id="notification-bar" class="relative overflow-hidden" style="background: #183ea4; border-top: 1px solid rgba(255,255,255,.12);">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="notification-container relative" style="min-height: 60px;">
                @foreach($notificationAnnouncements as $index => $announcement)
                    <div class="notification-item {{ $index === 0 ? 'active' : '' }}" 
                         data-announcement-id="{{ $announcement->id }}"
                         @if($index === 0) style="display: flex;" @else style="display: none;" @endif>
                        <!-- Left side: Badge + Message -->
                        <div class="flex items-center gap-4 flex-1">
                            <span class="notification-badge px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider" 
                                  style="background: #16A34A; border: 1px solid #16A34A; color: #fff;">
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
                                   style="background: #fff; border: 1px solid #fff; color: #183ea4;">
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
            background: #f0f4ff !important;
            border-color: #183ea4 !important;
            color: #183ea4 !important;
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
                <span class="ki-kicker">What we do</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Software, web, and IT support from Nelspruit</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Custom systems, websites, and consulting for schools, TVET colleges, government programmes, and private organisations.</p>
            </div>
            
            @php
                $homeServices = [
                    ['index' => '01', 'title' => 'Software Development', 'items' => ['Enterprise applications', 'Custom business logic', 'API development', 'System integrations']],
                    ['index' => '02', 'title' => 'Web Development', 'items' => ['Institutional and business websites', 'E-commerce platforms', 'Progressive web apps', 'Mobile-first design']],
                    ['index' => '03', 'title' => 'IT Consulting', 'items' => ['Technology strategy', 'Process optimisation', 'Infrastructure planning', 'Digital programme support']],
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($homeServices as $homeService)
                    <x-ki-feature-card
                        :index="$homeService['index']"
                        :title="$homeService['title']"
                        :items="$homeService['items']"
                        :href="route('services')"
                        link-text="See services" />
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="{{ route('services') }}" class="ki-btn">View all services</a>
            </div>
        </div>
    </section>

    <!-- CLIENT CASE STUDIES -->
    @if(isset($homeCaseStudies) && $homeCaseStudies->count() > 0)
    <section class="bg-white py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <span class="ki-kicker">Proof</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Work we have finished</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Completed projects with the outcomes a buyer can take into a meeting.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($homeCaseStudies as $index => $caseStudy)
                    <x-case-study-card
                        :case-study="$caseStudy"
                        :index="str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)" />
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('case-studies.index') }}" class="ki-btn">View all case studies</a>
            </div>
        </div>
    </section>
    @endif

    <!-- IN-HOUSE SOFTWARE PRODUCTS -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <span class="ki-kicker">Software we build</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-3">In-house products</h2>
                <p class="text-base text-gray-600 max-w-2xl mx-auto">Tools we developed for accounting, assets, documents, and project work — available to clients on request.</p>
            </div>
            
            <!-- Software Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-12">
                @forelse($products as $index => $product)
                    @php
                        $badgeText = $product->status === 'available' ? 'Available' : 'Coming soon';
                    @endphp
                    <article class="ki-card">
                        <div class="ki-card-meta">
                            <span class="ki-card-index" style="margin-bottom:0">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="ki-badge">{{ $badgeText }}</span>
                        </div>
                        <h3 class="ki-card-title">{{ $product->name }}</h3>
                        <p class="ki-card-body">{{ $product->description }}</p>
                        @if($product->features && count($product->features) > 0)
                            <ul class="ki-card-list">
                                @foreach($product->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="{{ $product->cta_route ? route($product->cta_route) : route('contact') }}" class="ki-card-link">
                            {{ $product->cta_text }}
                        </a>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No products are currently visible on the frontend.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8">
                <p class="text-base text-gray-600 mb-4">Interested in our software solutions?</p>
                <a href="{{ route('contact') }}" class="ki-btn">Ask about these products</a>
            </div>
        </div>
    </section>


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
                    <div class="absolute inset-0" style="background: rgba(2,6,23,.5);"></div>
                    <canvas id="why-hypno" class="w-full" style="display:block; height: 28rem;"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- TECH STACK: Technologies We Master -->
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <span class="ki-kicker">How we build</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tools we work with</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">HTML, CSS, JavaScript, PHP, Laravel, and Tailwind — the stack behind most of our websites and applications.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#22C55E"><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.565-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">HTML5</p>
                </div>
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#1572B6"><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm17.09 4.413L5.41 4.41l.213 2.622 10.125.002-.255 2.716h-6.64l.24 2.573h6.182l-.366 3.523-2.91.804-2.956-.81-.188-2.11h-2.61l.29 3.855L12 19.288l5.373-1.53L18.59 4.414z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">CSS3</p>
        </div>
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#F7DF1E"><path d="M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.205.24 1.17-.87 1.545-1.966 1.41-.811-.18-1.26-.586-1.755-1.336l-1.83 1.051c.21.48.45.689.81 1.109 1.74 1.756 6.09 1.666 6.871-1.004.029-.09.24-.705.074-1.65l.046.067zm-8.983-7.245h-2.248c0 1.938-.009 3.864-.009 5.805 0 1.232.063 2.363-.138 2.711-.33.689-1.18.601-1.566.48-.396-.196-.597-.466-.83-.855-.063-.105-.11-.196-.127-.196l-1.825 1.125c.305.63.75 1.172 1.324 1.517.855.51 2.004.675 3.207.405.783-.226 1.458-.691 1.811-1.411.51-.93.402-2.07.397-3.346.012-2.054 0-4.109 0-6.179l.004-.056z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">JavaScript</p>
            </div>
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#777BB4"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm.141 19.031c-.771 0-1.402-.63-1.402-1.402s.631-1.402 1.402-1.402c.771 0 1.402.63 1.402 1.402s-.631 1.402-1.402 1.402zm3.91-8.773c-.38.479-.968.835-1.762 1.068v.028c0 .074-.06.134-.134.134h-1.186a.134.134 0 0 1-.134-.134v-.137c0-1.051.509-1.568 1.523-1.551 1.027.017 1.448-.497 1.265-1.539-.184-1.042-1.266-1.042-2.298-1.042-.781 0-1.416.06-1.902.18v4.872c0 .074-.06.134-.134.134H9.102a.134.134 0 0 1-.134-.134V7.723c0-.062.042-.116.102-.13 1.267-.296 2.724-.436 4.371-.421 2.147.02 3.707.757 4.032 2.406.301 1.528-.394 2.712-1.422 3.68z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">PHP</p>
                </div>
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#FF2D20"><path d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.027c-.008.002-.016.008-.024.01a.348.348 0 01-.192 0c-.011-.002-.02-.008-.03-.012-.02-.008-.042-.014-.062-.025L.533 18.755a.376.376 0 01-.189-.326V2.974c0-.033.005-.066.014-.098.003-.012.01-.02.014-.032a.369.369 0 01.023-.058c.004-.013.015-.022.023-.033l.033-.045c.012-.01.025-.018.037-.027.014-.012.027-.024.041-.034H.53L5.043.05a.375.375 0 01.375 0l4.513 2.6h.001c.016.01.03.021.044.033.012.009.025.018.037.027.013.014.024.028.033.045.008.011.02.021.025.033.01.02.017.038.024.058.003.011.01.021.013.032.01.031.014.064.014.098v9.652l3.76-2.164V5.527c0-.033.004-.066.013-.098.003-.01.01-.02.013-.032a.487.487 0 01.024-.059c.007-.012.018-.02.025-.033.012-.015.021-.03.033-.043.012-.012.025-.02.037-.028.014-.01.026-.023.041-.032h.001l4.513-2.598a.375.375 0 01.375 0l4.513 2.598c.016.01.031.022.046.032.011.009.024.018.036.028.013.014.024.028.034.044.008.012.019.021.024.033.011.02.018.04.024.06.006.01.012.021.015.032zm-.74 5.032V6.179l-1.578.908-2.182 1.256v4.283zm-4.51 7.75v-4.287l-2.147 1.225-6.126 3.498v4.325zM1.093 3.624v14.588l8.273 4.761v-4.325l-4.322-2.445-.002-.003H5.04c-.014-.01-.025-.021-.04-.031-.011-.01-.024-.018-.035-.027l-.001-.002c-.013-.012-.021-.025-.031-.039-.01-.012-.021-.023-.028-.037h-.002c-.008-.014-.013-.031-.02-.047-.006-.016-.014-.027-.018-.043a.49.49 0 01-.008-.057c-.002-.014-.006-.027-.006-.041V5.789l-2.18-1.257zM5.23.81L1.47 2.974l3.76 2.164 3.758-2.164zm1.956 13.505l2.182-1.256V3.624l-1.58.91-2.182 1.255v9.435zm11.581-10.95l-3.76 2.163 3.76 2.163 3.759-2.164zm-.376 4.978L16.21 7.087 14.63 6.18v4.283l2.182 1.256 1.58.908zm-8.65 9.654l5.514-3.148 2.756-1.572-3.757-2.163-4.323 2.489-3.941 2.27z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">Laravel</p>
                </div>
                <div class="ki-tech">
                    <svg class="w-12 h-12 mb-3" viewBox="0 0 24 24" fill="#06B6D4"><path d="M12.001,4.8c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 C13.666,10.618,15.027,12,18.001,12c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C16.337,6.182,14.976,4.8,12.001,4.8z M6.001,12c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 c1.177,1.194,2.538,2.576,5.512,2.576c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C10.337,13.382,8.976,12,6.001,12z"/></svg>
                    <p class="text-sm font-semibold text-gray-700">Tailwind</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured gallery (admin: Gallery → Featured Gallery on Homepage) -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4 max-w-7xl">
            @if($featuredGallery)
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ $featuredGallery->name }}</h2>
                @if($featuredGallery->description)
                <p class="text-lg text-gray-600 max-w-3xl mx-auto whitespace-pre-line">{{ $featuredGallery->description }}</p>
                @endif
            </div>
            @endif
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
                    class="ki-photo cursor-pointer"
                    @click="openLightbox({{ $index }})"
                    style="animation: fadeInUp 0.5s ease-out {{ $index * 0.1 }}s both;"
                >
                    <img 
                        src="{{ asset($photo['path']) }}" 
                        alt="Gallery Image {{ $index + 1 }}" 
          class="w-full h-48 object-cover"
                        loading="lazy"
                        onerror="this.onerror=null; this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-48 bg-gray-200 flex items-center justify-center rounded-xl\'><svg class=\'w-12 h-12 text-gray-400\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'></path></svg></div>'"
                    >
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
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
                <a href="{{ route('gallery') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: #16A34A;">View Gallery</a>
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