<x-app-layout>
    <section id="hero-banner">
        <!-- Meta tags -->
        @section('meta')
        @php
        $metaTitle = "About - We Specialize In Custom Tailored I.T Solutions.";
        $metaDescription = "Empowering South African organizations and communities with an Integrated Digital Ecosystem through reliable IT Services.";
        $metaKeywords = "IT Company, drones, kayiseit, kayise, mictseta, stem, robotics, science, technology, Computers and Information Technology, Software, Technology, ICT, Nelspruit, South Africa, Near Me, IT Companies South Africa";
        @endphp
        @endsection
        <x-hero-banner hero="drone-hero" title="2024/2025 Internship Programme" />
    </section>

    <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
        <div class="row">
            <div class="col-12 text-2 d-flex align-items-center">
                <div>
                    <x-titlestyle smheading="2024/2025" bgheading="Internship Programme" alignment="text-left" smheadingcolor=" " bgheadingcolor=""></x-titlestyle>
                    <p id="black-text" class="text-base mt-4 mb-4"><span class="text-blue-700 font-bold">Apply To Be Part Of Our Team!</span>
                        <br>
                        <br>
                        Internship Description:
                        <br>
                        <br>
                        Requirements:
                        <br>
                        <br>
                        Duration:
                        <br>
                        <br>
                        Closing Date:
                    </p>

                    @if(Auth::check())
                    <a href="{{ route('internship_application') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                    @else
                    <a href="{{ route('registerintern') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>