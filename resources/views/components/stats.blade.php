<!--skills-->
<div class="mskills p-5 bg-grey d-flex align-items-center justify-content-center">
    <div class="skills">
        <div class="top-section">
            <div class="col">
                <h2 class="bigtxt font-bold text-5xl">We’re on a mission to bridge the digital divide</h2>
            </div>
        </div>
        <!--Overview-->
        <div class="overviews grid md:grid-cols-4 sm:grid-cols-2">
            <!--No.1 Years-->
            <div class="overview">
                <span>{{$years}}</span>
                <p id="dark-g-text">YEARS</p>
            </div>
            <!--No.2 Developers-->
            <div class="overview" data-aos="fade-down" data-aos-delay="700">
                <span>{{$developers}}</span>
                <p id="dark-g-text">DEVELOPERS</p>
            </div>
            <!--No.3 Customer-->
            <div class="overview" data-aos="fade-up" data-aos-delay="1100">
                <span>{{$customers}}</span>
                <p id="dark-g-text">CUSTOMERS</p>
            </div>
            <!--No.3 Projects-->
            <div class="overview" data-aos="fade-left" data-aos-delay="1500">
                <span>{{$projects}}</span>
                <p id="dark-g-text">PROJECTS</p>
            </div>
        </div>
    </div>
</div>