<!-- Section: Testimonials -->
<section class="mt-20 mb-20">
    <x-titlestyle smheading="What People Say" bgheading="Client Testimonials" alignment="text-center" smheadingcolor=""
        bgheadingcolor=""></x-titlestyle>
    <p class="mb-10 text-center">Below are a few statements from our clients sharing their experiences and feedback</p>
    <!--Carousel-->
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            @foreach($testimonials as $testimonial)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <!--Content-->
                <div class="container flex justify-center px-8">
                        <div class="columns-2 border bg-white drop-shadow-lg w-1/2 p-4 flex justify-center">
                            <div class="container flex align-center border ">
                                <img class="mx-auto mb-6 rounded-full shadow-lg" src="{{ asset('images/testimonials/'.$testimonial->icon) }}" alt="avatar" style="width:120px; height:120px" />
                            </div>
                            <div class="container border text-left">
                                    @php
                                        $avg_rating = DB::table('testimonials')->where('id',$testimonial->id)->avg('ratings');
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++) @if($i <=$avg_rating) 
                                            <i class="fas fa-star bigtxt"></i>
                                        @else
                                            <i class="far fa-star bigtxt"></i>
                                        @endif
                                    @endfor
                                <p class="mt-1">{{ $testimonial['testimony'] }}</p>
                                <p class="mt-3 smalltxt"><strong>{{ $testimonial['name'] }}</strong></p>
                                <p>Position</p>
                            </div>
                        </div>
                </div>
        </div>
            @endforeach
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</section>
