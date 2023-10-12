<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "Home - Welcome to Kayise IT";
    $metaDescription = "Explore our innovative technology solutions and experience unparalleled customer satisfaction.";
    $metaKeywords = "IT Company, Computers and Information Technology, Software, Technology, ICT, Nelspruit, South Africa, Near Me, IT Companies South Africa";
    @endphp
    @endsection
    <!-- Page Body -->

    <!--Carousel-->
    <section id="carousel">
        @include('_carousel')
    </section>

    <!--About Us-->
    <section id="about-us">
        @include('_about')
    </section>
    <!--Featured Services-->
    <section class="bg-slate-100 py-5" id="featured-services">
        <div class="text-center px-4 md:px-8 max-w-screen-xl mx-auto">
            @include('services._services', ['services' => $services->take(4)])
        </div>
    </section>
    <!--Services Call-To-Action-->
    <section id="our-services">
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="../images/server_bae.png" class="pic-2 shadow-lg rounded-3" alt="Kayise IT:Woman Working">
                </div>
                <div class="col-md-6 col-sm-12 text-2 d-flex align-items-center">
                    <div>
                        <x-titlestyle smheading="Our Services" bgheading="Managed I.T. solutions tailored to your business" alignment="text-left" smheadingcolor=" " bgheadingcolor="text-white"></x-titlestyle>
                        <p id="white-text" class="text-base mt-4 mb-4">Develop efficient & effective digital projects with
                            knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                            that our clients grow their business.</p>
                        <x-front-end-btn linking="services" color="blue" showme="zzzzzzzz" name="Learn More" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Projects-->
    <!-- @include('_projects') -->
    <!--Testimonials-->
    <section id="testimonials">
        @include('_testimonials')
    </section>

    <!-- Contact-Info -->
    <section id="contact-info">
        @include('_contactinfo')
    </section>
</x-app-layout>
<script>
    function callback(event) {
        removeSliderClass(event);
    }

    function removeSliderClass(event) {
        console.log("removing classes");
        var item = event.item.index - 2; // Position of the current item
        console.log(item);
        jQuery('p').removeClass('animate__animated animate__fadeInDown');
        jQuery('h1').removeClass('animate__animated animate__fadeInUp');
        jQuery('img').removeClass('animate__animated animate__fadeInDown');
        jQuery('.hero__btn').removeClass('animate__animated animate__fadeInLeft');

        jQuery('.owl-item').not('.cloned').eq(item).find('p').addClass('animate__animated animate__fadeInDown');
        jQuery('.owl-item').not('.cloned').eq(item).find('h1').addClass('animate__animated animate__fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('img').addClass('animate__animated animate__fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('.hero__btn').addClass('animate__animated animate__fadeInLeft');
    }

    jQuery(document).ready(function($) {
        "use strict";

        jQuery('#headercara').owlCarousel({
            animateOut: 'animate__animated animate__fadeOut',
            animateIn: 'animate__animated animate__fadeIn',
            loop: true,
            responsiveClass: true,
            dots: true,
            nav: true,
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    nav: false
                }
            },
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
        });

        var owl = jQuery('#headercara');

        owl.on('changed.owl.carousel', function(event) {
            var item = event.item.index - 2; // Position of the current item
            console.log(item);
            jQuery('p').removeClass('animate__animated animate__fadeInDown');
            jQuery('h1').removeClass('animate__animated animate__fadeInUp');
            jQuery('img').removeClass('animate__animated animate__fadeInDown');
            jQuery('.hero__btn').removeClass('animate__animated animate__fadeInLeft');

            jQuery('.owl-item').not('.cloned').eq(item).find('p').addClass(
                'animate__animated animate__fadeInDown');
            jQuery('.owl-item').not('.cloned').eq(item).find('h1').addClass(
                'animate__animated animate__fadeInUp');
            jQuery('.owl-item').not('.cloned').eq(item).find('img').addClass(
                'animate__animated animate__fadeInUp');
            jQuery('.owl-item').not('.cloned').eq(item).find('.hero__btn').addClass(
                'animate__animated animate__fadeInLeft');
        });

    });
</script>