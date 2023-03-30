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
      <div class="row justify-content-center align-items-center">
         <div class="col-md-10">

      <h2 class="text-center mb-4  font-bold text-5xl md:text-5xl">Discover Our Services</h2>
      <p class="text-center mb-4 font-bold text-success md:text-5">Our top priority is to bring our clients high quality services</p>

           <div class="d-flex flex-wrap justify-content-center align-items-center">
            <div class="row">
                @foreach($services as $service)
                <div class="col-md-3 col-sm-6 mb-3">
                  <a href="{{ url('viewservice/'.$service->id) }}">
                    <div class="card bg-secondary shadow-lg text-white" data-aos="fade-left" data-aos-delay="500">
                      <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                        <div class="text-center">
                          <h5 class="card-title text-3xl font-bold">{{$service['name']}}</h5>
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
        <h2 class="font-bold text-center text-5xl md:text-5xl" data-aos="fade-down" data-aos-delay="300">We strive to work with the best</h2>
          <p class="card-text m-3 text-success text-center" data-aos="fade-up" data-aos-delay="300">Some of our clients</p>

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

<style>

.card {
  height: 250px; /* Set a fixed height for each card */
  width: 300px;
}
.card-img {
  height: 100%; /* Make the image fill the entire height of the card */
  object-fit: cover; /* Scale the image while maintaining its aspect ratio */
}

.card:hover,
.card:focus {
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
  opacity: .9;
}


</style>

<script>

    

let slider = document.querySelector('.slide-container');
let sliderWidth = slider.offsetWidth;
let slideIndex = 0;

function showSlides() {
  let slides = document.querySelectorAll('.slide-container img');
  let visibleSlides = window.innerWidth < 768 ? 3 : 4; // Change the number of visible slides based on the screen width
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
