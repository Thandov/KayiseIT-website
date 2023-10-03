   <div class="webmockup">
       <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[250px] md:max-w-[412px]">
           <div class="rounded-lg overflow-hidden h-[156px] md:h-[230px] bg-white dark:bg-gray-800">
               <div class="content h-100">
                   @php
                   $slides = App\Models\Carousel::select('title', 'middletxt', 'btmtxt', 'image')->get();
                   @endphp

                   <div class="owl-carousel owl-theme" id="headercara">
                       @foreach ($slides as $slide)
                       <x-carousel-item pic="{{$slide->image ?? ''}}" topTitle="{{$slide->title ?? ''}}" mainTitle="{{$slide->middletxt ?? ''}}" bottomTitle="{{$slide->btmtxt ?? ''}}" />
                       @endforeach
                   </div>
               </div>
           </div>
       </div>
       <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[497px]">
           <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
       </div>
   </div>

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