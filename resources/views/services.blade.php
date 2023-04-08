<x-app-layout>

            <div class="hero">
				<div class="container spacing">
					<h1 class="primary-title" data-aos="fade-up" data-aos-delay="700">Our Services</h1>
				</div>
			</div>

    <!--services-->
    <div class="services container p-5">
        <div class="row justify-content-center">
            <div class="col">

            <x-headings small="Our Services" big="Managed I.T. Solutions" toalign="text-center"/>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @foreach($services as $service)
                        <div class="col-lg-3 col-md-6 col-sm-12 my-3">
                                <a href="{{ url('viewservice/'.$service->id) }}">
                                    <div class="card  text-white" data-aos="fade-left" data-aos-delay="500">
                                        <img src="{{ asset('images/service_logo/'.$service->icon) }}"
                                            class="card-img" alt="Your Image">
                                        <div
                                            class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                                            <div class="text-center">
                                                <h5 class="card-title text-3xl font-bold">
                                                    {{ $service['name'] }}</h5>
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

    <x-clients/>

</x-app-layout>

<script>

    $(document).ready(function(){
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
