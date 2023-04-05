<x-app-layout>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/landing-page/pexels-muffin-creatives-4584612.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h1 class="font-bold  md:text-7xl" data-aos="fade-right">Our Services</h1>
                </div>
            </div>
        </div>
    </div>

    <!--services-->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

            <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5">Testimonials</p>
                <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">What They Say</h2>


                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">

                        @foreach($services as $service)

                            <div class="col-md-4 col-sm-6 mb-4">
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


    <div class="bg-white  mx-auto py-5 sm:px-6 lg:px-8">

        <div class="container">
            <div class="row">

                    <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5" data-aos="fade-down" data-aos-delay="300">Some Of Our Clients  </p>
                    <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl" data-aos="fade-up" data-aos-delay="300">We Strive To Work With The Best</h2>

                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                    <div class="slider" data-aos="fade-left" data-aos-delay="300">
                        <div class="slide-container">
                            <img src="../images/partner1.png">
                            <img src="../images/partner2.png">
                            <img src="../images/partner3.png">
                            <img src="../images/partner4.png">
                            <img src="../images/partner5.png">
                            <img src="../images/partner6.png">
                            <img src="../images/partner7.png">
                            <img src="../images/partner8.png">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

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
