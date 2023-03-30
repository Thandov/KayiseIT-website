<x-app-layout>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/images/landing-page/contact.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h1 class="font-bold  md:text-7xl">Contact Us</h1>
      </div>
    </div>
  </div>
</div>

    <div class="bg-white mx-auto py-10 sm:px-6 lg:px-8">
       <div class="container max-w-7xl">

        <div class="row">
            <div class="col-md-6  px-10">

                        <p style="color: #183ea4" class="font-bold md:text-5">CONTACT US</p>
                    <br>
                    <h2 style="color: #64bc5c" class="font-bold text-5xl md:text-5xl">Get in touch.</h2>
                    <br>
                    <div>
                         <p style="color: #183ea4" class="font-bold text-xl">Send us an email or give us a call and get top shelf advice on
the best IT strategies to help grow your business online.
</p>
                    </div>
                    <br>
                    <div>
                        <i class="fa-solid fa-phone px-2"></i>+27 87 702 2625
                    </div>
                    <br>
                    <div>
                        <i class="fa-solid fa-envelope px-2"></i> info@kayiseit.co.za
                    </div>
                    <br>
                    <div>
                        <i class="fa-solid fa-location-dot px-2"></i>39B Nelbro Building, Mbombela, 2nd floor Office 02.
                    </div>
                    <br>
                    <div class="embed-responsive mb-10 embed-responsive-4by3">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen!2sza!4v1668003382879!5m2!1sen!2sza" width="100%" height="10%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

            </div>

            <div class="col-md-6 bg-secondary rounded p-20" style="background-color: #64bc5c">

                <form action="{{ route('contact.contact') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        
                    <div class="row">
                        <div class="col-6">
                            <label class="mb-3" for="name">Name</label>
                            <input type="text" class="form-control rounded" id="name" name="name" required>
                        </div>

                        <div class="col-6">
                            <label class="mb-3" for="email">Email</label>
                            <input type="email" class="form-control rounded" id="email" name="email" required>
                        </div>
                    </div>

                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-3" for="subject">Subject</label>
                        <input type="text" class="form-control rounded" id="subject" name="subject" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-3" for="message">Message</label>
                        <textarea class="form-control rounded" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" style="background-color: #64bc5c" class="btn text-white">Submit</button>
                </form>
            </div>

        </div>
      </div>
    </div>
</x-app-layout>
