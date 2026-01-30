@extends('admin.dashboard.layout')

@section('page-title', 'Edit Partner')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Partner</h2>
                <p class="text-sm text-gray-600">Update partner information</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Partner Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $partner->name) }}"
                                   required
                                   class="mt-1 focus:ring-kb-500 focus:border-kb-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="partner_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Partner Type
                            </label>
                            <select name="partner_type" 
                                    id="partner_type"
                                    class="mt-1 focus:ring-kb-500 focus:border-kb-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('partner_type') border-red-500 @enderror">
                                <option value="">Select Type</option>
                                <option value="Skills Development" {{ old('partner_type', $partner->partner_type) == 'Skills Development' ? 'selected' : '' }}>Skills Development</option>
                                <option value="JV" {{ old('partner_type', $partner->partner_type) == 'JV' ? 'selected' : '' }}>JV</option>
                                <option value="Sponsor" {{ old('partner_type', $partner->partner_type) == 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
                                <option value="Other" {{ old('partner_type', $partner->partner_type) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('partner_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="website_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Website URL
                            </label>
                            <input type="url" 
                                   name="website_url" 
                                   id="website_url" 
                                   value="{{ old('website_url', $partner->website_url) }}"
                                   placeholder="https://example.com"
                                   class="mt-1 focus:ring-kb-500 focus:border-kb-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('website_url') border-red-500 @enderror">
                            @error('website_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">
                                Display Order
                            </label>
                            <input type="number" 
                                   name="display_order" 
                                   id="display_order" 
                                   value="{{ old('display_order', $partner->display_order) }}"
                                   min="0"
                                   class="mt-1 focus:ring-kb-500 focus:border-kb-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('display_order') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                            @error('display_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $partner->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-kb-600 shadow-sm focus:border-kb-300 focus:ring focus:ring-offset-0 focus:ring-kb-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                                Partner Logo
                            </label>
                            
                            @if($partner->logo_path)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current Logo:</p>
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                                         alt="{{ $partner->name }}" 
                                         class="h-24 w-auto object-contain bg-gray-50 p-2 rounded border border-gray-200">
                                </div>
                            @endif

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-kb-400 transition-colors">
                                <div class="space-y-3 text-center w-full">
                                    <div id="logo-placeholder-edit" class="space-y-1">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-kb-600 hover:text-kb-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-kb-500">
                                                <span>Upload a new file</span>
                                                <input id="logo" name="logo" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG up to 2MB</p>
                                        <p class="text-xs text-gray-400">Leave empty to keep current logo</p>
                                    </div>

                                    {{-- Live preview for updated logo --}}
                                    <img id="logo-preview-edit" class="mx-auto h-24 w-auto object-contain rounded-md border border-gray-200 bg-gray-50 hidden" alt="Partner logo preview">
                                </div>
                            </div>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="mt-1 focus:ring-kb-500 focus:border-kb-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboard.partners') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-500">
                        Update Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('logo');
            const previewImg = document.getElementById('logo-preview-edit');
            const placeholder = document.getElementById('logo-placeholder-edit');

            if (!fileInput || !previewImg) return;

            fileInput.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (!file) {
                    previewImg.src = '';
                    previewImg.classList.add('hidden');
                    if (placeholder) placeholder.classList.remove('hidden');
                    return;
                }

                const url = URL.createObjectURL(file);
                previewImg.src = url;
                previewImg.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            });
        });
    </script>
@endsection
