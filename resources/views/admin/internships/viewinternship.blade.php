<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Application Details</h1>
        <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
            <p class="mb-4"><strong>Name:</strong> {{ $internships->name }}</p>
            <!-- Add other applicant details -->
            <p class="mb-4"><strong>Email:</strong> {{ $internships->email }}</p>
            <p class="mb-4"><strong>Phone Number:</strong> {{ $internships->phone_no }}</p>
            <p class="mb-4"><strong>Physical Address:</strong> {{ $internships->address }}</p>
            <p class="mb-4"><strong>ID Number:</strong> {{ $internships->id_no }}</p>
            <p class="mb-4"><strong>Age:</strong> {{ $internships->age }}</p>
            <p class="mb-4"><strong>Highest Qualification:</strong> {{ $internships->qualification }}</p>
            <p class="mb-4"><strong>Year Obtained:</strong> {{ $internships->year_obtained }}</p>
            <p class="mb-4"><strong>Institution:</strong> {{ $internships->institution }}</p>

            <h2 class="text-xl font-bold mt-6 mb-2">Download PDFs</h2>

            <p class="mb-2"><a href="{{ route('internship.download', ['id' => $internships->id, 'type' => 'cv']) }}" class="text-blue-500 hover:text-blue-700">Download CV</a></p>
            <p class="mb-2"><a href="{{ route('internship.download', ['id' => $internships->id, 'type' => 'id_copy']) }}" class="text-blue-500 hover:text-blue-700">Download ID Copy</a></p>
            <p class="mb-2"><a href="{{ route('internship.download', ['id' => $internships->id, 'type' => 'qualification_copy']) }}" class="text-blue-500 hover:text-blue-700">Download Qualification Copy</a></p>

        </div>
    </div>
</x-app-layout>