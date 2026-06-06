<x-app-layout
    title="Contact KAYISE IT | Mbombela ICT and training"
    description="Contact KAYISE IT for software projects, website builds, or institutional ICT and drone training. Speak to our team by phone, email, or WhatsApp."
    keywords="contact KAYISE IT, ICT Mbombela, Nelspruit IT company, software quote, training enquiry"
>
    <!-- Hero Section -->
    <x-page-hero 
        title="Contact Us" 
        subtitle="Get in Touch"
        description="Partner with KAYISE IT for practical, future-focused technology solutions and responsive support."
        hero-id="contact-hero-new"
        background-image="images/banner/contact.png" />
    <!-- Contact Info -->
    <section id="contact-info" class="bg-white py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
        <div>
            <x-titlestyle smheading="Contact Us" bgheading="Get In Touch With Us" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
            <br>
        </div>
        <div class="grid sm:grid-flow-row md:grid-cols-2">
            <div class="h-100 overflow-hidden">
                <div>
                    <div>
                        <p class="font-bold">Send us an email or give us a call and get top shelf advice on the best IT strategies to help grow your business online.</p>
                    </div>
                    <div class="mt-3">
                        <i id="contact-socials" class="fa-solid fa-phone px-2"></i><span class="font-medium text-sm text-gray-700">+27 87 702 2625</span>
                    </div>
                    <div>
                        <i id="contact-socials" class="fa-solid fa-envelope px-2"></i>
                        <a href="mailto:info@kayiseit.co.za" class="font-medium text-sm text-gray-700 hover:text-blue-700">info@kayiseit.co.za</a>
                    </div>
                    <div>
                        <i id="contact-socials" class="fa-solid fa-location-dot px-2"></i><span class="font-medium text-sm text-gray-700">Suite 2, 2nd Floor, Nelbro Building, 39B Brown Street, Mbombela</span>
                    </div>
                    <br>
                </div>
                <div class="relative" style="height: 420px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3601.9765050913793!2d30.97354507517308!3d-25.472459977534736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee84a10007ca0ff%3A0xf2ea30366dcc9afa!2s39%20Brown%20St%2C%20Mbombela%2C%201201!5e0!3m2!1sen!2sza!4v1683621767634!5m2!1sen!2sza" style="width: 100%; height: 100%; border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <!--Contact Form-->
            <article id="contact-form" class="px-5">
                @include('components.contact-form')
            </article>
        </div>

        <div class="mt-8 rounded-lg border border-slate-200 bg-slate-50 p-5 md:p-6">
            <h3 class="text-lg font-bold text-slate-900">About KAYISE IT</h3>
            <p class="mt-2 text-sm text-slate-700">KAYISE IT is a South African technology partner delivering ICT services, digital solutions, and skills development programs that help organizations work smarter and grow sustainably.</p>
            <p class="mt-2 text-sm text-slate-700">We welcome collaboration opportunities with schools, businesses, and government institutions. If you are exploring innovation, training, or implementation support, our team is ready to engage.</p>

            <div class="mt-4 grid gap-2 text-sm text-slate-700 md:grid-cols-2">
                <div><span class="font-semibold">Phone 1:</span> +27 87 702 2625</div>
                <div><span class="font-semibold">Phone 2:</span> +27 12 345 6789</div>
                <div class="md:col-span-2"><span class="font-semibold">Email:</span> <a href="mailto:info@kayiseit.co.za" class="hover:text-blue-700">info@kayiseit.co.za</a></div>
            </div>

            <div class="mt-4 text-sm text-slate-700">
                <span class="font-semibold">Social Media:</span>
                <a href="https://www.facebook.com/KAYISEIT?mibextid=ZbWKwL" target="_blank" rel="noopener" class="ml-2 hover:text-blue-700">Facebook</a>
                <a href="https://instagram.com/kayiseit?igshid=ZDdkNTZiNTM=" target="_blank" rel="noopener" class="ml-3 hover:text-blue-700">Instagram</a>
                <a href="https://www.linkedin.com/company/kayise-it/" target="_blank" rel="noopener" class="ml-3 hover:text-blue-700">LinkedIn</a>
                <a href="https://www.youtube.com/channel/UCrAixDqFR92LBqC7OBF3Eqw" target="_blank" rel="noopener" class="ml-3 hover:text-blue-700">YouTube</a>
            </div>
        </div>
    </section>
</x-app-layout>
<script>
    AOS.init();
</script>