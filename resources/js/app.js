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
function deleteSelected() {
    const selectedIds = document.querySelectorAll('input[name="selected_ids[]"]:checked');
    const selectedIdsArray = Array.from(selectedIds).map(input => input.value);
    document.getElementById('selected-ids-input').value = JSON.stringify(selectedIdsArray);
    document.getElementById('delete-selected-form').submit();
}

function deleteRow(service_id) {
    if (confirm('Are you sure you want to delete this service?')) {
        // Create a form element and submit it to delete the individual row
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "/dashboard/services/deleteservice/" + service_id; // Use string concatenation
        form.innerHTML = `
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">`;
        document.body.appendChild(form);
        form.submit();
    }
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
    $('#checkbox-all').click(function () {
        // Check or uncheck all checkboxes based on the state of the checkbox-all.
        $('.checkbox').prop('checked', this.checked);
    });

    // Event listener for pagination links
    $(document).on('click', '.pagination-links a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchCarousels(page);
    });

    function fetchCarousels(page) {
        $.ajax({
            url: '/dashboard?page=' + page,
            type: "get",
            dataType: "json",
            success: function (data) {
                $('.carousel-container').html(data.html); // Update the carousel container
                $('.pagination-links').html(data.pagination); // Update the pagination links
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + status + "\nError: " + error);
            }
        });
    }
    document.getElementById("add-client-btn").addEventListener("click", function (event) {
        event.preventDefault();
        slideBoxes('right');
    });

    document.getElementById("return-btn").addEventListener("click", function (event) {
        event.preventDefault();
        slideBoxes('left');
    });

    function slideBoxes(direction) {
        var boxA = document.getElementById("boxA");
        var boxB = document.getElementById("boxB");

        if (direction === 'right') {
            boxA.style.transform = "translateX(-100%)";
            boxB.style.transform = "translateX(0)";
        } else {
            boxA.style.transform = "translateX(0)";
            boxB.style.transform = "translateX(100%)";
        }
    }

});

