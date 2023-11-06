


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
                <div class="overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex justify-center">
                        <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center">
                            <img class="w-12" src="{{ asset('images/subservices/'.$subservice['icon']) }}">
                        </div>
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
        <div class="slide show flex items-center"><x-webmockup></x-webmockup></div>
        @foreach($subservices as $subservice)
        @php
        $slug = str_replace(' ','-', strtolower($service));
        $subslug = str_replace(' ','-', strtolower($subservice['subservice_name']));
        $uniqueId = "subserv_card_" . $subslug; // Create a unique ID for each subserv_card
        @endphp
        <div class="slide" id="slide_{{$subslug}}">
            <form action="{{ route('viewsubservice.createQuote') }}" method="POST">
                @csrf
                <h3 class="text-2xl font-bold">{{$subservice['subservice_name']}}</h3>
                <input type="hidden" name="subserv_id" value="{{$subservice['subserv_id']}}">
                <hr>
                <p class="">Description goes here</p>
                <br>
                <span class="text-xl font-bold bg-slate-200 block p-2 mb-2">Options</span>
                @foreach ($subservice['options'] as $option)
                <div class="mb-4 md:w-7/12">
                    <div class="grid grid-cols-6">
                        <div class="mr-4 col-span-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" name="options[]" value="{{ $option['unq_id'] }}" placeholder="{{ $option['name'] }}" onchange="highlightRow(this)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $option['name'] }}</span>
                            </label>
                        </div>
                        <div class="ml-4 col-span-2">
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="hidden" name="subservice_id" value="{{ $option['subservice_id'] }}">
                            @if (isset($option['quantified']) && $option['quantified'] == 1)
                            <input class="sqbox w-18 ml-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="quantity[]" value="1">
                            @else
                            <input type="hidden" name="quantity[]" value="1">
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @if(Auth::check())

                <input class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit" value="Submit">
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Submit</a>
                @endif
            </form>
        </div>
        @endforeach
    </div>
</div>

<script>
    function highlightRow(checkbox) {
        const row = checkbox.closest('.grid');
        if (checkbox.checked) {
            row.classList.add('highlighted-row');
        } else {
            row.classList.remove('highlighted-row');
        }
    }
</script>