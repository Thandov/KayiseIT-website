<x-app-layout>
    <div class="md:col-span-5 mb-4">
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