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
        <x-hero-banner hero="drone-hero" title="Drone Workshop 1" />
    </section>

    <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-2 d-flex align-items-center">
                <div>
                    <x-titlestyle smheading="Part 1 - Build a" bgheading="Drone Workshop" alignment="text-left" smheadingcolor=" " bgheadingcolor=""></x-titlestyle>
                    <p id="black-text" class="text-base mt-4 mb-4"><span class="text-blue-700 font-bold">Learn how to build your first drone... and take it home with you!</span>
                        <br>
                        <br>
                        Immerse in a four-hour drone workshop for students, exploring various Drone Zones. Sessions kick off in Mbombela, offering hands-on experiences.
                        <br>
                        <br>
                        Number of students per 4-hour activation: 15 (Grades 5-9).
                        <br>
                        <br>
                        Cost: R599 per student, with a minimum of 10 students per class.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-center rounded-lg border border-1">
                <div class="container my-5">
                    <div class="row">
                        <div class="col grid justify-content-center">
                            <a href="">
                                <div class="card-iot">
                                    <img src="/images/icons/drones.png" alt="Image 3" class="h-72 object-cover">
                                </div>
                            </a>
                            @if(Auth::check())
                            <a href="{{ url('drone_application/drone_reg') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                            @else
                            <a href="{{ route('registerapplicant') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>