<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "Home - Welcome to Kayise IT";
    $metaDescription = "Explore our innovative technology solutions and experience unparalleled customer satisfaction.";
    $metaKeywords = "IT Company, Computers and Information Technology, Software, Technology, ICT, Nelspruit, South Africa, Near Me, IT Companies South Africa";
    @endphp
    @endsection
    <!-- Page Body -->

    <!--Carousel-->
    <section id="carousel">
        @include('_carousel')
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

    <!--About Us-->
    <section id="about-us">
        @include('_about')
    </section>
    <!--Featured Services-->
    <section id="featured-services">
        @include('services._services', ['services' => $services->take(3)])
        <div class="data text-center px-4 md:px-8 max-w-screen-xl mx-auto mb-5">
            <x-front-end-btn linking="services" color="blue" showme="zzzzzz" name="View All" />
        </div>
    </section>
    <!--Services Call-To-Action-->
    <section id="our-services">
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="../images/server_bae.png" class="pic-2 shadow-lg rounded-3" alt="Kayise IT:Woman Working">
                </div>
                <div class="col-md-6 col-sm-12 text-2 d-flex align-items-center">
                    <div>
                        <x-titlestyle smheading="Our Services" bgheading="Managed I.T. solutions tailored to your business" alignment="text-left" smheadingcolor=" " bgheadingcolor="text-white"></x-titlestyle>
                        <p id="white-text" class="text-base mt-4 mb-4">Develop efficient & effective digital projects with
                            knowledge from a creative team of Business Analysts, Solutions Architect & Graphics designers so
                            that our clients grow their business.</p>
                        <x-front-end-btn linking="services" color="blue" showme="zzzzzzzz" name="Learn More" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Projects-->
    <!-- @include('_projects') -->
    <!--Testimonials-->
    <section id="testimonials">
        @include('_testimonials')
    </section>

    <!-- Contact-Info -->
    <section id="contact-info">
        @include('_contactinfo')
    </section>
</x-app-layout>