<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Testimonials') }}
        </h2>
    </x-slot>

    <div class="row m-2">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-start">
                 <a href="addtestimony" class="btn btn-primary me-3">ADD Testimonial</a>
                 </div>
             </div>
         </div>

         <div class="testimonial pt-20">
  <div class="row justify-content-center">
    <div class="col-md-10 mb-20">

      <p class="text-center mb-4 font-bold text-success md:text-5">Testimonials</p>
      <div class="row justify-content-center">
        @foreach($testimonials as $testimonial)
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card border-success border" style="width: 25rem">
            <div class="card-body">
              <div class="row mx-4">
                <div class="rating text-center">
                  <span class="text-muted"></span>
                  @php
                    $avg_rating = DB::table('testimonials')->where('id', $testimonial->id)->avg('ratings');
                  @endphp
                  @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $avg_rating)
                      <i class="fas fa-star"></i>
                    @else
                      <i class="far fa-star"></i>
                    @endif
                  @endfor
                </div>
                <p class="card-text py-3">{{$testimonial['testimony']}}</p>
                <div class="col-4">
                  <img src="{{ asset('images/testimonials/'.$testimonial->icon)}}" class="rounded-circle  img-thumbnail" style="width: 80px; height: 80px;">
                </div>
                <div class="col-8">
                  <h3 class="card-title text-1xl pt-4 font-bold">{{$testimonial['name']}}</h3>
                </div>
                        <div class="row">
                               <div class="col">
                                  <a href="{{ url('admin/viewtestimonial/'.$testimonial->id) }}" style="width: 7rem;" class="btn btn-success">Edit</a>
                               </div>
                               <div class="col">
                                  <a href="{{ url('testimonial/delete/'.$testimonial->id) }}" style="width: 7rem;" class="btn btn-danger">Delete</a>
                               </div> 
                        </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</div>



</x-app-layout>

<style>


.card {
  height: 250px; /* Set a fixed height for each card */
}
.card-img {
  height: 100%; /* Make the image fill the entire height of the card */
  object-fit: cover; /* Scale the image while maintaining its aspect ratio */
}

.testimonial .card {
  height: auto; /* Set a fixed height for each card */
}

</style>