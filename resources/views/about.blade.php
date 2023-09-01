<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
  @php
  $metaTitle = "About - We Specialize In Custom Tailored I.T Solutions.";
  $metaDescription = "Empowering South African organizations and communities with an Integrated Digital Ecosystem through reliable IT Services.";
  $metaKeywords = "IT Company, Computers and Information Technology, Software, Technology, ICT, Nelspruit, South Africa, Near Me, IT Companies South Africa";
  @endphp
  @endsection
  <!-- Page Body -->
  <!-- Hero banner -->
  <section id="hero-banner">
    <x-hero-banner hero="about-hero" title="Our Company" />
  </section>

  <!-- About-us -->
  <section id="about-us">
    @include('_about')
  </section>
  <!-- Vision and Mission -->
  <section class="py-5 bg-blue-400 max-w-7xl mx-auto sm:px-6 lg:px-8" id="vision-mission">
    <x-titlestyle smheading="Our Culture" bgheading="Our Fundamental Business" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
    <div class="grid grid-cols-2 gap-4">
      <div class="bg-white rounded-lg">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h3 class="card-title text-2xl pt-3 font-bold text-center smalltxt">Vision</h3>
            </div>
          </div>
          <p class="card-text text-center text-base">KAYISE IT: Empowering South African organizations and communities with an integrated digital ecosystem through reliable IT services, automation, network support, and digital upskilling.</p>
        </div>
      </div>
      <div class="bg-white rounded-lg">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h3 class="card-title text-2xl pt-3 font-bold text-center smalltxt">Mission</h3>
            </div>
          </div>
          <p class="card-text text-center text-base">Empowering South African youth with ICT skills, while delivering innovative digital solutions that accelerate business growth.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Clients -->
  <section id="our-clients">
    <x-clients></x-clients>
  </section>
</x-app-layout>
<script>
  $(document).ready(function() {
    $(".owl-carousel").owlCarousel({
      autoplay: true,
      loop: true,
      dots: false,
      autoplayTimeout: 2000, // Set autoplay delay to 5 seconds
      smartSpeed: 2000, // Set slide speed to 1 second
      responsive: {
        0: {
          items: 2
        },
        768: {
          items: 3
        },
        900: {
          items: 4
        },
      }

    });
  });
  AOS.init();
</script>