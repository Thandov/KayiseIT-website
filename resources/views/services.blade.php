<x-app-layout>
<x-hero-banner hero="service-hero" title="Our Services"/>
<!--breadcrumb-->
{{ Breadcrumbs::render() }}
    <!--services-->
    <div class="services container p-5">
        <div class="row justify-content-center">
            <div class="col">
                <x-titlestyle smheading="Our Services" bgheading="Managed I.T. Solutions" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row d-flex justify-content-center align-items-center">
                        @foreach($services as $service)
                        <div class="col-lg-4 col-md-6 col-sm-12 my-3 p-4">
                            <a href="{{ url('viewservice/'.$service->id) }}">
                                <div class="card  text-white">
                                    <img src="{{ asset('../images/service_logo/'.$service->icon) }}" style="opacity: .9" class="card-img" alt="Your Image">
                                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                                        <div class="text-center">
                                            <h5 class="card-title text-3xl font-bold">{{ $service['name'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            items: 4,
            autoplayTimeout: 2000, // Set autoplay delay to 5 seconds
            smartSpeed: 2000 // Set slide speed to 1 second
        });
    });
    AOS.init();
</script>