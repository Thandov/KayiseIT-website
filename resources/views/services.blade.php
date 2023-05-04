<x-app-layout>
<x-hero-banner hero="service-hero" title="Our Services"/>
@include('services._services')
    <x-clients />
</x-app-layout>

<style>
.card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5); /* change the opacity value to adjust the darkness */
}
</style>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            autoplay: true,
            loop: true,
            dots: false,
            items: 4,
            autoplayTimeout: 2000, // Set autoplay delay to 5 seconds
            smartSpeed: 2000 // Set slide speed to 1 second
        });
    });
    AOS.init();
</script>