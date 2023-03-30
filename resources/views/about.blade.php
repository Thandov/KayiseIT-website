<x-app-layout>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-item active">
  <img src="/images/landing-page/smart.jpg" class="d-block w-100" alt="...">
  <div class="carousel-caption">
        <h1 class="font-bold  md:text-7xl">Our Company</h1>
  </div>
</div>

  </div>
</div>

<div class="max-w-7xl mx-auto py-20 lg:px-8 shadow-lg">
  <div class="container">
    <div class="row flex flex-wrap justify-center">
      <div class="col-7 sm-col-12">
        <p style="color: #183ea4" class="font-bold md:text-5" data-aos="fade-up">ABOUT US</p>
        <br>
        <h2 style="color: #64bc5c" class="font-bold text-5xl md:text-5xl">We specialize in custom tailored IT solutions.</h2>
        <br>
        <div>
          KAYISE IT established 2015 is the go-to tech solutions company for all your IT needs. Our team will ensure you get the best made-to-measure products, services and IT strategies. We at KAYISE IT love Technology, through our robust IT services, Office Automation, Network Support, Marketing and digital upskilling, we help our clients achieve their organizations objectives using technology.
        </div>
        <br>
        <a href="services" class="hire shadow">Discover More</a>
      </div>
      <div class="col-4 position-relative px-20">
        <img src="../images/contact.jpg" width="400" height="400" class="rounded shadow-lg" style="position: absolute; top: -150px; left: -5; right: 0; z-index: 1;" data-aos="fade-left" data-aos-delay="300">
      </div>
    </div>
  </div>
</div>

<div class="bg-white mx-auto py-5 sm:px-6 lg:px-8 shadow-lg">
  <div class="container max-w-7xl" >
    <p style="color: #183ea4" class="text-center mb-3 font-bold md:text-5" data-aos="fade-down" data-aos-delay="300">OUR CULTURE</p>
    <h2 style="color: #64bc5c" class="text-center font-bold text-5xl md:text-5xl" data-aos="fade-up" data-aos-delay="300">Our Fundamental Business</h2>
    <div class="card-container flex flex-wrap justify-center pt-10 md:justify-start gap-10 max-w-7xl mx-auto sm:px-6 lg:px-12">

        <div class="card border-success shadow-lg border-3" data-aos="fade-left" data-aos-delay="350" style="width: 30rem;">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
              </div>
              <div class="col-8">
                <h3 class="card-title text-2xl pt-3 font-bold">Vision</h3>
              </div>
              </div>
            <p class="card-text text-center">KAYISE IT: Empowering South African organizations and communities with an integrated digital ecosystem through reliable IT services, automation, network support, and digital upskilling.</p>
          </div>
        </div>
      
        <div class="card border-success shadow-lg border-3" data-aos="fade-right" data-aos-delay="300" style="width: 30rem">
          <div class="card-body">
          <div class="row">
              <div class="col-4">
              </div>
              <div class="col-6">
                <h3 class="card-title text-2xl pt-3 font-bold">Mission</h3>
              </div>
              </div>
            <p class="card-text text-center">Empowering South African youth with ICT skills, while delivering innovative digital solutions that accelerate business growth.</p>
          </div>
        </div>
        
      </div>
    </div>
  </div>

<div class="bg py-5 mx-auto">
  <div class="container max-w-7xl">
    <div class="row">
      <p style="color: #183ea4" class="text-center mb-3 font-bold md:text-5" data-aos="fade-up" data-aos-delay="300">OUR TEAM</p>
      <h2 class="text-center font-bold text-5xl text-white mb-10 md:text-5xl" data-aos="fade-down" data-aos-delay="500">Let Us Introduce Ourselves</h2>
      <div class="card-container flex flex-wrap justify-center md:justify-start gap-10 max-w-7xl mx-auto sm:px-6 lg:px-12">

        <div class="card border-0 text-center text-white" style="width: 18rem;" data-aos="fade-right" data-aos-delay="500">
          <img src="../images/thando.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-2xl font-bold">Thando Hlophe</h5>
            <p style="color: #183ea4" class="card-text">Director</p>
          </div>
        </div>

        <div class="card border-0 text-center text-white" style="width: 18rem;" data-aos="fade-up" data-aos-delay="1000">
          <img src="../images/thandi.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-2xl font-bold">Thandiwe Mathebula</h5>
            <p style="color: #183ea4" class="card-text">Chief Operations Manager</p>
          </div>
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
  @media (max-width: 767px) {
    .card-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  }

  @media screen and (max-width: 767px) {
  /* hide the image when screen size is less than or equal to 767px */
  .position-relative {
    display: none;
  }
}

.bg{
  background-color: #64bc5c;
}

  .card {
  height: 250px; /* Set a fixed height for each card */
}
 .bg .card {
  height: 250px; /* Set a fixed height for each card */
  background-color: #64bc5c;
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  max-width: 100%;
  margin: 0 auto;
  padding-top: 20px;
}

@media screen and (max-width: 768px) {
  .card-container {
    justify-content: flex-start;
  }

  .card {
    width: 100%;
    max-width: 350px;
  }
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