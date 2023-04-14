<x-app-layout>
   <x-hero-banner hero="about-hero" title="{{$service['name']}}"></x-hero-banner>
   <div class="grid grid-cols-1 md:grid-cols-7 gap-8 py-12 px-4 md:px-8 max-w-screen-xl mx-auto">
      <div class="col-span-1 md:col-span-5">
         <!-- Content for left column -->
         <h1 class="text-3xl font-bold mb-8">{{$service['name']}}</h1>
         <p class="text-justify text-gray-600 mb-8">{{$service['description']}}</p>



        <div class="row">
            @foreach($subservices as $subservice)
            <div class="col-md-4 col-sm-6 mb-4 align-items-center">
               <a href="{{ url('viewsubservice/'.$subservice->id) }}" id="quotation-btn">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <img src="{{ asset('images/service_logo/'.$subservice->icon)}}">
                        </div>
                        <h3 class="text-2xl text-center pt-3 font-bold">{{$subservice['name']}}</h3>
                     </div>
                  </div>
               </a>
            </div>
            @endforeach
         </div>
		</div>
      <div class="col-span-2 md:col-span-2 grid grid-rows-2 gap-4">
         <div class="col-span-2 bg-white rounded-lg shadow-sm p-4 w-full max-w-md">
            <!-- Content for top row -->
            testimonials



                    <div class="owl-carousel">
                        @foreach($testimonials as $testimonial)
                        <div>
                           <div class="col-12">
                            <div class="card border-0" style="width: 400px;">
                                <div class="card-body">
                                    <div class="row mx-4">
                                        <div class="rating text-center">
                                            <span class="text-muted"></span>
                                            @php
                                            $avg_rating = DB::table('testimonials')->where('id',
                                            $testimonial->id)->avg('ratings');
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++) @if($i <=$avg_rating) <i class="fas fa-star"></i>
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                                @endfor
                                        </div>
                                        <p class="card-text py-3 fs-6">
                                            {{ $testimonial['testimony'] }}
                                        </p>
                                        <div class="col-4">
                                            <img src="{{ asset('images/testimonials/'.$testimonial->icon) }}" class="rounded-circle" style="width: 50px; height: 50px; ">
                                        </div>
                                        <div class="col-8">
                                            <h3 class="card-title text-1xl pt-4 font-bold">
                                                {{ $testimonial['name'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
<style>
   .row img{
      height: 50px;
   }

   .card {
  height: 150px; /* Set a fixed height for each card */
}
</style>
<script>
   $(document).ready(function() {
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