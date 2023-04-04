<x-app-layout>
 
<!--
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/images/landing-page/service.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="font-bold  md:text-7xl">Our Services</h1>
      </div>
    </div>
  </div>
</div> -->      

<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h2 style="color: #64bc5c" class="text-center mb-4  font-bold text-5xl md:text-5xl">Discover Our
                    Services</h2>
                <p style="color: #183ea4" class="text-center mb-5 font-bold  md:text-5">Our top priority is to bring our
                    clients high quality services</p>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @foreach($services as $service)
                                <div class="col-lg-3 col-md-4 col-sm-12 m-3">
                                    <a href="{{ url('viewservice/'.$service->id) }}">
                                        <div class="card bg-dark shadow-lg text-white" data-aos="fade-left"
                                            data-aos-delay="500">
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
        setTimeout(showSlides, 2000);
    }

    showSlides();  


AOS.init();

</script>
