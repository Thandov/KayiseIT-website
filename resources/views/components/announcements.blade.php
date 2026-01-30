@props(['announcements' => null])

@php
    // Use announcements passed from controller, or fetch from database if not provided
    if (!$announcements) {
        try {
            $nowTimestamp = now()->timestamp;
            $announcements = App\Models\Announcement::where(function($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->get()
            ->filter(function($announcement) use ($nowTimestamp) {
                if ($announcement->expires_at === null) {
                    return true;
                }
                $expiresTimestamp = $announcement->expires_at instanceof \Carbon\Carbon 
                    ? $announcement->expires_at->timestamp 
                    : (is_string($announcement->expires_at) ? strtotime($announcement->expires_at) : $announcement->expires_at);
                return $expiresTimestamp > $nowTimestamp;
            })
            ->sortByDesc('created_at')
            ->values();
        } catch (\Exception $e) {
            $announcements = collect([]);
        }
    }
    
    // Ensure announcements is a collection
    if (!($announcements instanceof \Illuminate\Support\Collection)) {
        $announcements = collect($announcements);
    }
    
    // Filter out expired announcements (double-check even if controller filtered)
    // Use timestamp comparison to avoid timezone issues
    $now = now();
    $nowTimestamp = $now->timestamp;
    $announcements = $announcements->filter(function($announcement) use ($nowTimestamp) {
        if (!isset($announcement->expires_at) || $announcement->expires_at === null) {
            return true; // No expiration date, always show
        }
        // Convert to timestamp for absolute comparison
        if (is_string($announcement->expires_at)) {
            $expiresTimestamp = strtotime($announcement->expires_at);
        } elseif ($announcement->expires_at instanceof \Carbon\Carbon) {
            $expiresTimestamp = $announcement->expires_at->timestamp;
        } else {
            $expiresTimestamp = strtotime($announcement->expires_at);
        }
        // Must be strictly greater than now (expires timestamp > now timestamp)
        return $expiresTimestamp > $nowTimestamp;
    })->values();
    
    // Calculate number of slides needed (4 announcements per slide)
    $announcementsPerSlide = 4;
    $totalSlides = ceil($announcements->count() / $announcementsPerSlide);
    $announcementsArray = $announcements->toArray();
@endphp

@if($announcements->count() > 0)
    <div class="announcements-carousel relative px-4">
        <!-- Carousel Container -->
        <div class="carousel-wrapper relative overflow-hidden">
            <div class="carousel-track flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%);">
                @for($slide = 0; $slide < $totalSlides; $slide++)
                    <div class="carousel-slide min-w-full px-2" data-slide="{{ $slide }}">
                        <div class="flex flex-wrap justify-center gap-6 max-w-7xl mx-auto">
                            @for($i = 0; $i < $announcementsPerSlide; $i++)
                                @php
                                    $index = ($slide * $announcementsPerSlide) + $i;
                                    $announcement = isset($announcementsArray[$index]) ? (object)$announcementsArray[$index] : null;
                                @endphp
                                @if($announcement)
            @php
                $cardLink = $announcement->link ?? $announcement->url ?? '#';
            @endphp
                                    <a href="{{ $cardLink }}" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group cursor-pointer h-full w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] max-w-sm">
                <!-- Image Section (if available) -->
                @if(isset($announcement->image) && $announcement->image)
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50">
                        <img src="{{ asset($announcement->image) }}" 
                             alt="{{ $announcement->title ?? 'Announcement' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute top-4 right-4">
                            @if(isset($announcement->badge) && $announcement->badge)
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                                      style="background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%); border: 1px solid rgba(34,197,94,0.5); color: #22C55E; box-shadow: 0 0 10px rgba(34,197,94,0.2);">
                                    {{ $announcement->badge }}
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Placeholder gradient background when no image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
                        <div class="absolute top-4 right-4">
                            @if(isset($announcement->badge) && $announcement->badge)
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                                      style="background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%); border: 1px solid rgba(34,197,94,0.5); color: #22C55E; box-shadow: 0 0 10px rgba(34,197,94,0.2);">
                                    {{ $announcement->badge }}
                                </span>
                            @endif
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                    </div>
                @endif
                
                <!-- Content Section -->
                                        <div class="p-6 flex flex-col flex-grow">
                    <!-- Date -->
                                            @if(isset($announcement->created_at))
                        <p class="text-xs text-gray-500 mb-2">
                                                    {{ is_object($announcement->created_at) ? $announcement->created_at->format('M d, Y') : date('M d, Y', strtotime($announcement->created_at)) }}
                        </p>
                    @endif
                    
                    <!-- Title -->
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-200">
                        {{ $announcement->title ?? 'Announcement' }}
                    </h3>
                    
                    <!-- Description -->
                    @if(isset($announcement->description))
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                            {{ $announcement->description }}
                        </p>
                    @elseif(isset($announcement->content))
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($announcement->content), 120) }}
                        </p>
                    @endif
                    
                    <!-- CTA Button -->
                                            <div class="inline-flex items-center text-sm font-semibold transition-colors duration-200 group/link mt-auto"
                         style="color: #22C55E;">
                        <span>Learn More</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
                                @endif
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Navigation Arrows -->
        @if($totalSlides > 1)
            <button class="carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors duration-200 z-10 focus:outline-none focus:ring-2 focus:ring-green-500" aria-label="Previous slide">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors duration-200 z-10 focus:outline-none focus:ring-2 focus:ring-green-500" aria-label="Next slide">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Carousel Indicators -->
            <div class="flex justify-center mt-8 space-x-2">
                @for($i = 0; $i < $totalSlides; $i++)
                    <button class="carousel-indicator w-2 h-2 rounded-full transition-all duration-200 {{ $i === 0 ? 'bg-green-600 w-8' : 'bg-gray-300' }}" 
                            data-slide="{{ $i }}"
                            aria-label="Go to slide {{ $i + 1 }}"></button>
                @endfor
            </div>
        @endif
    </div>
    
    <!-- Empty State (hidden if announcements exist) -->
@else
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No announcements</h3>
        <p class="mt-1 text-sm text-gray-500">Check back soon for updates.</p>
    </div>
@endif

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .announcements-carousel {
        position: relative;
    }
    
    @media (max-width: 640px) {
        .carousel-prev,
        .carousel-next {
            display: none;
        }
    }
</style>

<script>
(function() {
    const carousel = document.querySelector('.announcements-carousel');
    if (!carousel) return;
    
    const track = carousel.querySelector('.carousel-track');
    const slides = carousel.querySelectorAll('.carousel-slide');
    const prevBtn = carousel.querySelector('.carousel-prev');
    const nextBtn = carousel.querySelector('.carousel-next');
    const indicators = carousel.querySelectorAll('.carousel-indicator');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    
    if (totalSlides <= 1) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        return;
    }
    
    function updateCarousel() {
        const translateX = -currentSlide * 100;
        track.style.transform = `translateX(${translateX}%)`;
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('bg-green-600', 'w-8');
                indicator.classList.remove('bg-gray-300', 'w-2');
            } else {
                indicator.classList.remove('bg-green-600', 'w-8');
                indicator.classList.add('bg-gray-300', 'w-2');
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }
    
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }
    
    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => goToSlide(index));
    });
    
    // Auto-play (optional - uncomment if you want auto-rotation)
    // let autoPlayInterval = setInterval(nextSlide, 5000);
    // carousel.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    // carousel.addEventListener('mouseleave', () => {
    //     autoPlayInterval = setInterval(nextSlide, 5000);
    // });
    
    // Touch/swipe support for mobile
    let startX = 0;
    let isDragging = false;
    
    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
    });
    
    track.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
    });
    
    track.addEventListener('touchend', (e) => {
        if (!isDragging) return;
        isDragging = false;
        const endX = e.changedTouches[0].clientX;
        const diff = startX - endX;
        
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    });
})();
</script>

