<section class="bg-white">
    <div class="md:flex justify-center py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
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
                <h2 class="text-kg-700 font-bold text-5xl mb-3">We Specialize In Custom Tailored I.T Solutions</h2>
                <p class="text-base">Welcome to KAYISE IT, a leading IT company specializing in software and web development, as well as providing 4IR skills training. With a decade of experience in the industry, we are passionate about building ICT capacity in communities and young people</p>
                @if(request()->path() !== 'about')
                    <div class="mt-3">
                        <x-front-end-btn linking="about" color="blue" showme="zzzzzzzz" name="Discover More" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>