<x-app-layout>
   <x-hero-banner hero="about-hero" title="{{$service['name']}}"></x-hero-banner>
   <div class="grid grid-cols-1 md:grid-cols-7 gap-8 py-12 px-4 md:px-8 max-w-screen-xl mx-auto">
      <div class="col-span-1 md:col-span-5">
         <!-- Content for left column -->
         <h1 class="text-3xl font-bold mb-8">{{$service['name']}}</h1>
         <p class="text-justify text-gray-600 mb-8">{{$service['description']}}</p>
         <a href="#" class="inline-block py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200">Buy Now</a>
      </div>
      <div class="col-span-2 md:col-span-2 grid grid-rows-2 gap-4">
         <div class="col-span-2 bg-white rounded-lg shadow-sm p-4 w-full max-w-md">
            <!-- Content for top row -->
            testimonials
         </div>
         <div class="col-span-2 bg-white rounded-lg shadow-sm p-4 w-full max-w-md">
            <!-- Content for bottom row -->
            <h3 class="text-gray-600 mb-4 text-lg font-bold">Other Services</h3>
            <ul class="text-gray-600">
               <li class="mb-2">
                  <a href="#">Network Security</a>
               </li>
               <li class="mb-2">
                  <a href="#">Cloud Computing</a>
               </li>
               <li class="mb-2">
                  <a href="#">Backup & Recovery</a>
               </li>
               <li class="mb-2">
                  <a href="#">IT Consulting</a>
               </li>
            </ul>
         </div>
      </div>
   </div>



</x-app-layout>
<script>
   $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
         autoplay: true,
         loop: true,
         items: 1,
         autoplayTimeout: 2000, // Set autoplay delay to 5 seconds
         smartSpeed: 1500 // Set slide speed to 1 second
      });
   });
</script>

<!-- 
      <div class="col-md-10">
      <h2 style="color: #64bc5c" class="text-center mb-4 font-bold text-5xl md:text-5xl"></h2>
      <p style="color: #183ea4" class="text-center mb-2 font-bold md:text-5">{{$service['description']}}</p>
      <div class="d-flex justify-content-center align-items-center">
         <div class="row">
            @foreach($subservices as $subservice)
            <div class="col-md-4 col-sm-6 m-4 align-items-center">
               <a href="{{ url('viewsubservice/'.$subservice->id) }}">

                  <div class="card-container flex flex-wrap justify-center md:justify-start max-w-7xl mx-auto">
                     <div class="card" style="width: 25rem;">
                        <div class="card-body">
                           <div class="row">
                              <img src="{{ asset('images/service_logo/'.$subservice->icon)}}">
                           </div>
                           <h3 class="text-2xl text-center pt-3 font-bold">{{$subservice['name']}}</h3>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            @endforeach
         </div>
      </div>

   </div>
 -->