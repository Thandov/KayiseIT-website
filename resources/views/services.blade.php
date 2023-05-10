<x-app-layout>
    <div id="services-services">
<x-hero-banner hero="service-hero" title="Our Services"/>
@include('services._services')
    <x-clients />
    </div>
</x-app-layout>

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