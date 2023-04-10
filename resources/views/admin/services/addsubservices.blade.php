<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD SUBSERVICES') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-5">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-lg overflow-hidden shadow-md">
                <form action="{{ route('addsubservices.storing', $service->id) }}" method="post" enctype="multipart/form-data" class="px-6 py-4">
                    @csrf

                    <div class="mb-4">
                        <label for="icon" class="block text-gray-700 font-bold mb-2">Icon:</label>
                        <input name="icon" class="form-input w-full" type="file" id="icon">
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Subservice Name:</label>
                        <input name="name" id="name" type="text" class="form-input w-full" />
                    </div>

                    <div class="mb-4">
                        <label for="subservice_type" class="block text-gray-700 font-bold mb-2">Subservice Type:</label>
                        <select name="subservice_type" id="subservice_type" class="form-select w-full">
                            <option value="static">Static</option>
                            <option value="dynamic">Dynamic</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Price:</label>
                        <input type="number" name="price" id="price" class="form-input w-full" step="0.01" />
                    </div>

                    <div class="flex justify-end">
                        <button style="background-color: green" class="px-4 py-2 text-white font-bold bg-green-500 rounded hover:bg-green-600" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>