<x-app-layout>
<div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <img src="/images/logo.png" alt="logo" srcset="/images/logo.svg"
            class="landinglogo animate__animated animate__fadeInUp">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/landing-page/banner1.png" topTitle="Aaaa" mainTitle="asasA"
                bottomTitle="dddd" />
            <x-carousel-item pic="../images/landing-page/banner2.png" topTitle="We specialize"
                mainTitle="Software Development" bottomTitle="dddd" />
            <x-carousel-item pic="../images/landing-page/banner3.png" topTitle="We specialize"
                mainTitle="Web Development" bottomTitle="asd" />
        </div>
    </div>

    <div class="container m-5">
        <div class="row">
          <div class="col-5">
            <img src="../images/about.jpeg"width="550"height="400">
          </div>
          <div class="col-6">
          <div><h1>Who are we</h1></div>

          <br>
             <div> KAYISE IT established 2015 is the go-to tech solutions company for all the IT needs. Our team 
               will ensure you get the best made-to-measure products, services and IT strategies.
               We at KAYISE IT love Technology, through our robust IT services, Office Automation, Network 
               Support, Marketing and digital upskilling, we help our clients achieve their organizations 
               objectives using technology.</div>
          <br>
               <div><h1>Vision</h1></div>

          <br>
             <div> KAYISE IT create integrated digital Eco-system for organizations, communities across South Africa</div>

             <br>
               <div><h1>Mission</h1></div>

          <br>
             <div> Develop efficient & effective digital projects with knowledge from a creative team of Business 
Analysts, Solutions Architect & Graphics designers so that our clients grow their business.
Equip the Youth of South Africa with relevant outcome based programs in the ICT sector</div>

          </div>
        </div>
    </div>

    @include('services-section')


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