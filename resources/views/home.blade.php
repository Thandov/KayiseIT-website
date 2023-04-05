<x-app-layout title="Home">
    <!-- Hero 
			<div class="hero">
				<div class="container spacing">
					<h3 data-aos="fade-down" data-aos-delay="500" class="text-3xl font-bold"><span>KAYISE IT</span></h3>
					<h1 class="primary-title" data-aos="fade-up" data-aos-delay="700">We love Technology</h1>
					<p data-aos="fade-up" data-aos-delay="1000">Through our robust IT services, Office Automation, Network Support and digital upskilling, we help our clients achieve their organizations objectives using technology.</p>
					<br>
					<br>
          <a href="#" class="hire" data-aos="fade-up" data-aos-delay="1000">See what we have</a>
				</div>
			</div>
			-->

    <div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/landing-page/group.jpg" topTitle="We Specialize In"
                mainTitle="Web Development" bottomTitle="..." />
            <x-carousel-item pic="../images/landing-page/soft.jpg" topTitle="We specialize In"
                mainTitle="Software Development" bottomTitle="..." />
            <x-carousel-item pic="../images/landing-page/office.jpg" topTitle="We specialize In"
                mainTitle="Office Automation" bottomTitle="..." />
        </div>
    </div>


    <!--services-->
    <div class="services container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5"><strong>Our Services</strong></p>
                <h2 style="color: #64bc5c" class="text-center mb-4  font-bold text-5xl md:text-5xl">Managed I.T. Solutions</h2>
                
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach($services as $service)
                            @if($counter < 3)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <a href="{{ url('viewservice/'.$service->id) }}">
                                        <div class="card  text-white" data-aos="fade-left" data-aos-delay="500">
                                            <img src="{{ asset('images/service_logo/'.$service->icon) }}"
                                                class="card-img" alt="Your Image">
                                            <div
                                                class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                                                <div class="text-center">
                                                    <h5 class="card-title text-3xl font-bold">
                                                        {{ $service['name'] }}</h5>
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
                <div class=" text-center text-2xl font-bold">
                    <span><a href="services" class="hire shadow">view all</a></span>
                </div>

            </div>
        </div>
    </div>


    <!--About Us-->
    <section class="container bg-white" id="about-us">
        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <img src="../images/kayise_IT_logo_No_Background.png" width="1200" class="rounded" data-aos="fade-left"
                    data-aos-delay="700">
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <h3 style="color: #183ea4" data-aos="fade-down" data-aos-delay="500"><strong>About Us</strong></h3>
                <h2  class="m" style="color: #64bc5c" data-aos="fade-up" data-aos-delay="500">We Specialize In Custom Tailored I.T Solutions.</h2>
                <p class="" data-aos="fade-right" data-aos-delay="500"><span>KAYISE IT </span>Welcome to KAYISE IT, a
                    leading
                    IT company specializing in software and web development, as well as providing 4IR skills
                    training. With a decade of experience in the industry, we are passionate about building ICT
                    capacity in communities and young people. </p>

                <div class="data" data-aos="fade-up" data-aos-delay="500">
                    <a href="navbar/about" class="hire shadow">Discover More</a>
                </div>
            </div>

        </div>
    </section>

    <!--skills-->
    <div class="mskills mx-auto sm:px-6 lg:px-8">
        <div class="skills">

            <div class="top-section">

                <div class="col">
                    <h1 style="color: #64bc5c" data-aos="fade-down" data-aos-delay="500" class="text-3xl text-center font-bold">We’re on a mission to bridge the digital divide</h1>
                </div>

            </div>

            <!--Overview-->
            <div class="overviews d-flex justify-content-center" style="display: flex; flex-direction: row;">

                <!--No.1 Years-->
                <div class="overview" style="color: #183ea4" data-aos="fade-right" data-aos-delay="500">
                    <span style="color: #183ea4">8</span>
                    <p  style="color: #315c2d">YEARS</p>
                </div>

                <!--No.2 Developers-->
                <div class="overview" style="color: #183ea4" data-aos="fade-down" data-aos-delay="700">
                    <span style="color: #183ea4">6</span>
                    <p  style="color: #315c2d">DEVELOPERS</p>
                </div>

                <!--No.3 Customer-->
                <div class="overview" style="color: #183ea4" data-aos="fade-up" data-aos-delay="1100">
                    <span style="color: #183ea4">10k</span>
                    <p  style="color: #315c2d">CUSTOMERS</p>
                </div>

                <!--No.3 Projects-->
                <div class="overview" style="color: #183ea4" data-aos="fade-left" data-aos-delay="1500">
                    <span style="color: #183ea4">10k</span>
                    <p style="color: #315c2d">PROJECTS</p>
                </div>

            </div>
        </div>
    </div>


    <!--Services-->
    <section class="our-services">
        <div class="services">
            <img src="./images/OurServicesImg.jpg" class="pic-2 shadow-lg" data-aos="fade-right" data-aos-delay="500">
            <div class="text-2 px-10">
                <p style="color: #183ea4" data-aos="fade-up" data-aos-delay="500"><strong>Our Services<strong></p>
                <h2 data-aos="fade-left" data-aos-delay="700">Managed I.T. Solutions Tailored To Your Business.</h2>
                <p data-aos="fade-left" data-aos-delay="800">Develop efficient & effective digital projects with
                    knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                    that our clients grow their business.</p>
                <div class="data">
                    <a href="services" class="hiree">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!--Blog-->
    <div class="blog  py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-20">

                <p style="color: #183ea4" class="card-text  mb-3 text-center" data-aos="fade-up" data-aos-delay="300"><strong>Our Blog</strong></p>
                <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">Latest Posts</h2>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach($blog as $blog)
                            @if($counter < 4)
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <a href="{{ url('viewblog/'.$blog->id) }}">
                                        <div class="card">
                                            <img src="{{ asset('images/'.$blog->icon) }}"
                                                class="card-img" alt="Your Image">
                                            <div class="card-body">
                                                <h2 style="color: #64bc5c" class="card-title font-bold text-gray-90">
                                                    {{ $blog['title'] }}</h2>
                                                <h3 class="card-text">{{ $blog['subtitle'] }}
                                                </h3>
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
                <div class=" text-center text-2xl font-bold">
                <div class= "data">
                    <a href="blog" class="hiree">Read More</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <!--Testimonials-->
    <div class="testimonial container py-5" id="testimonial_background">
        <div class="row justify-content-center">
            <div class="col">
                <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5">Testimonials</p>
                <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">What They Say</h2>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row px-1">
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
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $avg_rating)
                                                        <i class="fas fa-star" style="color: #64bc5c;"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="card-text py-3">
                                                {{ $testimonial['testimony'] }}</p>
                                            <div class="col-4">
                                                <img src="{{ asset('images/'.$testimonial->icon) }}"
                                                    class="rounded-circle"
                                                    style="width: 50px; height: 50px; ">
                                            </div>
                                            <div class="col-8">
                                                <h3 class="card-title text-1xl pt-4 font-bold">
                                                    {{ $testimonial['name'] }}</h3>
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
    </div>


    <!--Our Clients-->
    <div class="bg-white  mx-auto py-5 sm:px-6 lg:px-8">

        <div class="container mb-10">
            <div class="row">
                <p style="color: #183ea4" class="card-text  mb-3 text-center" data-aos="fade-up" data-aos-delay="300"><strong>Some Of Our Clients</strong></p>
                <h2 style="color: #64bc5c" class="font-bold text-center mb-5 text-5xl md:text-5xl" data-aos="fade-down" data-aos-delay="300">We Strive To Work With The Best</h2>

                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                    <div class="slider" data-aos="fade-left" data-aos-delay="300">
                        <div class="slide-container">
                            <img src="../images/partner1.png">
                            <img src="../images/partner2.png">
                            <img src="../images/partner3.png">
                            <img src="../images/partner4.png">
                            <img src="../images/partner5.png">
                            <img src="../images/partner6.png">
                            <img src="../images/partner7.png">
                            <img src="../images/partner8.png">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-app-layout>

<script>
    //ratings

    $(document).ready(function () {
        $('form').submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    $('#rating-form').hide();
                    $('#rating-success').show();
                    var rating = response.rating;
                    var stars = '';
                    for (var i = 1; i <= rating; i++) {
                        stars += '<i class="fas fa-star"></i>';
                    }
                    $('#user-rating').html(stars);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });

    //our clients slide

    let slider = document.querySelector('.slide-container');
    let sliderWidth = slider.offsetWidth;
    let slideIndex = 0;

    function showSlides() {
        let slides = document.querySelectorAll('.slide-container img');
        let visibleSlides = window.innerWidth < 768 ? 3 :
            4; // Change the number of visible slides based on the screen width
        let slideWidth = sliderWidth / visibleSlides;
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('show');
        }
        for (let i = slideIndex; i < slideIndex + visibleSlides; i++) {
            if (slides[i]) {
                slides[i].classList.add('show');
            }
        }
        slideIndex++;
        if (slideIndex > slides.length - visibleSlides) {
            slideIndex = 0;
        }
        setTimeout(showSlides, 2000);
    }

    showSlides();


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

    jQuery(document).ready(function ($) {
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

        owl.on('changed.owl.carousel', function (event) {
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
