<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "$service->name";
    $metaDescription = "$service->description";
    $metaKeywords = "$service->name, IT Company, Computers and Information Technology, Software, Technology, ICT, IT Services, Nelspruit, Near Me";
    @endphp
    @endsection
    <!-- Page Body -->
    <div id="viewservice">
        <x-hero-banner hero="about-hero" title="{{ $service->name}}"></x-hero-banner>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-8 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="col-span-1 md:col-span-5">
                <!-- Content for left column -->
                <h2 class="font-bold text-5xl mb-8">{{$service->name}}</h2>
                <p class="text-justify text-base text-gray-600 mb-8">{{ $service->description}}</p>

                <div class="flex justify-center">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 justify-center">
                        @foreach($subservices as $subservice)
                        @php $slug = str_replace(' ','-', strtolower($service->name));
                        $subslug = str_replace(' ','-', strtolower($subservice->name)) @endphp
                        <a href="{{ url('services/'.$slug.'/'.$subslug) }}" class="flex justify-center">
                            <div class="subserv_card bg-white overflow-hidden shadow-md rounded-lg w-80 h-48 p-4">
                                <div class="flex justify-center">
                                    <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center"><img class="w-12" src="{{ asset('images/subservices/'.$subservice->icon) }}"></div>
                                </div>
                                <div class="flex justify-center">
                                    <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{$subservice->name}}</h2>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="data my-4">
                    <x-front-end-btn href="{{ route('contact') }}">
                        {{ __('Contact Us') }}
                    </x-front-end-btn>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>