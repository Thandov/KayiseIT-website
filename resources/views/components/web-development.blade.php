    <div class="grid sm:grid-flow-row md:grid-cols-2 pb-4">
        <div class="px-4 mt-4">
            <x-titlestyle smheading="Transform Your" bgheading="Online Presence!" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
            <p class="text-left">Utilize Our Skilled IT Website Services to Transform Your Online Presence! In the digital sphere, we bring your brand to life with slick designs and flawless functioning.</p>
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 my-4">
                @foreach($subservices as $subservice)
                @php
                $slug = str_replace(' ','-', strtolower($service));
                $subslug = str_replace(' ','-', strtolower($subservice['subservice_name']));
                $uniqueId = "subserv_card_" . $subslug; // Create a unique ID for each subserv_card
                @endphp
                <div class="subserv_card justify-center" id="{{ $uniqueId }}" data-target="slide_{{$subslug}}">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
                        <div class="flex justify-center">
                            <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center"><img class="w-12" src="{{ asset('images/subservices/'.$subservice['icon']) }}"></div>
                        </div>
                        <div class="flex justify-center">
                            <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{$subservice['subservice_name']}}</h2>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="sideshowwrp">
            <div class="slide show"><x-webmockup></x-webmockup></div>
            @foreach($subservices as $subservice)
            @php
            $slug = str_replace(' ','-', strtolower($service));
            $subslug = str_replace(' ','-', strtolower($subservice['subservice_name']));
            $uniqueId = "subserv_card_" . $subslug; // Create a unique ID for each subserv_card
            @endphp
            <div class="slide" id="slide_{{$subslug}}">
                <form action="{{ route('viewsubservice.createQuote') }}" method="POST">
                    @csrf
                    <h3>{{$subservice['subservice_name']}}</h3>
                    <hr>
                    <span class=" fw-bold">Options</span>
                    @foreach ($subservice['options'] as $option)
                    <div class="grid grid-cols-5 items-center space-x-2 mt-2">
                        <input type="checkbox" value="{{$option['name']}}" id="{{$option['name']}}" class="form-checkbox h-5 w-5 text-indigo-600">
                        <label for="{{$option['name']}}">{{$option['name']}}</label>
                        @if ($option['quantified'] == 1)
                        <input type="number" name="quantity_{{$option['name']}}" id="quantity_{{$option['name']}}" class="form-input h-8 w-16 border-gray-300 rounded-md">
                        @endif
                    </div>
                    @endforeach
                    <input type="submit" value="Submit">
                </form>
            </div>
            @endforeach

        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initial state: Show the first slide and add 'show' class to the first subserv_card
            $(".slide:first").addClass("show");
            $(".subserv_card:first").addClass("show");

            // Handle click event on subserv_card elements
            $(".subserv_card").click(function() {
                var target = $(this).data("target"); // Get the data-target value
                // Hide all slides and remove 'show' class from all subserv_card elements
                $(".slide").removeClass("show");
                $(".subserv_card").removeClass("show");

                // Remove the previously added classes 'border-5' and 'border-green-500' from all subserv_card elements
                $(".subserv_card").removeClass("border-5 border-green-500");

                // Show the selected slide and add 'show' class to the clicked subserv_card
                $("#" + target).addClass("show");
                $(this).addClass("show");

                // Add the 'border-5' and 'border-green-500' classes to the clicked subserv_card
                $(this).addClass("border-5 border-green-500");
            });
        });
    </script>