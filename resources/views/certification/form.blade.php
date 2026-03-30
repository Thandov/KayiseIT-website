<x-app-layout title="Request Your Certificate">
    <div class="pt-24 pb-10 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Request Your Certificate</h1>
                <p class="text-gray-600 mb-6">Enter your details below. We will verify your ID against our learner records and generate your certificate if you are eligible. You do not need to log in.</p>

                @if (session('success'))
                    <div class="mb-6 rounded-md bg-green-50 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-800">
                        <div class="font-semibold mb-2">Please fix the following errors:</div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('certification.submit') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name<span class="text-red-600">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="surname" class="block text-sm font-medium text-gray-700">Surname<span class="text-red-600">*</span></label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div class="sm:col-span-2">
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number<span class="text-red-600">*</span></label>
                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required placeholder="13-digit ID number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Eligibility is determined by your ID number. It must appear in our learner records.</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Optional. Used to send you the certificate or contact you if needed.</p>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap gap-4 items-center">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Generate certificate
                        </button>
                        <p class="text-sm text-gray-500">If your ID is not found, you will see a message and can contact support.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
