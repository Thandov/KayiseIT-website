<div class="bg-white shadow overflow-hidden sm:rounded-lg p-4 mb-4">
     <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <form name="businessdash" id="businessdash" action="{{url('store-form')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-2 relative">
                <label for="logo" class="block text-sm font-medium text-gray-700">Logo:</label>
                <div class="imguploadwrap">
                    <x-img-upload image="" classing="bigTall" />
                </div>
            </div>
            <div class="col-span-3">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Service Name:</label>
                    <input type="name" name="name" id="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></textarea>
                </div>

                <div class="grid md:grid-cols-5 gap-4">
                    <div class="col-span-3">
                        <label for="service_type" class="block text-sm font-medium text-gray-700">Service Type:</label>
                        <select type="service_type" name="service_type" id="service_type" class="mt-1 form-select block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="static">Static</option>
                            <option value="dynamic">Dynamic</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                        <input type="number" name="price" id="price" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div class="flex justify-end modal-footer">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" type="submit">ADD</button>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var formData = new FormData();
        formData.append('icon', file);

        var preview = document.getElementById('preview');
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(file);

        // Send the FormData object to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/store-form');
        xhr.send(formData);
    }
</script>