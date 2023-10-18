import $ from 'jquery';
window.jQuery = window.$ = $;

import './bootstrap';
import 'sweetalert2/dist/sweetalert2.css';
import Swal from 'sweetalert2/dist/sweetalert2.js';
window.Swal = Swal;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

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

$(function ($) {
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
    // Initial state: Show the first slide and add 'show' class to the first subserv_card
    $(".slide:first").addClass("show");
    $(".subserv_card:first").addClass("show");

    // Handle click event on subserv_card elements
    $(".subserv_card").click(function () {
        var target = $(this).data("target"); // Get the data-target value
        // Hide all slides and remove 'show' class from all subserv_card elements
        $(".slide").removeClass("show");
        $(".subserv_card").removeClass("show");

        // Remove the previously added classes 'border-5' and 'border-green-500' from all subserv_card elements
        $(".subserv_card").removeClass("border-5 border-green-500");

        // Show the selected slide and add 'show' class to the clicked subserv_card
        $("#" + target).addClass("show");
        $(this).addClass("show");

        // Add the 'border-5' and 'border-green-500' classes to the clicked subserv_card
        $(this).addClass("border-5 border-green-500");
    });
});
