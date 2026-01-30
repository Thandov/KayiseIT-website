@extends('admin.dashboard.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Create New Case Study</h2>
                <p class="mt-1 text-sm text-gray-600">Add a new client case study to showcase your work.</p>
            </div>

            <form action="{{ route('dashboard.case-studies.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client Name -->
                <div class="mb-6">
                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Client Name (Optional)
                    </label>
                    <input type="text" 
                           name="client_name" 
                           id="client_name" 
                           value="{{ old('client_name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('client_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year -->
                <div class="mb-6">
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                        Year (Optional)
                    </label>
                    <input type="text" 
                           name="year" 
                           id="year" 
                           value="{{ old('year') }}"
                           placeholder="2024"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Featured Image (Optional but Recommended)
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Recommended size: 1200x600px. Maximum file size: 2MB. Formats: JPEG, PNG, GIF, WebP</p>
                </div>

                <!-- Hyperlink -->
                <div class="mb-6">
                    <label for="hyperlink" class="block text-sm font-medium text-gray-700 mb-2">
                        Project Hyperlink (Optional)
                    </label>
                    <input type="url" 
                           name="hyperlink" 
                           id="hyperlink" 
                           value="{{ old('hyperlink') }}"
                           placeholder="https://example.com"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('hyperlink')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Add a link to the live project or case study page (e.g., website URL)</p>
                </div>

                <!-- Has Gallery -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="has_gallery" 
                               id="has_gallery"
                               value="1"
                               class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                               onchange="toggleGallerySection()">
                        <span class="ml-2 text-sm font-medium text-gray-700">Enable Gallery (Use when you can't add hyperlink for security reasons)</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">When enabled, you can upload multiple images to showcase the project visually</p>
                </div>

                <!-- Gallery Images Section -->
                <div id="gallerySection" class="mb-6 hidden">
                    <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">
                        Gallery Images (Multiple images allowed)
                    </label>
                    <input type="file" 
                           name="gallery_images[]" 
                           id="gallery_images" 
                           multiple
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('gallery_images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Upload multiple images to create a visual gallery. Maximum file size: 2MB per image. Formats: JPEG, PNG, GIF, WebP</p>
                </div>

                <!-- The Problem -->
                <div class="mb-6">
                    <label for="problem" class="block text-sm font-medium text-gray-700 mb-2">
                        The Problem <span class="text-red-500">*</span>
                    </label>
                    <textarea name="problem" 
                              id="problem" 
                              rows="4"
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('problem') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Describe the client's challenge or problem.</p>
                    @error('problem')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- How KAYISE IT Solved It -->
                <div class="mb-6">
                    <label for="solution" class="block text-sm font-medium text-gray-700 mb-2">
                        How KAYISE IT Solved It <span class="text-red-500">*</span>
                    </label>
                    <textarea name="solution" 
                              id="solution" 
                              rows="4"
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('solution') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Explain your approach and solution.</p>
                    @error('solution')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Results Summary -->
                <div class="mb-6">
                    <label for="results" class="block text-sm font-medium text-gray-700 mb-2">
                        Results Summary (Optional)
                    </label>
                    <textarea name="results" 
                              id="results" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('results') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">A brief summary of the results achieved.</p>
                    @error('results')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Results List -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Results List (Optional)
                    </label>
                    <div id="results-list-container">
                        <div class="result-item mb-3">
                            <input type="text" 
                                   name="results_list[0][text]" 
                                   placeholder="e.g., +75% increase in delivery speed"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>
                    <button type="button" 
                            onclick="addResultItem()" 
                            class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm">
                        <i class="fas fa-plus mr-2"></i>Add Result Item
                    </button>
                    <p class="mt-1 text-sm text-gray-500">Add specific, measurable results (one per line).</p>
                </div>

                <!-- Status Options -->
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-700">Featured</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <!-- Order -->
                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Display Order (Optional)
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first. Default: 0</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('dashboard.case-studies.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Create Case Study
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let resultItemCount = 1;
        function addResultItem() {
            const container = document.getElementById('results-list-container');
            const newItem = document.createElement('div');
            newItem.className = 'result-item mb-3';
            newItem.innerHTML = `
                <div class="flex items-center">
                    <input type="text" 
                           name="results_list[${resultItemCount}][text]" 
                           placeholder="e.g., +75% increase in delivery speed"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <button type="button" 
                            onclick="this.parentElement.parentElement.remove()" 
                            class="ml-2 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newItem);
            resultItemCount++;
        }
    </script>
@endsection

