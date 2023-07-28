<!-- It is never too late to be what you might have been. - George Eliot -->
<!-- content -->
<div class="max-w-md mx-auto py-3 md:p-14 bg-white shadow-md md:max-w-2xl rounded-md">
    <div class="md:flex space-x-9 p-4">
        <div class="md:shrink-0 flex justify-center items-center">
            <div class="h-28 w-28">
                <img class="h-28 w-28 object-cover md:h-28 md:w-28 rounded-full shadow-md" src="{{ asset('images/testimonials/'.$testimonial->icon) }}" alt="Kayise IT Testimonial Pic" />
            </div>
        </div>
        <div>
            <div class="mt-3 md:mt-0">
                @php
                $avg_rating = DB::table('testimonials')->where('id',$testimonial->id)->avg('ratings');
                @endphp
                @for($i = 1; $i <= 5; $i++) @if($i <=$avg_rating) <i class="fas fa-star bigtxt"></i>
                    @else
                    <i class="far fa-star bigtxt"></i>
                    @endif
                    @endfor
            </div>
            <div class="">
                <p class="mt-2 text-sm">{{ $testimonial['testimony'] }}</p>
            </div>
            <p class="mt-3 smalltxt"><strong>{{ $testimonial['name'] }}</strong></p>
        </div>
    </div>
</div>