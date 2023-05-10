<x-app-layout>
    <div id="viewservice">
        <x-hero-banner hero="about-hero" title="{{ $service['name'] }}"></x-hero-banner>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-8 py-12 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="col-span-1 md:col-span-5">
                <!-- Content for left column -->
                <h1 class="text-3xl font-bold mb-8">{{ $service['name'] }}</h1>
                <p class="text-justify text-gray-600 mb-8">{{ $service['description'] }}</p>

                <div class="row">
                    @foreach($subservices as $subservice)
                    <div class="col-md-4 col-sm-6 mb-4 align-items-center">
                        <!--   <a href="{{ url('viewsubservice/'.$subservice->id) }}" id="quotation-btn"> -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <img src="{{ asset('images/subservices/'.$subservice->icon) }}">
                                </div>
                                <h3 class="text-2xl text-center pt-3 font-bold">
                                    {{ $subservice['name'] }}
                                </h3>
                            </div>
                        </div>
                        <!--   </a> -->
                    </div>
                    @endforeach
                </div>
                <div class="data">
                    <a href="/contact" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Contact
                        Us</a>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>