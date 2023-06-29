    <!-- form to submit user inputs for occupation -->
    <form action="{{url('addcareersteps-form')}}" method="post" enctype="multipart/form-data">
        @csrf
        @php $spec_id = request()->route('spec_id'); @endphp
        <input type="hidden" name="spec_id" value="{{ $spec_id }}">
        <label for="name" class="block text-sm font-medium text-gray-700">Step Number:</label>
        <input type="number" name="step_number" id="step_number" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">

        <label for="name" class="block text-sm font-medium text-gray-700">Qualification:</label>
        <input type="text" name="qualification" id="qualification" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        <br><br>

        <div class="flex justify-end modal-footer"> <!--might need to change-->
            <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">ADD</button>
        </div>
    </form>
    <!-- java script -->
    <script>
        function previewImage(event) {
            // Send the FormData object to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/store-form');
            xhr.send(formData);
        }
    </script>