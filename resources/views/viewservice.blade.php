<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    <!-- Page Body -->

    <div id="viewservice">
        <x-hero-banner hero="service-hero" title="{{ $services['service'] }}"></x-hero-banner>
        <div class="col-span-1 md:col-span-5">
            <!-- Content for left column -->
            @php
                $componentName = 'components.' . Str::slug($services['service']);
                $componentExists = view()->exists($componentName);
            @endphp
            @if($componentExists)
                @component($componentName)
                @slot('service', $services['service'])
                @slot('subservices', $services['subservices'])
                @endcomponent
            @else
                <div class="container grid sm:grid-flow-row md:grid-cols-1 pb-4">
                    <div class="px-4 mt-4">
                        <x-titlestyle smheading="Transform Your" bgheading="Business!" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                        <p class="text-left">{{ $services['service'] }} - We provide comprehensive solutions tailored to your business needs.</p>
                        <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 my-4">
                            @foreach($services['subservices'] ?? [] as $subservice)
                            @php
                            $slug = str_replace(' ','-', strtolower($services['service']));
                            $subslug = str_replace(' ','-', strtolower($subservice['subservice_name'] ?? ''));
                            $uniqueId = "subserv_card_" . $subslug;
                            @endphp
                            <div class="subserv_card justify-center" id="{{ $uniqueId }}" data-target="slide_{{$subslug}}">
                                <div class="overflow-hidden shadow-md rounded-lg p-4">
                                    <div class="flex justify-center">
                                        <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center">
                                            @if(isset($subservice['icon']))
                                            <img class="w-12" src="{{ asset('images/subservices/'.$subservice['icon']) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{ $subservice['subservice_name'] ?? 'Subservice' }}</h2>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
</x-app-layout>