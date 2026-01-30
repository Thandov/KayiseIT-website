var csrfToken = $('meta[name="csrf-token"]').attr('content');

// Helper function to handle animation classes
function updateAnimationClasses(event) {
    console.log("Updating animation classes");
    var item = event.relatedTarget.relative(event.item.index); // Correct relative index
    jQuery('p').removeClass('animate__animated animate__fadeInDown');
    jQuery('h1').removeClass('animate__animated animate__fadeInUp');
    jQuery('img').removeClass('animate__animated animate__fadeInDown');
    jQuery('.hero__btn').removeClass('animate__animated animate__fadeInLeft');
    jQuery('.owl-item').not('.cloned').eq(item).find('p').addClass('animate__animated animate__fadeInDown');
    jQuery('.owl-item').not('.cloned').eq(item).find('h1').addClass('animate__animated animate__fadeInUp');
    jQuery('.owl-item').not('.cloned').eq(item).find('img').addClass('animate__animated animate__fadeInUp');
    jQuery('.owl-item').not('.cloned').eq(item).find('.hero__btn').addClass('animate__animated animate__fadeInLeft');
}

// Carousel Initialization
function initializeCarousel() {
    var headerCarousel = jQuery('#headercara');
    headerCarousel.owlCarousel({
        animateOut: 'animate__animated animate__fadeOut',
        animateIn: 'animate__animated animate__fadeIn',
        loop: true,
        responsiveClass: true,
        dots: true,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1,
                nav: false
            }
        },
        autoplay: true,
        autoplayTimeout: 600000,
        autoplayHoverPause: true,
    });

    headerCarousel.on('changed.owl.carousel', function (event) {
        updateAnimationClasses(event);
    });

    var testimonialCarousel = jQuery('#testimonial-carousel');
    testimonialCarousel.owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 6000,
        smartSpeed: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            }
        }
    });

    var galleryCarousel = jQuery('.gallCal');
    galleryCarousel.owlCarousel({
        animateOut: 'animate__animated animate__fadeOut',
        animateIn: 'animate__animated animate__fadeIn',
        loop: true,
        responsiveClass: true,
        dots: true,
        dotsData: true,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1
            }
        },
        autoplay: true,
        autoplayTimeout: 120000,
        autoplayHoverPause: false,
    });
}

$(document).ready(function () {
    "use strict";

    // Initialize Carousels
    initializeCarousel();

    // Initialize Bootstrap Tabs
    $('#myTabs a[data-toggle="tab"]').on('shown.bs.tab', function () {
        $('.nav-scrollable').scrollTop(0); // Reset scroll position
    });
});

// Save to DB function
function save_to_db(data) {
    var details = JSON.stringify(data);
    document.getElementById("paypal_response").value = details;
    $('#paypal_form').submit();
}
