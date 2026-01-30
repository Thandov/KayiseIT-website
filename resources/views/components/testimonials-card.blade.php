<!-- Professional Enterprise Testimonial Card -->
<div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border-t-4 border-kb-500 relative overflow-hidden group h-full">
    <!-- Decorative accent -->
    <div class="absolute top-0 right-0 w-20 h-20 bg-kb-50 rounded-full -translate-y-10 translate-x-10 opacity-40 group-hover:opacity-60 transition-opacity duration-300"></div>
    
    <!-- Quote icon -->
    <div class="absolute top-4 left-4 w-8 h-8 text-kb-200 opacity-30">
        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14,17h3l2-4V7h-6v6h3L14,17z M6,17h3l2-4V7H5v6h3L6,17z"/>
        </svg>
    </div>

    <div class="relative z-10 h-full flex flex-col">
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
            <span class="ml-2 text-sm text-gray-500 font-semibold">{{ number_format($avg_rating, 1) }}/5</span>
        </div>

        <!-- Testimonial Content -->
        <div class="flex-grow mb-6">
            <blockquote class="text-gray-700 leading-relaxed">
                <p class="text-lg italic">"{{ $testimonial['testimony'] }}"</p>
            </blockquote>
        </div>

        <!-- Client Information -->
        <div class="flex items-center mt-auto">
            <div class="flex-shrink-0 mr-4">
                <img class="h-12 w-12 rounded-full ring-2 ring-kb-100 object-cover" 
                     src="{{ asset('images/testimonials/'.$testimonial->icon) }}" 
                     alt="{{ $testimonial['name'] }} testimonial"
                     loading="lazy">
            </div>
            <div class="min-w-0">
                <p class="text-lg font-semibold text-gray-900">{{ $testimonial['name'] }}</p>
                <p class="text-sm text-gray-500">Enterprise Client</p>
            </div>
        </div>
    </div>
</div>