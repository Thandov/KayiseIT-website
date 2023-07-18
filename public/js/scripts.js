var csrfToken = $('meta[name="csrf-token"]').attr('content');
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

function save_to_db(data) {
    var details = JSON.stringify(data);
    document.getElementById("paypal_response").value = details;
    $('#paypal_form').submit();

}

$(window).on("load", function () {
    "use strict";
    var owl = jQuery('#headercara');
    owl.owlCarousel({
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
        autoplayTimeout: 12000,
        autoplayHoverPause: false,
    });
    owl.on('changed.owl.carousel', function (event) {
        var item = event.item.index - 2; // Position of the current item
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

    var totalUSD = $('#paypal-button-container').data('total-usd');
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalUSD.toFixed(2) // Replace with the actual payment amount
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                // Perform necessary actions after payment completion
                // For example, show a success message, save the transaction details, etc.

                if (details['status'] == "COMPLETED") {
                    save_to_db(details);
                    // Show the success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Payment was successful!',

                    })


                } else {
                    //this is where we put the code to notify the user that the code was not completed
                }

            });
        }
    }).render('#paypal-button-container');

});
