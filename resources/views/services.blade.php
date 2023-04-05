<x-app-layout>

            <div class="hero">
				<div class="container spacing">
					<h1 class="primary-title" data-aos="fade-up" data-aos-delay="700">Our Services</h1>
				</div>
			</div>


    <!--services-->
    <div class="services container py-5">
        <div class="row justify-content-center">
            <div class="col">

            <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5" data-aos="fade-down" data-aos-delay="500"><strong>Our Services</strong></p>
                <h2 style="color: #64bc5c" class="text-center mb-4  font-bold text-5xl md:text-5xl" data-aos="fade-up" data-aos-delay="500">Managed I.T. Solutions</h2>


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
    let slider = document.querySelector('.slide-container');
    let sliderWidth = slider.offsetWidth;
    let slideIndex = 0;

    function showSlides() {
        let slides = document.querySelectorAll('.slide-container img');
        let visibleSlides = window.innerWidth < 768 ? 3 :
            4; // Change the number of visible slides based on the screen width
        let slideWidth = sliderWidth / visibleSlides;
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('show');
        }
        for (let i = slideIndex; i < slideIndex + visibleSlides; i++) {
            if (slides[i]) {
                slides[i].classList.add('show');
            }
        }
        slideIndex++;
        if (slideIndex > slides.length - visibleSlides) {
            slideIndex = 0;
        }
        setTimeout(showSlides, 3000);
    }

    showSlides();


    AOS.init();

</script>
