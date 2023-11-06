<form id="mainForm" action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset class="border p-4 rounded-lg">
        <legend class="text-lg font-semibold">Category</legend>
        <div class="mt-4">
            <label for "category" class="block text-sm font-medium text-gray-700">Select a category</label>
            <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" disabled selected>Select a category</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="add_cat">Add new category</option>
            </select>
        </div>
        <div class="mt-4" id="newCategoryContainer" style="display: none;">
            <label for="newCategory" class="block text-sm font-medium text-gray-700">Add new category</label>
            <input type="text" id="newCategory" name="newCategory" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
    </fieldset>
    <fieldset class="border p-4 rounded-lg mt-8">
        <div class="grid grid-cols-6">
            <div class="col-start-1 col-span-3">
                <legend class="text-lg font-semibold">Upload image(s)</legend>
            </div>
            <div class="col-start-4 col-span-1">
                <input type="file" name="images[]" id="images" class="hidden" multiple>
                <div id="uploadTrigger" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <div class="flex flex-wrap" id="imagePreviews"></div>
        </div>
    </fieldset>

    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover-bg-indigo-600">Submit</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const newCategoryContainer = document.getElementById('newCategoryContainer');
        const newCategoryInput = document.getElementById('newCategory');
        const form = document.getElementById('mainForm');

        categorySelect.addEventListener('change', function() {
            if (categorySelect.value === 'add_cat') {
                newCategoryContainer.style.display = 'block';
                newCategoryInput.setAttribute('required', 'required');
            } else {
                newCategoryContainer.style.display = 'none';
                newCategoryInput.removeAttribute('required');
            }
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(form);

            if (categorySelect.value === 'add_cat') {
                formData.delete('category');
            } else {
                formData.delete('newCategory');
            }

            // Add the selected files
            selectedFiles.forEach((file) => {
                formData.append('images[]', file);
            });

            // manually submit the form
            fetch(form.action, {
                method: 'POST',
                body: formData
            }).then(response => response.text()).then(console.log);
            form.submit();

        });

        let selectedFiles = [];

        // Trigger the hidden file input
        document.getElementById('uploadTrigger').addEventListener('click', function() {
            document.getElementById('images').click();
        });

        // Update the selectedFiles array and render previews whenever new files are selected
        document.getElementById('images').addEventListener('change', function() {
            selectedFiles = [...this.files];
            renderPreviews();
        });

        function removeImage(fileToRemove) {
            const index = selectedFiles.indexOf(fileToRemove);
            if (index > -1) {
                selectedFiles.splice(index, 1);
            }
            renderPreviews();
        }

        function renderPreviews() {
            const imagePreviews = document.getElementById('imagePreviews');
            imagePreviews.innerHTML = '';

            selectedFiles.forEach((file) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.classList.add('w-1/2', 'p-2');

                    imgDiv.innerHTML = `
                        <div class="imgWrapper relative rounded overflow-hidden shadow-lg">
                            <img src="${e.target.result}" alt="Uploaded Image" class="w-full">
                            <div class="absolute top-0 right-0 mt-2 mr-2 bg-red-500 rounded-full cursor-pointer p-1 removeBtn">
                                &times;
                            </div>
                        </div>
                    `;

                    imagePreviews.appendChild(imgDiv);

                    imgDiv.querySelector('.removeBtn').addEventListener('click', function() {
                        removeImage(file);
                    });
                };

                reader.readAsDataURL(file);
            });
        }
    });
</script>