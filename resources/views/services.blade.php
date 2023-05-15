<x-app-layout title="Services">
  <!-- Hero banner -->
<section id="hero-banner">
  <x-hero-banner hero="service-hero" title="Our Services"/>
</section>
<!--Featured Services-->
<section id="featured-services">
  @include('services._services')
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