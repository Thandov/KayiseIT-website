<!-- Section: Professional Client Testimonials -->
<section class="py-20">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <span class="ki-kicker">Client feedback</span>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What clients say</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Organisations we have built for and trained with, in their own words.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
            <blockquote class="ki-card">
                <p class="ki-card-body">{{ $testimonial['testimony'] }}</p>
                <footer class="mt-auto flex items-center gap-3">
                    <img class="h-12 w-12 object-cover"
                         src="{{ asset('images/testimonials/'.$testimonial->icon) }}"
                         alt="{{ $testimonial['name'] }}">
                    <cite class="not-italic font-semibold text-gray-900">{{ $testimonial['name'] }}</cite>
                </footer>
            </blockquote>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Work with us</h3>
            <p class="text-gray-600 mb-6">Tell us about a system, a training intake, or a website that needs building.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-front-end-btn linking="contact" color="blue" showme="" name="Start Your Project" />
                <x-front-end-btn linking="services" color="white" showme="" name="View Our Services" />
            </div>
        </div>
    </div>
</section>