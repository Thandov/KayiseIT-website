<x-app-layout>
    <div class="bg-slate-100">
        <div class="mx-auto max-w-2xl py-32">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                    Register for our next Internship opportunities</a>
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">We are looking for the Best of the Best</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Join us in seizing an extraordinary chance to excel. We invite those with unmatched passion and skill to embark on a journey where innovation meets opportunity. Every task is an adventure, every challenge a chance to shine. Let your brilliance guide you in a realm where excellence is just the beginning.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <div class="px-4">
                        @if(Auth::check())
                            <x-front-end-btn linking="{{ route('internship_application') }}" color="blue" showme="" name="Thando" />
                        @else
                            <a href="{{ route('registerintern') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPssLY</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
