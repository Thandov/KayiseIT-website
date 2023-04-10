<x-app-layout title="Home">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <img src="/images/logo.png" alt="logo" srcset="/images/logo.png" class="landinglogo animate__animated animate__fadeInUp">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/carousel/banner1.png" topTitle="Aaaa" mainTitle="asasA" bottomTitle="dddd" />
            <x-carousel-item pic="../images/carousel/banner2.png" topTitle="We specialize" mainTitle="Commercial Cleaning" bottomTitle="dddd" />
            <x-carousel-item pic="../images/carousel/banner3.png" topTitle="We specialize" mainTitle="Event Cleaning" bottomTitle="asd" />
        </div>
    </div>


    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <h2 class="text-center font-bold text-2xl md:text-3xl">Kayise IT Services</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-service-card href="services/software" pic="soft1.png" servicename="Software Development" />
            <x-service-card href="services/website" pic="web2.png" servicename="Website Development" />
            <x-service-card href="services/kit" pic="kit.png" servicename="KIT Invoicing Software" />

        </div>
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