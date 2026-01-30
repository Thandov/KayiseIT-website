<!-- Upload Progress Modal (on top of upload modal) -->
<div id="upload-progress-modal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-[60]">
    <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-lg mx-4 p-8">
        <div class="text-center">
            <!-- Warning Icon -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <!-- Title -->
            <h3 class="text-2xl font-bold text-gray-900 mb-2" id="progress-title">Preparing Upload</h3>
            
            <!-- Status Message -->
            <p class="text-gray-600 mb-6" id="progress-status">Initializing image processing...</p>
            
            <!-- Progress Bar Container -->
            <div class="w-full bg-gray-200 rounded-full h-4 mb-4 overflow-hidden">
                <div id="progress-bar" class="bg-gradient-to-r from-kb-100 to-kb-200 h-4 rounded-full transition-all duration-300 ease-out" style="width: 0%">
                    <div class="h-full bg-white bg-opacity-30 animate-pulse"></div>
                </div>
            </div>
            
            <!-- Progress Percentage -->
            <div class="text-sm font-semibold text-gray-700 mb-6">
                <span id="progress-percentage">0%</span>
                <span class="text-gray-500"> (<span id="progress-current">0</span> / <span id="progress-total">0</span> images)</span>
            </div>
            
            <!-- Warning Message -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-yellow-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-yellow-800">
                        <strong>Please do not close this window or refresh the page</strong> while images are being processed. This may take a few moments depending on the number and size of images.
                    </p>
                </div>
            </div>
            
            <!-- Current File Name -->
            <div class="text-xs text-gray-500 mt-4">
                <span id="current-file-name" class="font-medium"></span>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Upload Modal -->
<div class="p-6 bg-white">
    <!-- Modal Header -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
        <div>
        <h3 class="text-xl font-semibold text-gray-900">Upload Images</h3>
            <p class="text-sm text-gray-500 mt-1">Images will be automatically optimized for web (max 1920x1080, 85% quality)</p>
        </div>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <form id="mainForm" action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Category Selection -->
        <fieldset class="mb-6">
            <div class="bg-gray-50 p-4 rounded-xl">
                <legend class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-kb-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Category
                </legend>
                <div class="space-y-4">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Select a category</label>
                        <select id="category" name="category" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-kb-100 focus:ring-2 focus:ring-kb-50 focus:ring-opacity-50 transition-all duration-200" required>
                            <option value="" disabled selected>Choose a category</option>
                            @if(isset($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                            <option value="add_cat">+ Create new category</option>
                        </select>
                    </div>
                    <div class="transition-all duration-300 overflow-hidden" id="newCategoryContainer" style="display: none; max-height: 0;">
                        <div class="mt-4 p-4 bg-kg-50 border border-kg-200 rounded-lg space-y-3">
                            <div>
                                <label for="newCategory" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="text-kg-700 font-semibold">New Category Name *</span>
                                </label>
                                <input type="text" id="newCategory" name="newCategory" placeholder="e.g., Team Photos, Events 2024" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-kb-100 focus:ring-2 focus:ring-kb-50 focus:ring-opacity-50 transition-all duration-200" required>
                            </div>
                            <div>
                                <label for="newCategoryDescription" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="text-gray-600">Description (optional)</span>
                                </label>
                                <textarea id="newCategoryDescription" name="newCategoryDescription" rows="2" placeholder="Brief description of this category..." class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-kb-100 focus:ring-2 focus:ring-kb-50 focus:ring-opacity-50 transition-all duration-200"></textarea>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                You can upload images immediately after creating the category
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- File Upload Section -->
        <fieldset class="mb-6">
            <div class="bg-kb-50 p-6 rounded-xl border border-kb-200">
                <legend class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-kg-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Files
                </legend>
                
                <div class="flex items-center justify-center">
                    <input type="file" name="images[]" id="images" class="hidden" multiple accept="image/*">
                    <div id="uploadTrigger" class="group cursor-pointer bg-white rounded-lg border-2 border-dashed border-kb-200 hover:border-kb-100 hover:bg-kb-50 transition-all duration-200 p-8 text-center w-full">
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#183ea4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-4 group-hover:scale-110 transition-transform duration-200">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            <h4 class="text-lg font-medium text-kb-100 group-hover:text-kb-200 mb-2">Drop images here or click to browse</h4>
                            <p class="text-sm text-gray-500 group-hover:text-gray-600">PNG, JPG, and GIF files up to 10MB</p>
                        </div>
                    </div>
                </div>
                
                <!-- Image Previews -->
                <div class="mt-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="imagePreviews"></div>
                </div>
            </div>
        </fieldset>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200" id="upload-action-buttons">
            <button type="button" onclick="closeModal()" class="px-6 py-3 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 font-medium transition-all duration-200" id="cancel-upload-btn">Cancel</button>
            <button type="submit" class="px-8 py-3 bg-kb-100 text-white rounded-lg hover:bg-kb-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200" id="submit-upload-btn">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Images
                </span>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const newCategoryContainer = document.getElementById('newCategoryContainer');
        const newCategoryInput = document.getElementById('newCategory');
        const form = document.getElementById('mainForm');
        let selectedFiles = [];

        // Category selection handling with smooth animation
        categorySelect.addEventListener('change', function() {
            if (categorySelect.value === 'add_cat') {
                newCategoryContainer.style.display = 'block';
                newCategoryContainer.style.maxHeight = '300px';
                setTimeout(() => {
                    newCategoryContainer.style.transition = 'max-height 0.3s ease-in-out';
                }, 10);
                newCategoryInput.setAttribute('required', 'required');
                newCategoryInput.focus();
            } else {
                newCategoryContainer.style.maxHeight = '0';
                setTimeout(() => {
                newCategoryContainer.style.display = 'none';
                }, 300);
                newCategoryInput.removeAttribute('required');
            }
        });

        // File upload trigger
        const uploadTrigger = document.getElementById('uploadTrigger');
        const hiddenFileInput = document.getElementById('images');
        
        uploadTrigger.addEventListener('click', function() {
            hiddenFileInput.click();
        });

        // File input handling
        hiddenFileInput.addEventListener('change', function(e) {
            selectedFiles = [...this.files];
            renderPreviews();
        });

        // Drag and drop functionality
        uploadTrigger.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-kb-100', 'bg-kb-50');
        });

        uploadTrigger.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-kb-100', 'bg-kb-50');
        });

        uploadTrigger.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-kb-100', 'bg-kb-50');
            const droppedFiles = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
            selectedFiles = [...selectedFiles, ...droppedFiles];
            renderPreviews();
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (selectedFiles.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please select at least one image to upload.',
                    confirmButtonColor: '#183ea4'
                });
                return;
            }

            // Validate category selection
            if (!categorySelect.value || categorySelect.value === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Category Required',
                    text: 'Please select a category or create a new one.',
                    confirmButtonColor: '#183ea4'
                });
                categorySelect.focus();
                return;
            }

            if (categorySelect.value === 'add_cat') {
                if (!newCategoryInput.value.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Category Name Required',
                        text: 'Please enter a name for the new category.',
                        confirmButtonColor: '#183ea4'
                    });
                    newCategoryInput.focus();
                    return;
                }
            }

            let formData = new FormData();
            
            // Add CSRF token
            formData.append('_token', document.querySelector('[name="_token"]').value);
            
            // Add category
            if (categorySelect.value === 'add_cat') {
                formData.append('category', 'add_cat');
                formData.append('newCategory', newCategoryInput.value.trim());
                const descriptionInput = document.getElementById('newCategoryDescription');
                if (descriptionInput && descriptionInput.value.trim()) {
                    formData.append('description', descriptionInput.value.trim());
                }
            } else {
                formData.append('category', categorySelect.value);
            }

            // Add the selected files
            selectedFiles.forEach((file) => {
                formData.append('images[]', file);
            });

            // Set upload state
            isUploading = true;

            // Disable all buttons and inputs
            const submitBtn = document.querySelector('button[type="submit"]');
            const cancelBtn = document.querySelector('button[onclick="closeModal()"]');
            const allButtons = document.querySelectorAll('button, input, select, textarea');
            allButtons.forEach(btn => {
                btn.disabled = true;
                btn.style.pointerEvents = 'none';
            });

            // Show progress modal
            const progressModal = document.getElementById('upload-progress-modal');
            const progressBar = document.getElementById('progress-bar');
            const progressPercentage = document.getElementById('progress-percentage');
            const progressStatus = document.getElementById('progress-status');
            const progressTitle = document.getElementById('progress-title');
            const progressCurrent = document.getElementById('progress-current');
            const progressTotal = document.getElementById('progress-total');
            const currentFileName = document.getElementById('current-file-name');
            
            const totalFiles = selectedFiles.length;
            progressTotal.textContent = totalFiles;
            progressCurrent.textContent = '0';
            
            progressModal.classList.remove('hidden');
            progressModal.classList.add('flex');

            // Update progress function
            function updateProgress(percent, status, title, currentFile = '') {
                progressBar.style.width = percent + '%';
                progressPercentage.textContent = Math.round(percent) + '%';
                progressStatus.textContent = status;
                if (title) progressTitle.textContent = title;
                if (currentFile) currentFileName.textContent = 'Processing: ' + currentFile;
            }

            // Simulate processing steps
            let currentStep = 0;
            const steps = [
                { percent: 5, status: 'Preparing files...', title: 'Preparing Upload' },
                { percent: 10, status: 'Validating images...', title: 'Validating Images' },
                { percent: 15, status: 'Creating category (if needed)...', title: 'Setting Up Category' }
            ];

            // Show initial steps
            updateProgress(5, 'Preparing files...', 'Preparing Upload');
            
            // Use XMLHttpRequest for upload progress tracking
            const xhr = new XMLHttpRequest();
            let uploadStarted = false;

            // Track upload progress
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable && !uploadStarted) {
                    uploadStarted = true;
                    updateProgress(20, 'Uploading images to server...', 'Uploading Images');
                }
                
                if (e.lengthComputable) {
                    // Upload progress: 20% to 60%
                    const uploadPercent = 20 + (e.loaded / e.total) * 40;
                    updateProgress(uploadPercent, `Uploading... ${Math.round((e.loaded / e.total) * 100)}%`, 'Uploading Images');
                }
            });

            // Handle response
            xhr.addEventListener('load', function() {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        
                if (data.success) {
                            // Processing: 60% to 90%
                            updateProgress(60, 'Processing images...', 'Processing Images');
                            
                            // Simulate processing steps
                            setTimeout(() => {
                                updateProgress(70, 'Optimizing images (resizing)...', 'Optimizing Images');
                            }, 500);
                            
                            setTimeout(() => {
                                updateProgress(80, 'Compressing images...', 'Compressing Images');
                            }, 1000);
                            
                            setTimeout(() => {
                                updateProgress(90, 'Saving to database...', 'Saving Images');
                            }, 1500);
                            
                            setTimeout(() => {
                                updateProgress(100, 'Complete!', 'Upload Complete');
                                
                                setTimeout(() => {
                                    isUploading = false;
                                    progressModal.classList.add('hidden');
                                    progressModal.classList.remove('flex');
                                    
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: data.message || `Successfully uploaded ${totalFiles} image(s)!`,
                                        confirmButtonColor: '#183ea4',
                                        timer: 2000,
                                        showConfirmButton: true
                                    }).then(() => {
                    location.reload();
                                    });
                                }, 500);
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Upload failed');
                        }
                    } catch (error) {
                        throw new Error(error.message || 'Failed to process response');
                    }
                } else {
                    throw new Error('Server error: ' + xhr.status);
                }
            });

            xhr.addEventListener('error', function() {
                isUploading = false;
                progressModal.classList.add('hidden');
                progressModal.classList.remove('flex');
                allButtons.forEach(btn => {
                    btn.disabled = false;
                    btn.style.pointerEvents = '';
                });
                
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: 'Network error occurred. Please check your connection and try again.',
                    confirmButtonColor: '#183ea4'
                });
            });

            xhr.addEventListener('abort', function() {
                isUploading = false;
                progressModal.classList.add('hidden');
                progressModal.classList.remove('flex');
                allButtons.forEach(btn => {
                    btn.disabled = false;
                    btn.style.pointerEvents = '';
                });
            });

            // Start upload
            updateProgress(15, 'Starting upload...', 'Starting Upload');
            
            xhr.open('POST', form.action);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('[name="_token"]').value);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            
            // Prevent page unload during upload
            let uploadInProgress = true;
            window.addEventListener('beforeunload', function(e) {
                if (uploadInProgress) {
                    e.preventDefault();
                    e.returnValue = 'Images are currently being uploaded. Are you sure you want to leave?';
                    return e.returnValue;
                }
            });

            xhr.send(formData);
            
            // Reset upload flag when done
            xhr.addEventListener('loadend', function() {
                uploadInProgress = false;
                isUploading = false;
            });
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

            if (selectedFiles.length === 0) {
                return;
            }

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'relative group transition-all duration-300 transform hover:scale-105';
                    
                    imgDiv.innerHTML = `
                        <div class="relative overflow-hidden rounded-lg shadow-md bg-white">
                            <img src="${e.target.result}" alt="Upload preview ${index}" class="w-full h-32 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                                <button type="button" class="removeBtn opacity-0 group-hover:opacity-100 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-2 bg-gray-50">
                                <p class="text-xs text-gray-600 truncate">${file.name}</p>
                                <p class="text-xs text-gray-400">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                            </div>
                        </div>
                    `;

                    imagePreviews.appendChild(imgDiv);

                    imgDiv.querySelector('.removeBtn').addEventListener('click', function(e) {
                        e.stopPropagation();
                        removeImage(file);
                    });
                };

                reader.readAsDataURL(file);
            });
        }

        // Track upload state
        let isUploading = false;

        // Close modal functionality
        window.closeModal = function() {
            if (isUploading) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Upload in Progress',
                    text: 'Please wait for the upload to complete before closing.',
                    confirmButtonColor: '#183ea4'
                });
                return;
            }
            document.getElementById('upload-modal').classList.add('hidden');
            document.getElementById('upload-modal').classList.remove('flex');
        };
    });
</script>