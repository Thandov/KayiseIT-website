@if(!Route::is('dashboard'))
<!-- Modern Footer -->
<footer class="bg-gradient-to-b from-slate-50 to-white border-t border-gray-200">
    <!-- Contact Information Section -->
    <section class="bg-white py-12 border-b border-gray-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Email -->
                <a href="mailto:info@kayiseit.com" class="group flex flex-col items-center text-center p-6 rounded-xl hover:bg-gray-50 transition-all duration-300 hover:shadow-md">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg group-hover:shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Email Address</h3>
                    <p class="text-gray-600 text-sm">info@kayiseit.com</p>
                </a>

                <!-- Phone -->
                <a href="tel:+27877022625" class="group flex flex-col items-center text-center p-6 rounded-xl hover:bg-gray-50 transition-all duration-300 hover:shadow-md">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg group-hover:shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Phone</h3>
                    <p class="text-gray-600 text-sm">+27 87 702 2625</p>
                </a>

                <!-- Address -->
                <a href="https://maps.app.goo.gl/PANTYMHfVkWBoKSp7" target="_blank" class="group flex flex-col items-center text-center p-6 rounded-xl hover:bg-gray-50 transition-all duration-300 hover:shadow-md">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg group-hover:shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">Address</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Office 2, 2nd Floor<br>39b Brown Street<br>Nelbro Building, Nelspruit, 1201</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Footer Section -->
    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        <div class="container mx-auto px-4 max-w-7xl py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 mb-8">
                <!-- Company Info -->
                <div class="flex flex-col">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/Logo_White_No_Background.png') }}" 
                             alt="KAYISE IT Logo" 
                             class="h-12 w-auto">
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Specialized IT Solutions for your digital transformation. Enterprise-grade technology services designed to accelerate your business.
                    </p>
                    <!-- Social Media Icons -->
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/KAYISEIT?mibextid=ZbWKwL" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 hover:bg-blue-600 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg"
                           aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://instagram.com/kayiseit?igshid=ZDdkNTZiNTM=" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-600 hover:to-orange-500 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg"
                           aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/company/kayise-it/" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 hover:bg-blue-700 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg"
                           aria-label="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/channel/UCrAixDqFR92LBqC7OBF3Eqw" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 text-white flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg"
                           aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('opportunities') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Opportunities</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Our Services</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('services') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Software Development</a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Web Development</a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">IT Consulting</a>
                        </li>
                        <li>
                            <a href="{{ route('opportunities') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">Internships</a>
                        </li>
                        <li>
                            <a href="{{ route('opportunities') }}" class="text-gray-400 hover:text-green-400 transition-colors duration-200 text-sm">TVET Placements</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} KAYISE IT. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Privacy Policy</a>
                        <span class="text-gray-600">|</span>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endif
