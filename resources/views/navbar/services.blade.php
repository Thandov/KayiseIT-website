<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('OUR SERVICES') }}
        </h2>
    </x-slot>


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

    <h2 class="text-center font-bold text-xl md:text-xl">Kayise IT Services</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 my-5 gap-4 md:gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach($services as $service)
    <a href="{{ url('viewservice/'.$service->id) }}">

    <div class="card" style="width: 15rem;">
       <img src="{{ asset('images/service_logo/'.$service->logo)}}" class="card-img-top" alt="...">
       <div class="card-header">
       <h5 class="text-center font-bold text-2xl md:text-3xl">{{$service['name']}}</h5>
      </div>
    </div>
    </a>

@endforeach

</div>

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