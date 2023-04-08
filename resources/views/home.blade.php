<x-app-layout title="Home">

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <!--Carousel-->
    <div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/landing-page/group.jpg" topTitle="We Specialize In" mainTitle="Web Development" bottomTitle="..." />
            <x-carousel-item pic="../images/landing-page/soft.jpg" topTitle="We specialize In" mainTitle="Software Development" bottomTitle="..." />
            <x-carousel-item pic="../images/landing-page/office.jpg" topTitle="We specialize In" mainTitle="Office Automation" bottomTitle="..." />
        </div>
    </div>

    <!--freatured services-->
    <div class="services container p-5">
        <div class="row justify-content-center">
            <div class="col">

            <x-headings small="Our Services" big="Managed I.T. Solutions" toalign="text-center"/>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @php
                        $counter = 0;
                        @endphp
                        @foreach($services as $service)
                        @if($counter < 3) <div class="col-md-4 col-sm-6 my-3">
                            <a href="{{ url('viewservice/'.$service->id) }}">
                                <div class="card  text-white" data-aos="fade-left" data-aos-delay="500">
                                    <img src="{{ asset('images/service_logo/'.$service->icon) }}" class="card-img" alt="Your Image">
                                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                                        <div class="text-center">
                                            <h5 class="card-title text-3xl font-bold">
                                                {{ $service['name'] }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                    </div>
                    @endif
                    @php
                    $counter++;
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-3 text-2xl font-bold">
                <a href="services" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4" data-aos="fade-up" data-aos-delay="500">view all</a>
            </div>

        </div>
    </div>
    </div>

    <!--About Us-->
    <section class="bg-white">
        <div class="container p-5" id="about-us">
            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-6 ">
                    <img src="../images/kayise_IT_logo_No_Background.png" width="1200" class="rounded" data-aos="fade-left" data-aos-delay="700">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 d-flex align-items-center">
                    <div class="">

                        <x-body smheading="About Us" 
                                bgheading="We Specialize In Custom Tailored I.T Solutions." 
                                paragraph="Welcome to KAYISE IT, a leading IT company specializing in software and web development, as well as providing 4IR skills training. With a decade of experience in the industry, we are passionate about building ICT capacity in communities and young people." 
                                btnlink="about" btntext="Discover More"/>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-stats years="8" developers="7" customers="7k" projects="5k" />

    <!--Services Call-To-Action-->
    <section id="our-services">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="./images/OurServicesImg.jpg" class="pic-2 shadow-lg rounded-3" data-aos="fade-right" data-aos-delay="500">
                </div>
                <div class="col-md-6 col-sm-12 text-2 d-flex align-items-center">
                    <div>
                        <p class="smalltxt font-bold" data-aos="fade-left" data-aos-delay="700">OUR SERVICES</p>
                        <h2 id="white-text" class=" font-bold text-5xl" data-aos="fade-up" data-aos-delay="500">Managed I.T. solutions tailored to your business.</h2>
                        <p id="white-text" class="fs-6 mt-4 mb-4" data-aos="fade-left" data-aos-delay="800">Develop efficient & effective digital projects with
                            knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                            that our clients grow their business.</p>
                        <div class="data">
                            <a href="services"  id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-aos="fade-up" data-aos-delay="500">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Testimonials-->
    <section class="testimonial" id="testimonial_background">
        <div class="container p-5">
            <div class="row justify-content-center">
                    
                    <x-headings small="Testimonials" big="What They Say" toalign="text-center"/>

                    <div class="d-flex justify-content-center align-items-center">
                        <div class="row">
                            @foreach($testimonials as $testimonial)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card m-2 " data-aos="fade-right" data-aos-delay="300">
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
                                                <img src="{{ asset('images/'.$testimonial->icon) }}" class="rounded-circle" style="width: 50px; height: 50px; ">
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