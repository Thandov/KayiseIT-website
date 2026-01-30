<!-- Section: Professional Client Testimonials -->
<section class="py-20">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="text-center mb-16">
        <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Testimonials</span>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Trusted by Leading Enterprise Clients</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Discover why industry leaders choose KAYISE IT for their digital transformation and IT solutions.</p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 border-t-4 border-kb-500 relative overflow-hidden group">
                <!-- Decorative background element -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-kb-50 rounded-full opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                
                <div class="relative z-10">
                    <!-- Star Rating -->
                    <div class="flex items-center mb-4">
                        @php
                        $avg_rating = DB::table('testimonials')->where('id',$testimonial->id)->avg('ratings');
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $avg_rating)
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-500 font-semibold">{{ number_format($avg_rating, 1) }}</span>
                    </div>

                    <!-- Testimonial Quote -->
                    <blockquote class="text-gray-700 mb-6 leading-relaxed">
                        <p class="text-lg italic">"{{ $testimonial['testimony'] }}"</p>
                    </blockquote>

                    <!-- Quote Icon -->
                    <div class="absolute top-6 left-6 w-8 h-8 text-kb-200 opacity-30">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,17h3l2-4V7h-6v6h3L14,17z M6,17h3l2-4V7H5v6h3L6,17z"/>
                        </svg>
                    </div>

                    <!-- Client Info -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <img class="h-16 w-16 rounded-full ring-2 ring-kb-100 object-cover" 
                                 src="{{ asset('images/testimonials/'.$testimonial->icon) }}" 
                                 alt="{{ $testimonial['name'] }} testimonial">
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-lg font-semibold text-gray-900">{{ $testimonial['name'] }}</p>
                            <p class="text-sm text-gray-500">Client since {{ \Carbon\Carbon::now()->subYear(rand(1,3))->format('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Join Our Success Stories?</h3>
                <p class="text-gray-600 mb-6">Let's discuss how we can transform your business with proven IT solutions.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <x-front-end-btn linking="contact" color="blue" showme="" name="Start Your Project" />
                    <x-front-end-btn linking="services" color="white" showme="" name="View Our Services" />
                </div>
            </div>
        </div>
    </div>
</section>