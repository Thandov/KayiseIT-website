<x-app-layout>
    <div>
        <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
        <form action="{{ url('/admin/career_mapping/specialization/edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization Name:</label>
                <input type="specialization" name="specialization_name" id="specialization" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
            </div>
            <h3>{{ $specializations->specialization_name }}</h3>
            <div class="flex justify-end modal-footer">
                <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>