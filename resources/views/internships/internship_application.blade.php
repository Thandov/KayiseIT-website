<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @php
            // Array of slide names without the '.blade.php' extension
            $slides = [
            'internships.slide1',
            'internships.slide2',
            'internships.slide3',
            ];
        @endphp
        <x-multistep-form :slides="$slides" linking="{{ route('apply.store') }}" />
    </div>

</x-app-layout>
