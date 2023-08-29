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
        <x-hero-banner hero="about-hero" title="{{ $service->name }}"></x-hero-banner>
            <div class="col-span-1 md:col-span-5">
                <!-- Content for left column -->
                @component('components.' . Str::slug($service->name))
                    @slot('service', $service)
                    @slot('subservices', $subservices)
                @endcomponent
            </div>
        </div>
    </div>
</x-app-layout>
