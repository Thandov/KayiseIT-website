<section class="bg-grey-100">
<div class="container mx-auto p-5 bg-grey-500">

    <div class="text-center">
        <p class="smalltxt font-bold mb-3"><strong>Our Services</strong></p>
        <h2 class="bigtxt font-bold text-5xl mb-4">What We Offer</h2>
        <p class="mb-3">pppp</p>
    </div>

    <div class="flex justify-center">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 w-10/12 flex justify-center">
        @foreach($services as $service)
        @php $slug = str_replace(' ','-', strtolower($service->name)) @endphp
        <a href="{{ route('service.show', $slug) }}" class="flex justify-center">
            <div class="bg-white overflow-hidden shadow-md rounded-lg w-80 h-64 p-4">
                <div class="flex justify-start">
                    <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center"><img class="w-12" src="../images/icons/em.png"></div>
                </div>
                <div class="flex justify-start">
                    <div class="">

                        <h2 class="mt-4 text-2xl font-bold smalltxt">{{ $service['name'] }}</h2>
                        <p class="text-base mt-2">{{ implode(' ', array_slice(explode(' ', $service['description']), 0, 11)) }}...</p>

                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    </div>

</div>
</section>