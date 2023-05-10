<x-app-layout>
  <x-hero-banner hero="about-hero" title="Our Company" />
   @include('_about')
  <div class="bg-white">
    <div class="container p-5" id="culture">
      <x-titlestyle smheading="Our Culture" bgheading="Our Fundamental Business" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
      <div class="card-container flex flex-wrap justify-center pt-10 md:justify-start gap-10 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="card" style="width: 30rem;">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <h3 class="card-title text-2xl pt-3 font-bold text-center smalltxt">Vision</h3>
              </div>
            </div>
            <p class="card-text text-center fs-6">KAYISE IT: Empowering South African organizations and communities with an integrated digital ecosystem through reliable IT services, automation, network support, and digital upskilling.</p>
          </div>
        </div>
        <div class="card" style="width: 30rem">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <h3 class="card-title text-2xl pt-3 font-bold text-center smalltxt">Mission</h3>
              </div>
            </div>
            <p class="card-text text-center fs-6">Empowering South African youth with ICT skills, while delivering innovative digital solutions that accelerate business growth.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Our team-->
  @include ('components.our-team')
  <x-clients></x-clients>
</x-app-layout>
<script>
  $(document).ready(function() {
    $(".owl-carousel").owlCarousel({
      autoplay: true,
      loop: true,
      autoplayTimeout: 2000, // Set autoplay delay to 5 seconds
      smartSpeed: 2000, // Set slide speed to 1 second
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        900: {
          items: 4
        },
      }

    });
  });
  AOS.init();
</script>