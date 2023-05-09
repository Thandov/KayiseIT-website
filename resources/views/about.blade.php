<x-app-layout>
  <x-hero-banner hero="about-hero" title="Our Company" />
<!-- 
  <div class="container p-5" id="company">
    <div class="row flex flex-wrap justify-center">
      <div class="col-md-6 sm-col-12">
        <x-titlestyle smheading="About Us" bgheading="We Specialize In Custom Tailored I.T Solutions." alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
        <p class="fs-6">KAYISE IT established 2015 is the go-to tech solutions company for all your IT needs. Our team will ensure you get the best made-to-measure products, services and IT strategies. We at KAYISE IT love Technology, through our robust IT services, Office Automation, Network Support, Marketing and digital upskilling, we help our clients achieve their organizations objectives using technology.</p>
        <x-front-end-btn href="{{ route('services') }}">
          {{ __('Discover More') }}
        </x-front-end-btn>
      </div>
      <div class="col-md-6 col-sm-12  position-relative d-flex justify-content-center">
        <img src="../images/contact.jpg" width="400" class="rounded shadow-lg" style="position: absolute; top: -100px;">
      </div>
    </div>
  </div>
  </div>
   -->
   @include('_about')
  <div class="bg-grey">
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