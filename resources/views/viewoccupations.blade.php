<x-app-layout>
    <section id="career-mapping">
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <!-- Second page -->
            <p class="smalltxt font-bold text-center"><strong>Occupation</strong></p>
            <div class="my-4 rounded-md mx-auto"><img class="w-40 h-40" src="{{ asset('images/occupations_logo/'.$occupations->image) }}"></div>
            <h2 class="bigtxt font-bold text-5xl mb-3 text-center">{{ $occupations->occupation_name }}</h2>
            <div class="flex justify-center gap-4">
                @foreach($specializations as $specialization)
                <div class="mb-4">
                <a href="#">
                    <div class="bg-white rounded-lg shadow-md flex items-center justify-center w-64 md:w-96 h-28">
                            <h2 class="text-xl font-bold smalltxt text-center">{{$specialization->specialization_name}}</h2>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
    </section>
</x-app-layout>