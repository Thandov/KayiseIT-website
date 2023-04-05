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
            <div class="col">

                <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5"><strong>Our Services</strong></p>
                <h2 style="color: #64bc5c" class="text-center mb-4  font-bold text-5xl md:text-5xl">Managed I.T. Solutions</h2>
                
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach($services as $service)
                            @if($counter < 3)
                                <div class="col-md-4 col-sm-6 my-3">
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
                <div class=" text-center mt-3 text-2xl font-bold">
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
                <p style="color: #183ea4" data-aos="fade-down" data-aos-delay="500"><strong>About Us</strong></p>
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



    <x-stats years="8" developers="7" customers="7k" projects="5k"/>


    <!--

<div class="blog  py-5">
      <div class="row justify-content-center">
         <div class="col-md-10 mb-20">

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
                <img src="{{ asset('images/'.$blog->icon) }}" class="card-img" alt="Your Image">
                <div class="card-body">
                         <h2 style="color: #64bc5c" class="card-title font-bold text-gray-90">{{ $blog['title'] }}</h2>
                         <h3 class="card-text">{{ $blog['subtitle'] }}</h3>
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
					  	<span><a href="blog" class="">view all</a></span>
					  </div>

        </div>
      </div>
    </div>
    

            -->







    <!--Services-->
    <section class = "our-services">
        <div class = "services">
            <img src="./images/OurServicesImg.jpg" class="pic-2 shadow-lg" data-aos="fade-right" data-aos-delay="500">
            <div class="text-2 px-10">
                <p class="font-bold" data-aos="fade-up" data-aos-delay="500"><span>OUR SERVICES</span></p>
                <h2 data-aos="fade-left" data-aos-delay="700">Managed I.T. solutions tailored to your business.</h2>
                <p data-aos="fade-left" data-aos-delay="800">Develop efficient & effective digital projects with
                    knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                    that our clients grow their business.</p>
                <div class="data">
                    <a href="services" class="hiree">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!--Testimonials-->
    <div class="testimonial container py-5" id="testimonial_background">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
