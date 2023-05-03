<x-app-layout title="Home">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <!--Carousel-->
   @include('_carousel')
    
    <!--freatured services-->
    @include('services._services', ['services' => $services->take(3)])
    <div class="data text-center mb-5">
        <a href="services" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">View All</a>
    </div>
    <!--About Us-->
    @include('_about')
    @include ('components.our-team')
    <!--Services Call-To-Action-->
    <section id="our-services">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="../images/OurServicesImg.jpg" class="pic-2 shadow-lg rounded-3">
                </div>
                <div class="col-md-6 col-sm-12 text-2 d-flex align-items-center">
                    <div>
                        <x-titlestyle smheading="Our Services" bgheading="Managed I.T. solutions tailored to your business" alignment="text-left" smheadingcolor=" " bgheadingcolor="text-white"></x-titlestyle>
                        <p id="white-text" class="fs-6 mt-4 mb-4">Develop efficient & effective digital projects with
                            knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                            that our clients grow their business.</p>
                        <div class="data">
                            <a href="services" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonials-->
	<!--Testimonials-->
    @include('_testimonials')
    <section class="testimonial" id="testimonial_background">
        <div class="container p-5">
            <div class="row justify-content-center">
                <x-titlestyle smheading="Testimonials" bgheading="What They Say" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @foreach($testimonials as $testimonial)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card m-2 ">
                                <div class="card-body">
                                    <div class="row mx-4">
                                        <div class="rating text-center">
                                            <span class="text-muted"></span>
                                            @php
                                            $avg_rating = DB::table('testimonials')->where('id',
                                            $testimonial->id)->avg('ratings');
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++) @if($i <=$avg_rating) <i class="fas fa-star"></i>
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                                @endfor
                                        </div>
                                        <p class="card-text py-3 fs-6">
                                            {{ $testimonial['testimony'] }}
                                        </p>
                                        <div class="col-4">
                                            <img src="{{ asset('images/testimonials/'.$testimonial->icon) }}" class="rounded-circle" style="width: 50px; height: 50px; ">
                                        </div>
                                        <div class="col-8">
                                            <h3 class="card-title text-1xl pt-4 font-bold">
                                                {{ $testimonial['name'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
<script>
    //ratings
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    $('#rating-form').hide();
                    $('#rating-success').show();
                    var rating = response.rating;
                    var stars = '';
                    for (var i = 1; i <= rating; i++) {
                        stars += '<i class="fas fa-star"></i>';
                    }
                    $('#user-rating').html(stars);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
    AOS.init();
    //carousel
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
        jQuery('.owl-item').not('.cloned').eq(item).find('.hero__btn').addClass(
            'animate__animated animate__fadeInLeft');
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