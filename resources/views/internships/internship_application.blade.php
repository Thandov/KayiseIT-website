<x-app-layout>
@if($existingApplication != 1 || !empty($existingApplication))
        <div class="bg-slate-100">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Are you the person we are looking for?</a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Lets begin your application</h1>
                </div>
            </div>
        </div>
        <div class="max-w-3xl mx-auto my-4 sm:px-6 lg:px-8">
            @if(isset($selectedProgram) && $selectedProgram)
                <div class="mb-4 rounded-lg border border-blue-200 bg-blue-50 p-4 text-sm text-blue-900">
                    You are applying for: <strong>{{ $selectedProgram->name }}</strong>
                </div>
            @endif

            @php
                // Array of slide names without the '.blade.php' extension
                $slides = [
                'internships.slide1',
                'internships.slide2',
                'internships.slide3',
                'internships.slide4',
                ];
            @endphp
            <x-multistep-form :slides="$slides" linking="{{ route('apply.store') }}">
                @if(isset($selectedProgram) && $selectedProgram)
                    <input type="hidden" name="selected_program_id" value="{{ $selectedProgram->id }}">
                @endif
            </x-multistep-form>
        </div>
    @else
        <div class="bg-slate-100">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Awesome!</a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">We already have your application</h1>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
