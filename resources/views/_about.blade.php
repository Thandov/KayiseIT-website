<section class="bg-white py-20">
    <div class="container mx-auto px-4 max-w-7xl md:flex justify-center">
        <!-- images -->
        <div class="md:flex justify-center items-center md:w-1/2">
            <!-- images 2 in 1 -->
            <div>
                <div class="md:h-48 lg:h-72 md:w-40 lg:w-64 bg-green-600 rounded-lg relative bg-cover bg-center hidden sm:block" style="background-image: url('../images/Kayise-IT-Logo-Dark-Green-Background.jpg')" alt="Kayise IT:Kayise IT Logo Dark Green Background"></div>
                <div class="md:h-48 lg:h-72 md:w-40 lg:w-64 bg-green-600 rounded-lg relative bg-cover bg-center mt-2 hidden sm:block" style="background-image: url('../images/skills2.jpeg')" alt="Kayise IT:Soft Skills"></div>
            </div>
            <!-- single image -->
            <div class="md:h-48 lg:h-80 md:w-40 lg:w-64 bg-green-600 rounded-lg relative bg-cover bg-center md:m-2 my-2 hidden sm:block" style="background-image: url('../images/touch.jpeg')" alt="Kayise IT:Technology Touch"></div>
        </div>
        <!-- content -->
        <div class="flex items-center md:w-1/2">
            <div class="">
                <p class="smalltxt font-bold"><strong>About Us</strong></p>
                <h2 class="text-kg-700 font-bold text-5xl mb-4">Profitable Innovation Meets Youth Empowerment</h2>
                <p class="text-base mb-6">KAYISE IT delivers world-class IT solutions while developing South Africa's next generation of tech talent.</p>
                <ul class="space-y-3 text-base">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Enterprise-grade software, web development, and IT consulting</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Comprehensive internship and training programs</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Measurable ROI and sustainable business growth</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Building skilled professionals for South Africa's tech industry</span>
                    </li>
                </ul>
                @if(request()->path() !== 'about')
                    <div class="mt-6">
                        <x-front-end-btn linking="about" color="blue" showme="zzzzzzzz" name="Discover More" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>