<x-app-layout>
    <section>
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <h4 class="bigtxt font-bold text-5xl mb-3 text-center">{{ $specializations->specialization_name }}</h4>
            @foreach ($careerSteps as $step)
            <div class="bg-white p-3 mt-5 shadow-md rounded-md">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-1 flex items-center justify-center">
                        <h4 class="text-sm font-bold smalltxt ">{{ $step->step_number }}</h4>
                    </div>
                    <div class="col-span-5">
                        <h4 class="text-3xl font-bold">{{ $step->qualification }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layout>