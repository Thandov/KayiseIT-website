<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    <!-- Page Body -->

    <div id="viewservice">
        <x-hero-banner hero="about-hero" title="{{ $services['service'] }}"></x-hero-banner>
        <div class="col-span-1 md:col-span-5">
            <!-- Content for left column -->
            @component('components.' . Str::slug($services['service']))
            @slot('service', $services['service'])
            @slot('subservices', $services['subservices'])
            @endcomponent
        </div>
    </div>
    </div>
</x-app-layout>