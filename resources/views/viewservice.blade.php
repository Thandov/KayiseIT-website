<x-app-layout>
   
   
            

   <div class="container py-20">
      <div class="row justify-content-center align-items-center">
         <div class="col-md-10">

         <h2 style="color: #64bc5c" class="text-center mb-4 font-bold text-5xl md:text-5xl">{{$service['name']}}</h2>
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
      </div>
   </div>

   <!--Contact-->
   <section class="contact-us">
				<div class="contact">
					
					<div class="text-3">
						
						<h2>Ready For Awesome Project With Us?</h2>
						<h3>Let's Talk About Your Project.</h3>
						<div class="data">
							<a href="navbar/contact" class="hire-1">Contact Us</a>
						</div>
					</div>
					
					<img src="../Images/ContactImg.jpg" class="pic-3">
					
				</div>
			</section>
</x-app-layout>

<style>
   .row img{
      height: 50px;
   }

   .card {
  height: 200px; /* Set a fixed height for each card */
}
</style>