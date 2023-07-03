<x-app-layout>
    <section>
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <h4 class="bigtxt font-bold text-5xl mb-3 text-center">{{ $specializations->specialization_name }}</h4>
            @foreach ($careerSteps as $step)
            <div class="bg-white p-3 mt-5 shadow-md rounded-md">
                <h4 class="text-sm mb-1 font-bold smalltxt text-center">{{ $step->step_number }}</h4>
                <h4 class="text-3xl font-bold text-center">{{ $step->qualification }}</h4>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
