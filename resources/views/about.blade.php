<x-app-layout>

    <div class="about-hero">
				<div class="container spacing">
					<h1 class="primary-title" data-aos="fade-up" data-aos-delay="700">Our Company</h1>
				</div>
			</div>

    <div class="max-w-7xl mx-auto py-20 lg:px-8 ">
  <div class="container" id="company">
    <div class="row flex flex-wrap justify-center">
      <div class="col-7 sm-col-12">
        

        <x-body smheading="About Us" 
                                bgheading="We Specialize In Custom Tailored I.T Solutions." 
                                paragraph="KAYISE IT established 2015 is the go-to tech solutions company for all your IT needs. Our team will ensure you get the best made-to-measure products, services and IT strategies. We at KAYISE IT love Technology, through our robust IT services, Office Automation, Network Support, Marketing and digital upskilling, we help our clients achieve their organizations objectives using technology." 
                                btnlink="services" btntext="Discover More"/>

      </div>
      <div class="col-4 position-relative px-20">
        <img src="../images/contact.jpg" width="400" height="400" class="rounded shadow-lg" style="position: absolute; top: -150px; left: -5; right: 0; z-index: 1;" data-aos="fade-left" data-aos-delay="300">
      </div>
    </div>
  </div>
</div>

<div class="bg-white mx-auto py-5 sm:px-6 lg:px-8 shadow-lg">
  <div class="container max-w-7xl" id="culture">

  <x-headings small="OUR CULTURE" big="Our Fundamental Business" toalign="text-center"/>

    <div class="card-container flex flex-wrap justify-center pt-10 md:justify-start gap-10 max-w-7xl mx-auto sm:px-6 lg:px-12">

        <div class="card" data-aos="fade-left" data-aos-delay="350" style="width: 30rem;">
          <div class="card-body">
            <div class="row">
             
              <div class="col-12">
                <h3 class="card-title text-2xl pt-3 font-bold text-center" style="color: #183ea4">Vision</h3>
              </div>
              </div>
            <p class="card-text text-center fs-6">KAYISE IT: Empowering South African organizations and communities with an integrated digital ecosystem through reliable IT services, automation, network support, and digital upskilling.</p>
          </div>
        </div>
      
        <div class="card" data-aos="fade-right" data-aos-delay="300" style="width: 30rem">
          <div class="card-body">
          <div class="row">
              <div class="col-12">
                <h3 class="card-title text-2xl pt-3 font-bold text-center" style="color: #183ea4">Mission</h3>
              </div>
              </div>
            <p class="card-text text-center fs-6">Empowering South African youth with ICT skills, while delivering innovative digital solutions that accelerate business growth.</p>
          </div>
        </div>
        
      </div>
    </div>
  </div>

<!--Our team-->
<div class="bg py-5 mx-auto" id ="team_background">
  <div class="container team max-w-7xl">
    <div class="row">
      <p style="color: #183ea4" class="text-center mb-3 font-bold md:text-5" data-aos="fade-up" data-aos-delay="300">OUR TEAM</p>
      <h2 class="text-center font-bold text-5xl text-white mb-10 md:text-5xl" data-aos="fade-down" data-aos-delay="500">Let Us Introduce Ourselves</h2>
      <div class="card-container flex flex-wrap justify-center md:justify-start gap-10 max-w-7xl mx-auto sm:px-6 lg:px-12">

        <div class="card bg-transparent border-0 text-center text-white" style="width: 18rem;" data-aos="fade-right" data-aos-delay="500">
          <img src="../images/thando.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-2xl font-bold">Thando Hlophe</h5>
            <p class="smalltxt card-text font-bold fs-6">Director</p>
          </div>
        </div>

        <div class="card bg-transparent border-0 text-center text-white" style="width: 18rem;" data-aos="fade-up" data-aos-delay="1000">
          <img src="../images/thandi.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-2xl font-bold">Thandiwe Mathebula</h5>
            <p class="smalltxt card-text font-bold fs-6">Business Developer</p>
          </div>
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