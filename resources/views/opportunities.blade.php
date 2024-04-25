<x-app-layout>
    <div class="vacancies bg-slate-100">
        <div class="black-overlay d-flex justify-content-start align-items-center">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-white ring-1 ring-white/2 hover:ring-white">
                        Register for our next Internship opportunities</a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">We are looking for the Best of the Best</h1>
                    <p class="mt-6 text-lg leading-8 text-white">Join us in seizing an extraordinary chance to excel. We invite those with unmatched passion and skill to embark on a journey where innovation meets opportunity. Every task is an adventure, every challenge a chance to shine. Let your brilliance guide you in a realm where excellence is just the beginning.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <div class="px-4">
                            @if(Auth::check())
                            <x-front-end-btn linking="{{ route('internship_application') }}" color="blue" showme="" name="Apply" />
                            @else
                            <x-front-end-btn linking="{{ route('registerintern') }}" color="blue" showme="" name="Apply" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>