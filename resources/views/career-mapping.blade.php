<x-app-layout>
    <x-hero-banner hero="career-mapping-hero" title="Career Mapping"></x-hero-banner>
    <section id="career-mapping">
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <!--Page Content-->
            <p class="smalltxt font-bold text-center"><strong>Career Mapping</strong></p>
            <h2 class="bigtxt font-bold text-5xl mb-6 text-center">Occupations</h2>
            <p class="text-center text-lg">Choose your Occupation</p>

            <!--Grid-->
            <div class="flex justify-center pt-6">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 w-10/12 justify-center">
                <!--Cards-->
                @foreach($occupations as $occupation)
                <a href="{{ url('viewoccupations/'.$occupation->occup_id) }}">
                    <div class="bg-white rounded-lg shadow-md flex items-center justify-center h-64">
                        <div class="mx-4">
                            <div  ><img class="h-28 rounded-md mx-auto" src="{{ asset('images/occupations_logo/'.$occupation->image) }}"></div>
                            <h2 class="mt-4 text-xl font-bold smalltxt text-center">{{ $occupation->occupation_name }}</h2>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            </div>
        </div>
    </section>
</x-app-layout>