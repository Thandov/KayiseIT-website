    <div class="">
        <x-titlestyle smheading="Our Services" bgheading="What We Offer" alignment="text-center" smheadingcolor=" " bgheadingcolor="text-center"></x-titlestyle>
        @php
        $totalServices = count($services);
        // Determine the number of columns based on the total number of services
        if ($totalServices === 1) {
        $gridClass = 'grid-cols-1';
        } elseif ($totalServices === 2) {
        $gridClass = 'grid-cols-2';
        } elseif ($totalServices <= 4) {
            $gridClass='grid-cols-2 md:grid-cols-4' ;
            } else {
            $gridClass='grid-cols-2 md:grid-cols-3 lg:grid-cols-4' ;
            }
            @endphp
            <div class="grid {{ $gridClass }} gap-5 my-4 justify-center">
            @foreach($services as $service)
            @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
            <a href="/contact" style="text-decoration: none;" class="bg-white p-3 flex items-center justify-center overflow-hidden rounded-lg">
                <div>
                    <div class="flex justify-center">
                        <div class="service-icon">
                            {!! get_svg('images/service_logo/'.$service->icon, "sdsdsd") !!}
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="">
                            <h2 class="mt-4 text-xl font-bold smalltxt">{{ $service['name'] }}</h2>
                            <!-- <p class="text-base mt-2">{{ implode(' ', array_slice(explode(' ', $service['description']), 0, 11)) }}...</p> -->
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
    </div>