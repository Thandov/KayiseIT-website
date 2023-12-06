    <div class="text-gray-500 font-medium max-w-7xl mx-auto py-4 px-6 md:px-6 lg:px-8">
        <x-titlestyle smheading="Our Services" bgheading="What We Offer" alignment="text-center" smheadingcolor=" " bgheadingcolor="text-center"></x-titlestyle>
        <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4 mb-4 mt-2 justify-center">
            @foreach($services as $service)
            @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
            <a href="{{ route('service.show', $slug) }}" class="flex justify-center">
                <div class="bg-white overflow-hidden border border-blue-400 shadow-md rounded-lg w-80 h-30 p-4">
                    <div class="flex justify-center">
                        <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center"><img class="w-12" src="{{ asset('images/service_logo/'.$service->icon) }}"></div>
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
        <!-- <x-front-end-btn linking="services" color="blue" showme="zzzzzz" name="View All" /> -->
    </div>