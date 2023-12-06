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
    <div class="container my-5">
        <div class="row">
            <div class="col grid justify-content-center">
                <a href="">
                    <div class="card-iot">
                        <img src="/images/icons/drones.png" alt="Image 3" class="w-64 h-full object-cover">
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

</x-app-layout>