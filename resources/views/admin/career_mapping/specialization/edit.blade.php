<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CAREER MAPPING') }}
        </h2>
    </x-slot>
    <section>
        <div class="md:flex justify-center py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
            <div class="bg-white rounded-md shadow-md px-5 py-4">
                <form action="{{ url('/admin/career_mapping/specialization/editspecialization') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @php $spec_id = request()->route('spec_id'); @endphp
                    <input type="hidden" name="spec_id" value="{{ $spec_id }}">
                    <div class="mb-4">
                        <label for="specialization" class="text-center mb-4 font-bold">Update Specialization Name:</label>
                        <input type="text" value="{{ \App\Models\Specializations::findOrFail($spec_id)->specialization_name }}" name="specialization_name" id="specialization" class="mt-1 form-input block w-full text-center py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="flex justify-center">
                        <button id="updateButton" class="w-full px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        // Add event listener to the button
        document.getElementById('updateButton').addEventListener('click', function() {
            // Go back to the previous page
            history.back();
        });
    </script>
</x-app-layout>
