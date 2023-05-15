<x-app-layout title="View Services">
    <div id="viewservice">
        <x-hero-banner hero="about-hero" title="{{ $service->name}}"></x-hero-banner>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-8 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="col-span-1 md:col-span-5">
                <!-- Content for left column -->
                <h2 class="font-bold text-5xl mb-8">{{ $service->name}}</h2>
                <p class="text-justify text-base text-gray-600 mb-8">{{ $service->description}}</p>
                <div class="row">
                    @foreach($subservices as $subservice)
                        <div class="col-md-4 col-sm-6 mb-4 align-items-center">
                        @php $slug = str_replace(' ','-', strtolower($service->name));
                        $subslug = str_replace(' ','-', strtolower($subservice->name)) @endphp
                        <a href="{{ url('services/'.$slug.'/'.$subslug) }}">
                            <div class="card h-[200px]">
                                <div class="card-body">
                                    <div class="row">
                                        <img class="h-[50px]" src="{{ asset('images/subservices/'.$subservice->icon) }}">
                                    </div>
                                    <h3 class="text-2xl text-center pt-3 font-bold">{{$subservice->name}}</h3>
                                </div>
                            </div>
                        </a>
                        </div>
                    @endforeach
                </div>
                <div class="data mb-3">
                    <x-front-end-btn href="{{ route('contact') }}">
                        {{ __('Contact Us') }}
                    </x-front-end-btn>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>