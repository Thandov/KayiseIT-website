<x-app-layout>
    <div class="py-10 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">USINA Registration</h1>

                @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-green-800">
                    {{ session('success') }}
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

                <form method="POST" action="{{ route('usina.store') }}" enctype="multipart/form-data" class="space-y-6">
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

                        <div>
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number<span class="text-red-600">*</span></label>
                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="contact" class="block text-sm font-medium text-gray-700">Contact<span class="text-red-600">*</span></label>
                            <input type="tel" id="contact" name="contact" value="{{ old('contact') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="highest_qualification" class="block text-sm font-medium text-gray-700">Highest Qualification</label>
                            <input type="text" id="highest_qualification" name="highest_qualification" value="{{ old('highest_qualification') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label for="own_business" class="block text-sm font-medium text-gray-700">Own Business?</label>
                            <select id="own_business" name="own_business" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" {{ old('own_business') === null ? 'selected' : '' }}>Select</option>
                                <option value="1" {{ old('own_business') === '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('own_business') === '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label for="unemployed" class="block text-sm font-medium text-gray-700">Unemployed?</label>
                            <select id="unemployed" name="unemployed" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" {{ old('unemployed') === null ? 'selected' : '' }}>Select</option>
                                <option value="1" {{ old('unemployed') === '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('unemployed') === '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div>
                            <label for="youth" class="block text-sm font-medium text-gray-700">Youth?</label>
                            <select id="youth" name="youth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" {{ old('youth') === null ? 'selected' : '' }}>Select</option>
                                <option value="1" {{ old('youth') === '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('youth') === '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div>
                            <label for="id_upload" class="block text-sm font-medium text-gray-700">ID Upload</label>
                            <input type="file" id="id_upload" name="id_upload" accept="image/*,application/pdf" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


