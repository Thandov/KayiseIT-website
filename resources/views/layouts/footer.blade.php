@if(!Route::is('dashboard'))
<footer class="bg-[#0f172a] text-white">
    {{-- Accent bar --}}
    <div class="h-1 w-full bg-[#22C55E]"></div>

    {{-- Contact strip: compact, corporate --}}
    <section class="border-b border-slate-700/80">
        <div class="container mx-auto px-4 max-w-6xl py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-8">
                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-6 sm:gap-10">
                    <a href="mailto:info@kayiseit.com" class="flex items-center gap-3 text-slate-300 hover:text-white transition-colors text-sm">
                        <span class="flex-shrink-0 w-9 h-9 rounded border border-slate-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </span>
                        <span>info@kayiseit.com</span>
                    </a>
                    <a href="tel:+27877022625" class="flex items-center gap-3 text-slate-300 hover:text-white transition-colors text-sm">
                        <span class="flex-shrink-0 w-9 h-9 rounded border border-slate-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a11.285 11.285 0 01-6.244-6.244c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L18.3 2.922a1.064 1.064 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                        </span>
                        <span>+27 87 702 2625</span>
                    </a>
                    <a href="https://maps.app.goo.gl/PANTYMHfVkWBoKSp7" target="_blank" rel="noopener" class="flex items-center gap-3 text-slate-300 hover:text-white transition-colors text-sm max-w-xs">
                        <span class="flex-shrink-0 w-9 h-9 rounded border border-slate-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </span>
                        <span>Office 2, 2nd Floor, 39b Brown St, Nelbro Building, Nelspruit, 1201</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Main footer content --}}
    <div class="container mx-auto px-4 max-w-6xl py-10 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
            {{-- Company --}}
            <div class="lg:col-span-1">
                <img src="{{ asset('images/Logo_White_No_Background.png') }}" alt="KAYISE IT" class="h-10 w-auto mb-4">
                <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                    Specialized IT solutions for digital transformation. Enterprise technology services to accelerate your business.
                </p>
                <div class="flex items-center gap-2 mt-5">
                    <a href="https://www.facebook.com/KAYISEIT?mibextid=ZbWKwL" target="_blank" rel="noopener" class="w-8 h-8 rounded border border-slate-600 text-slate-400 hover:text-white hover:border-slate-500 flex items-center justify-center transition-colors" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://instagram.com/kayiseit?igshid=ZDdkNTZiNTM=" target="_blank" rel="noopener" class="w-8 h-8 rounded border border-slate-600 text-slate-400 hover:text-white hover:border-slate-500 flex items-center justify-center transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/company/kayise-it/" target="_blank" rel="noopener" class="w-8 h-8 rounded border border-slate-600 text-slate-400 hover:text-white hover:border-slate-500 flex items-center justify-center transition-colors" aria-label="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/channel/UCrAixDqFR92LBqC7OBF3Eqw" target="_blank" rel="noopener" class="w-8 h-8 rounded border border-slate-600 text-slate-400 hover:text-white hover:border-slate-500 flex items-center justify-center transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">Quick Links</h3>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Home</a></li>
                    <li><a href="{{ route('services') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Services</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-white text-sm transition-colors">About Us</a></li>
                    <li><a href="{{ route('opportunities') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Opportunities</a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">Our Services</h3>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('services') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Software Development</a></li>
                    <li><a href="{{ route('services') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Web Development</a></li>
                    <li><a href="{{ route('services') }}" class="text-slate-400 hover:text-white text-sm transition-colors">IT Consulting</a></li>
                    <li><a href="{{ route('opportunities') }}" class="text-slate-400 hover:text-white text-sm transition-colors">Internships</a></li>
                    <li><a href="{{ route('opportunities') }}" class="text-slate-400 hover:text-white text-sm transition-colors">TVET Placements</a></li>
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-slate-700/80 pt-6 mt-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} KAYISE IT. All rights reserved.
                </p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="#" class="text-slate-500 hover:text-slate-300 transition-colors">Privacy Policy</a>
                    <span class="text-slate-600">|</span>
                    <a href="#" class="text-slate-500 hover:text-slate-300 transition-colors">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>
@endif
