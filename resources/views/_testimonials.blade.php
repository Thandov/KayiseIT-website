<!-- Section: Testimonials -->
<section class="bg-slate-100 mx-auto py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
    <x-titlestyle smheading="What People Say" bgheading="Client Testimonials" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
    <p class="mb-10 text-center">We hope that our clients' experiences will help you make an informed decision.</p>
    <!--Carousel-->
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-96 overflow-hidden md:h-60">
            <!-- Item 1 -->
            @foreach($testimonials as $testimonial)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <!--Content-->
                    <div class="max-w-md mx-auto py-3 md:p-14 bg-white shadow-md md:max-w-2xl rounded-md">
                        <div class="md:flex space-x-9 p-4">
                            <div class="md:shrink-0 flex justify-center items-center">
                                <img class="h-28 w-28 object-cover md:h-28 md:w-28 rounded-full shadow-md" src="{{ asset('images/testimonials/'.$testimonial->icon) }}" alt="Kayise IT Testimonial Pic" />
                            </div>
                            <div class="">
                                    @php
                                        $avg_rating = DB::table('testimonials')->where('id',$testimonial->id)->avg('ratings');
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++) @if($i <=$avg_rating) 
                                            <i class="fas fa-star bigtxt"></i>
                                        @else
                                            <i class="far fa-star bigtxt"></i>
                                        @endif
                                    @endfor
                                <p class="mt-2 text-sm">{{ $testimonial['testimony'] }}</p>
                                <p class="mt-3 smalltxt"><strong>{{ $testimonial['name'] }}</strong></p>
                                <!-- <p>Position</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-0 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls 
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>-->
    </div>
</section>