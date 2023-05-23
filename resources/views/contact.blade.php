<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
        @php
            $metaTitle = "Contact - Technical Solutions and Exceptional Support";
            $metaDescription = "Our Offices are at 39B Nelbro Building, Mbombela, 2nd floor Office 02. Alternatively email us at  info@kayiseit.co.za or call  +27 87 702 2625";
            $metaKeywords = "IT Company, Computers and Information Technology, Software, Technology, ICT, IT Services, Nelspruit, Near Me";
        @endphp
    @endsection
    <!-- Page Body -->
    <!-- Hero banner -->
    <section id="hero-banner">
        <x-hero-banner hero="contact-hero" title="Contact Us"></x-hero-banner>
    </section>

    @if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif

  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

    <!-- Contact Info -->
        <section id="contact-info" class="bg-white">
            <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
                <div class="row">
                    <div class="col-md-6">
                        <x-titlestyle smheading="Contact Us" bgheading="Get In Touch With Us" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                        <br>
                        <div>
                            <p>Send us an email or give us a call and get top shelf advice on the best IT strategies to help grow your business online.</p>
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3601.9765050913793!2d30.97354507517308!3d-25.472459977534736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee84a10007ca0ff%3A0xf2ea30366dcc9afa!2s39%20Brown%20St%2C%20Mbombela%2C%201201!5e0!3m2!1sen!2sza!4v1683621767634!5m2!1sen!2sza" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <!--Contact Form-->
                    <article id="contact-form" class="col-md-6 p-5">
                        @include('components.contact-form')
                    </article id="contact-form">
                </div>
            </div>
        </section>
</x-app-layout>
<script>
    AOS.init();
</script>