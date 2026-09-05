<blockquote class="ki-card">
    <p class="ki-card-body">{{ $testimonial['testimony'] }}</p>
    <footer class="mt-auto flex items-center gap-3">
        <img class="h-12 w-12 object-cover"
             src="{{ asset('images/testimonials/'.$testimonial->icon) }}"
             alt="{{ $testimonial['name'] }}"
             loading="lazy">
        <cite class="not-italic font-semibold text-gray-900">{{ $testimonial['name'] }}</cite>
    </footer>
</blockquote>
