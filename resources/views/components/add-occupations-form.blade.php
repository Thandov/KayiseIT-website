<dialog>
    <!-- form to submit user inputs for occupation -->
    <form>
        <!-- image drag and drop -->
        <div class="mb-4 relative">
            <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
            <div class="image-upload-box border-dashed border-gray-300 bg-white rounded-md shadow-sm overflow-hidden">
                <input name="image" class="image-upload-input absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="logo" accept="image/*" onchange="previewImage(event)"> <!-- edit later -->
                <div class="placeholder-text absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-6 h-6 mb-2 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm2 2v8h8V6H4zm10 8a4 4 0 11-8 0 4 4 0 018 0zm-1.414-1.414a2 2 0 00-2.828-2.828l-1.414 1.414a4 4 0 005.656 5.656l1.414-1.414a2 2 0 00-2.828-2.828l-1.414 1.414zM12 10a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm">Drag and drop your logo or click to browse</span>
                    <img id="preview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: auto;">
                </div>
            </div>
        </div>

        <label for="name" class="block text-sm font-medium text-gray-700">Occupation Name:</label>
        <input type="text" name="occupation_name" id="occupation_name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        <br><br>

        <div class="flex justify-end modal-footer"> <!--might need to change-->
            <!-- <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">ADD</button> -->
        </div>
        <input type="submit" value="Submit">
    </form>
</dialog>
<!-- java script -->
<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var formData = new FormData();
        formData.append('image', file);

        var preview = document.getElementById('preview');
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(file);

        // Send the FormData object to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/store-form');
        xhr.send(formData);
    }
</script>