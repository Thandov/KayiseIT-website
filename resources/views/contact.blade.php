<x-app-layout>
    <div class="container">
        <div class="row ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen!2sza!4v1668003382879!5m2!1sen!2sza" width="640" height="380" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="bg-white mx-auto py-10 sm:px-6 lg:px-8">
        <div class="container max-w-7xl">
            <div class="row">
                <div class="col-md-6  px-10">

                    <p class="smalltxt font-bold">CONTACT US</p>
                    <br>
                    <h2 class="bigtxt font-bold text-5xl">Get In Touch With Us.</h2>
                    <br>
                    <div>
                        <p style="color: #183ea4" class="font-bold fs-5">Send us an email or give us a call and get top shelf advice on
                            the best IT strategies to help grow your business online.
                        </p>
                    </div>
                    <br>
                    <div>
                        <i id="contact-socials" class="fa-solid fa-phone px-2"></i>+27 87 702 2625
                    </div>
                    <br>
                    <div>
                        <i id="contact-socials" class="fa-solid fa-envelope px-2"></i> info@kayiseit.co.za
                    </div>
                    <br>
                    <div>
                        <i id="contact-socials" class="fa-solid fa-location-dot px-2"></i>39B Nelbro Building, Mbombela, 2nd floor Office 02.
                    </div>
                    <br>

                </div>
                <!--Contact Form-->
                <div class="col-md-6  rounded p-20 shadow-lg">

                    <form action="{{ route('contact.contact') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="row">
                                <div class="col-6 ">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded" placeholder="Your Name" id="name" name="name" required>
                                        <label for="floatingTextarea">Your Name</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded" placeholder="Your Surname" id="email" name="email" required>
                                        <label for="floatingTextarea">Your Surname</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded" placeholder="Your Subject" id="subject" name="subject" required>
                                <label for="floatingTextarea">Your Subject</label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-floating">
                                <textarea class="form-control rounded" placeholder="Your Message" id="message" name="message" rows="5" style="height: 150px" required></textarea>
                                <label for="floatingTextarea">Your Message</label>
                            </div>
                        </div>

                        <button type="submit" id="btn-primary" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>