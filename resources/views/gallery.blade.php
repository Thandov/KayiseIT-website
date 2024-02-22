<x-app-layout>
    <section id="hero-banner">
        <x-hero-banner hero="gallery-hero" title="Our Gallery" />
    </section>

    <!--Featured Services-->
    <section class="gallery-front mb-5">
        <x-titlestyle smheading="Gallery" bgheading="Some Of Our Memories" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
        <div class="flex justify-center">
            <div class="w-10/12">
                @include('admin.dashboard.gallery._gallery')
            </div>
        </div>
    </section>

</x-app-layout>