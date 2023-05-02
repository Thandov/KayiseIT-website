<div class="container mx-auto p-5 bg-grey-500">


    <div class="text-center">
        <p class="smalltxt font-bold"><strong>Our Services</strong></p>
        <h2 class="bigtxt font-bold text-5xl mb-3">What We Offer</h2>
        <p class="mb-3">pppp</p>
    </div>

    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-5 flex justify-center">
        @foreach($services as $service)
            <div class="flex justify-center">
                <div class="grid h-auto grid-rows-3 bg-white rounded-lg shadow-md">
                    <div class="row-span-1 flex items-center justify-start p-4">
                        <div class="h-12 w-12 rounded-md bg-green-500"></div>
                    </div>
                    <div class="row-span-2 px-4">
                        <h2 class="mb-2 text-lg font-bold">{{ $service['name'] }}</h2>
                        <p class="text-sm">{{ $service['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>