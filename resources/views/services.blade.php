<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
  @php
  $metaTitle = "Services - Web and App Development, 4IR Skills Training, Tech Support";
  $metaDescription = "Our developers take a pragmatic approach to create tailor-made products that meets our client's specific needs.";
  $metaKeywords = "Services - Web Development, App Development, 4IR Skills Training, Tech Support, IT Company, IT Services, Nelspruit, South Africa, Near Me, IT Companies South Africa";
  @endphp
  @endsection
  <!-- Hero banner -->
  <section id="hero-banner">
    <x-hero-banner hero="service-hero" title="Our Services" />
  </section>

  <!--Featured Services-->
  <section id="featured-services">
    @include('services._services')
  </section>
  <!-- CTA Section -->
  <section id="CTA">
    <div class="grid md:grid-cols-3 grid-cols-1 mt-8 c2a">
      <div class="c2aimgwrap position-relative"><img src="../images/techician.png" alt="Service 1" class="c2acrain"></div>
      <div class="md:col-span-2 col-span-1 px-5 flex items-center justify-start">
        <div class="des">
          <x-titlestyle smheading="Ready to enhance your" bgheading="IT infrastructure" alignment="text-left" smheadingcolor="" bgheadingcolor="text-white"></x-titlestyle>
          <p class="text-black">Contact us now for expert IT support and solutions.</p>
          <x-front-end-btn linking="contact" color="blue" showme="" name="Contact" />
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
</script>