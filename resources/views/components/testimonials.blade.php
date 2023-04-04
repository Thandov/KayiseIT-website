<div class="testimonial container py-5">
        <div class="row justify-content-center">
            <div class="col">

                <p style="color: #183ea4" class="text-center mb-4 font-bold md:text-5">Testimonials</p>
                <h2 style="color: #64bc5c" class="text-center mb-5  font-bold text-5xl md:text-5xl">What they say</h2>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        @foreach($testimonials as $testimonial)
                        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
                            <div class="card shadow-lg border-success m-2 border" data-aos="fade-right"
                                data-aos-delay="300">
                                <div class="card-body">
                                    <div class="row mx-4">
                                        <div class="rating text-center">
                                            <span class="text-muted"></span>
                                            @php
                                                $avg_rating = DB::table('testimonials')->where('id',
                                                $testimonial->id)->avg('ratings');
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $avg_rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="card-text py-3">
                                            {{ $testimonial['testimony'] }}</p>
                                        <div class="col-4">
                                            <img src="{{ asset('images/'.$testimonial->icon) }}"
                                                class="rounded-circle  img-thumbnail"
                                                style="width: 80px; height: 80px;">
                                        </div>
                                        <div class="col-8">
                                            <h3 class="card-title text-1xl pt-4 font-bold">
                                                {{ $testimonial['name'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>