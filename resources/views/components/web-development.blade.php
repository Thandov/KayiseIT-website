<div class="grid sm:grid-flow-row md:grid-cols-2 pb-4">
    <div class="px-4 mt-4">
        <x-titlestyle smheading="Transform Your" bgheading="Online Presence!" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
        <p class="text-left">Utilize Our Skilled IT Website Services to Transform Your Online Presence! In the digital sphere, we bring your brand to life with slick designs and flawless functioning.</p>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 my-4">
            @foreach($subservices as $subservice)
            @php $slug = str_replace(' ','-', strtolower($service->name));
            $subslug = str_replace(' ','-', strtolower($subservice->name)) @endphp
            <a href="{{ url('services/'.$slug.'/'.$subslug) }}" class="justify-center">
                <div class="subserv_card bg-white overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex justify-center">
                        <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center"><img class="w-12" src="{{ asset('images/subservices/'.$subservice->icon) }}"></div>
                    </div>
                    <div class="flex justify-center">
                        <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{$subservice->name}}</h2>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <x-front-end-btn linking="contact" color="blue" showme="zzzzzzzz" name="Request Quotation" />
    </div>
    <x-webmockup></x-webmockup>
</div>