import $ from 'jquery';
window.$ = window.jQuery = $;

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
// For Employees
$(document).on('click', '.pagination-employees a', function (event) {
    event.preventDefault();
    let page = $(this).attr('href').split('employeePage=')[1];
    fetchList('employees', page);
});

// For Carousel
$(document).on('click', '.pagination-carousel a', function (event) {
    event.preventDefault();
    let page = $(this).attr('href').split('carouselPage=')[1];
    fetchList('carousel', page);
});

function fetchList(listType, page) {
    $.ajax({
        url: `/dashboard/${listType}?page=${page}`,
        type: "get",
        dataType: "json",
        success: function (data) {
            $(`.${listType}-container`).html(data.html); // Update the list container
            $(`.pagination-${listType}`).html(data.pagination); // Update the pagination links
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + status + "\nError: " + error);
        }
    });
}

document.addEventListener("click",  function (event) {
    let target = event.target;
    while (target != document && !target.classList.contains('add-client-btn') && !target.classList.contains('return-btn')) {
        target = target.parentNode;
    }

    if (target.classList.contains('add-client-btn')) {
        event.preventDefault();
        slideBoxes('right');
    } else if (target.classList.contains('return-btn')) {
        event.preventDefault();
        slideBoxes('left');
    }
});

function slideBoxes(direction) {
    var boxes = document.querySelectorAll(".custom-container .box");
    var currentIndex = 0; // Index of the current visible box

    // Find the current visible box
    boxes.forEach(function (box, index) {
        var computedStyle = window.getComputedStyle(box);
        if (computedStyle.transform === 'none' || computedStyle.transform.includes('matrix(1, 0, 0, 1, 0, 0)')) {
            currentIndex = index;
        }
    });

    // Calculate the next index based on direction
    var nextIndex = direction === 'right' ? currentIndex + 1 : currentIndex - 1;

    // Boundary checks
    if (nextIndex >= boxes.length) nextIndex = 0;
    if (nextIndex < 0) nextIndex = boxes.length - 1;

    // Slide out the current box and slide in the next box
    boxes[currentIndex].style.transform = direction === 'right' ? "translateX(-100%)" : "translateX(100%)";
    boxes[nextIndex].style.transform = "translateX(0)";
}




