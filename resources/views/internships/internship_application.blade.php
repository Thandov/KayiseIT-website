<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden">
            <div class="p-6">
                @if(session('success'))
                <div class="bg-green-200 text-green-800 rounded-lg p-4 mb-4">{{ session('success') }}</div>
                @endif
                <h1 class="my-5 text-bold">Complete Application</h1>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="phone" class="block mb-2">Phone Number:</label>
                        <input type="text" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Physical Address -->
                    <div class="mb-4">
                        <label for="address" class="block mb-2">Physical Address:</label>
                        <input type="text" id="address" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- ID Number -->
                    <div class="mb-4">
                        <label for="id_number" class="block mb-2">ID Number:</label>
                        <input type="text" id="id_number" name="id_number" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Age -->
                    <div class="mb-4">
                        <label for="age" class="block mb-2">Age:</label>
                        <input type="number" id="age" name="age" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Highest Qualification -->
                    <div class="mb-4">
                        <label for="qualification" class="block mb-2">Highest Qualification:</label>
                        <input type="text" id="qualification" name="qualification" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Year Obtained -->
                    <div class="mb-4">
                        <label for="year_obtained" class="block mb-2">Year Obtained:</label>
                        <input type="text" id="year_obtained" name="year_obtained" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Institution -->
                    <div class="mb-4">
                        <label for="institution" class="block mb-2">Institution:</label>
                        <input type="text" id="institution" name="institution" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="cv" class="block mb-2">CV:</label>
                        <input type="file" id="cv" name="cv" accept=".pdf" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="id_copy" class="block mb-2">ID Copy:</label>
                        <input type="file" id="id_copy" name="id_copy" accept=".pdf" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="qualification_copy" class="block mb-2">Qualification Copy:</label>
                        <input type="file" id="qualification_copy" name="qualification_copy" accept=".pdf" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>