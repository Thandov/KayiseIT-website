{{-- Shared about intro; used on the About page --}}
<section class="ki-about-intro" id="about-us">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="ki-about-intro-grid">
            <div class="ki-about-intro-copy ki-reveal">
                <span class="ki-kicker ki-kicker-left">Who we are</span>
                <h2 class="ki-about-heading">IT delivery that funds skills.</h2>
                <p class="ki-about-lead">
                    KAYISE IT builds and supports digital systems for organisations — and runs training and internship pathways that grow South Africa’s next ICT professionals.
                </p>
                <ul class="ki-about-points">
                    <li>Software, web, and IT consulting for real operational needs</li>
                    <li>Internship and workplace programmes tied to delivery work</li>
                    <li>Partners across SETAs, colleges, and industry</li>
                </ul>
                <div class="ki-about-actions">
                    <a href="{{ route('contact') }}" class="ki-about-btn ki-about-btn--primary">Talk to us</a>
                    <a href="{{ route('opportunities') }}" class="ki-about-btn ki-about-btn--ghost">View opportunities</a>
                </div>
            </div>
            <div class="ki-about-intro-media ki-reveal" style="animation-delay: 0.12s">
                <img
                    src="{{ asset('images/KayiseIT-Team.jpg') }}"
                    alt="KAYISE IT team at work"
                    loading="lazy"
                >
            </div>
        </div>
    </div>
</section>
