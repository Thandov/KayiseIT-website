<x-app-layout>
    <x-hero-banner hero="about-hero" title="{{ $service['name'] }}"></x-hero-banner>
    <div class="grid grid-cols-1 md:grid-cols-7 gap-8 py-12 px-4 md:px-8 max-w-screen-xl mx-auto">
        <div class="col-span-1 md:col-span-5">
            <!-- Content for left column -->
            <h1 class="text-3xl font-bold mb-8">{{ $service['name'] }}</h1>
            <p class="text-justify text-gray-600 mb-8">{{ $service['description'] }}</p>



            <div class="row">
                @foreach($subservices as $subservice)
                    <div class="col-md-4 col-sm-6 mb-4 align-items-center">
                        <!--   <a href="{{ url('viewsubservice/'.$subservice->id) }}" id="quotation-btn"> -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <img
                                        src="{{ asset('images/subservices/'.$subservice->icon) }}">
                                </div>
                                <h3 class="text-2xl text-center pt-3 font-bold">
                                    {{ $subservice['name'] }}</h3>
                            </div>
                        </div>
                        <!--   </a> -->
                    </div>
                @endforeach
            </div>
            <div class="data">
                <a href="/contact" id="btn-primary"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Contact
                    Us</a>
            </div>
        </div>
        
    </div>




</x-app-layout>
<style>
    .row img {
        height: 50px;
    }

    .card {
        height: 200px;
        /* Set a fixed height for each card */
    }

</style>
<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            autoplay: true,
            loop: true,
            items: 1,
            autoplayTimeout: 5000, // Set autoplay delay to 5 seconds
            smartSpeed: 1500 // Set slide speed to 1 second
        });
    });
    AOS.init();
    //modal
    /*
    document.querySelector('#quotation-btn').addEventListener('click', function(e) {
         e.preventDefault();
         // your code here
         $('#myModal').modal('show');
     });
     document.querySelector('.close').addEventListener('click', function(e) {
         e.preventDefault();
         // your code here
         $('#myModal').modal('hide');
     });
     */

</script>

<!-- 
      <div class="col-md-10">
      <h2 style="color: #64bc5c" class="text-center mb-4 font-bold text-5xl md:text-5xl"></h2>
      <p style="color: #183ea4" class="text-center mb-2 font-bold md:text-5">{{ $service['description'] }}</p>
      <div class="d-flex justify-content-center align-items-center">
         <div class="row">
@foreach($subservices as $subservice)
            <div class="col-md-4 col-sm-6 m-4 align-items-center">
               <a href="{{ url('viewsubservice/'.$subservice->id) }}">

                  <div class="card-container flex flex-wrap justify-center md:justify-start max-w-7xl mx-auto">
                     <div class="card" style="width: 25rem;">
                        <div class="card-body">
                           <div class="row">
                              <img src="{{ asset('images/service_logo/'.$subservice->icon) }}">
                           </div>
                           <h3 class="text-2xl text-center pt-3 font-bold">{{ $subservice['name'] }}</h3>
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
