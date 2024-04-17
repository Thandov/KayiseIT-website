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
  <section class="py-5 bg-slate-100 sm:px-6 lg:px-8" id="vision-mission">
    <x-titlestyle smheading="Our Culture" bgheading="Our Fundamental Business" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4 mx-5">
      <div class="flex items-center bg-white rounded-lg shadow p-4 h-64">
        <div>
          <h3 class="card-title text-2xl font-bold text-center smalltxt mb-3">Vision</h3>
          <p class="card-text text-center text-base">Empowering South African organizations and communities with an integrated digital ecosystem through reliable IT services, automation, network support, and digital upskilling.</p>
        </div>
      </div>
      <div class="flex items-center bg-white rounded-lg shadow p-4 h-64">
        <div>
          <h3 class="card-title text-2xl font-bold text-center smalltxt mb-3">Mission</h3>
          <p class="card-text text-center text-base">Empowering South African youth with ICT skills, while delivering innovative digital solutions that accelerate business growth.</p>
        </div>
      </div>
  </section>

  <section class="py-5 bg-white sm:px-6 lg:px-8" id="partners">
    <x-titlestyle smheading="Meet Our" bgheading="Partners" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
    <div class="justify-center flex-wrap my-4" id="client_logo_carousel">
      <div class="m-5">
        <img class="mx-auto" src="../images/partners/partner1.jpg" style="height: 150px;">
        <p class="text-center my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="m-5">
        <img class="mx-auto" src="../images/partners/ehlanzeni.png" style="height: 150px;">
        <p class="text-center my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
  </section>

  <!-- Our Clients -->
  <!-- <section id="our-clients">
    <x-clients></x-clients>
  </section> -->
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
</script>