<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
        @php
            $metaTitle = "Services - Web and App Development, 4IR Skills Training, Tech Support";
            $metaDescription = "Our developers take a pragmatic approach to create tailor-made products that meets our client's specific needs.";
            $metaKeywords = "Services - Web Development, App Development, 4IR Skills Training, Tech Support, IT Company, IT Services,  Nelspruit, South Africa, Near Me, IT Companies South Africa";
        @endphp
    @endsection
  <!-- Hero banner -->
<section id="hero-banner">
  <x-hero-banner hero="service-hero" title="Our Services"/>
</section>

@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif

  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

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