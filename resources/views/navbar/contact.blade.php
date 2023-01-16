<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CONTACT US') }}
        </h2>
    </x-slot>

    <div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <img src="/images/logo.png" alt="logo" srcset="/images/logo.svg"
            class="landinglogo animate__animated animate__fadeInUp">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/landing-page/banner1.png" topTitle="Get In Touch" mainTitle="Contact Us"
                bottomTitle="dddd" />
            <x-carousel-item pic="../images/landing-page/banner2.png" topTitle="Get A Quote"
                mainTitle="For A Software" bottomTitle="dddd" />
            <x-carousel-item pic="../images/landing-page/banner3.png" topTitle="Get A Quote"
                mainTitle="For A Website" bottomTitle="asd" />
        </div>
    </div>

    <div class="container ">
        <div class="row m-5">
          <div class="col text-center">

                  
        
    
                  <div class="mb-3 ">
                      <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('CONTACT US') }}</h1>
                  </div>          

                  <div class="mb-3 ">
                      <p>info@kayiseit.co.za</p>
                  </div>
                  <div class="mb-3 ">
                      <p>+27 87 702 2625</p>
                  </div>
                  <div class="mb-3 ">
                      <p>39B Brown street, Mbombela</p>
                  </div>
                  <div class="mb-3 ">
                      <p>Nelbro Building, 2nd Floor, Office 02</p>
                  </div>
            
          </div>
          <div class="col">


                  <div class="mb-3">
                      <h1>Send Us A Message</h1>
                  </div>
            
                  <div class="mb-3 ">
                      <input type="text" class="form-control" id="fullnames" placeholder="full name">
                  </div>
                  <div class="mb-3">
                      <input type="email" class="form-control" id="emailAddress" placeholder="email">
                  </div>
                  <div class="mb-3">
                      <textarea class="form-control" id="TextArea" placeholder="Message" rows="3"></textarea>
                  </div>
                    
                  <div class="col-12">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Send Message</button>
                  </div>
          <!--  <div class="row m-3">

              <div class="col">
                
                <div class="address mb-1">
                   <h3>Located In:</h2>
                </div>
                <div>
                  <p>Mpumalanga, Mbombela</p>
                </div>
              </div>

              <div class="col">

                <div class="email">
                  <h3>Email Address:</h2>
                </div>
                <div>
                  <p>info@autotenhle.co.za</p>
                </div>

              </div>
            <div class="map">
                
              <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.
                11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024
                !2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen
                !2sza!4v1668003382879!5m2!1sen!2sza" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
             
          </div>
        </div> -->
        </div>
      </div>

      <div class="map m-5">
                
              <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.
                11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024
                !2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen
                !2sza!4v1668003382879!5m2!1sen!2sza" width="1400" height="300" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>           
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