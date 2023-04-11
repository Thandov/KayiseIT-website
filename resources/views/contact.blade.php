<x-app-layout>
    <x-hero-banner hero="contact-hero" title="Contact Us"></x-hero-banner>

    <div class="bg-white mx-auto py-10 sm:px-6 lg:px-8">
        <div class="container max-w-7xl">
            <div class="row">
                <div class="col-md-6  px-10">
                    <x-titlestyle smheading="Contact Us" bgheading="Get In Touch With Us" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                    <br>
                    <div>
                        <p class="">Send us an email or give us a call and get top shelf advice on the best IT strategies to help grow your business online.</p>
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
                    <div class="container">
                        <div class="row ">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115255.11640170858!2d30.915947072952804!3d-25.480943773944084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee84a158d3e2739%3A0x7aa50ca83429a0f8!2sMbombela!5e0!3m2!1sen!2sza!4v1668003382879!5m2!1sen!2sza" width="640" height="380" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <!--Contact Form-->
                <div class="col-md-6 p-5">
                    @include('components.contact-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>