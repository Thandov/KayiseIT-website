<!-- Section: Testimonials -->
<section class="bg-slate-100 mx-auto py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
    <x-titlestyle smheading="What People Say" bgheading="Client Testimonials" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
    <p class="mb-10 text-center">We hope that our clients' experiences will help you make an informed decision.</p>
    <!--Carousel-->
    <div id="testimonial-carousel" class="owl-carousel owl-theme">
        @foreach($testimonials as $testimonial)
        <div>
        <x-testimonials-card :testimonial="$testimonial" />
            </div>
        @endforeach
    </div>
</section>