<div class="container grid sm:grid-flow-row md:grid-cols-1 pb-4">
    <div class="px-4 mt-4">
        <x-titlestyle smheading="Transform Your" bgheading="Network Infrastructure!" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
        <p class="text-left">Utilize Our Professional Networking Services to Transform Your Infrastructure! We design, implement, and maintain robust network solutions that keep your business connected and secure.</p>
        <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 my-4">
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
