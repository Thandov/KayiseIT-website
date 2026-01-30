<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <h2 class="text-2xl font-bold">Create New Internship Application</h2>
                <p class="text-blue-200">Fill in the details to create a new internship application.</p>
            </div>
            
            <form method="POST" action="{{ route('dashboard.internships.store') }}" class="p-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-2"></i>
                        Personal Informationsss
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- ID Number -->
                    <div>
                            <label for="id_no" class="block text-sm font-medium text-gray-700 mb-2">ID Number *</label>
                        <input type="text" 
                                   id="id_no" 
                                   name="id_no" 
                                   value="{{ old('id_no') }}" 
                               required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('id_no') border-red-500 @enderror" 
                                   placeholder="Enter 13-digit ID number">
                            @error('id_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Age -->
                    <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age *</label>
                            <input type="number" 
                                   id="age" 
                                   name="age" 
                                   value="{{ old('age') }}" 
                               required
                                   min="16" max="65"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('age') border-red-500 @enderror" 
                                   placeholder="Enter age">
                            @error('age')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Address -->
                    <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                            <input type="text" 
                                   id="address" 
                                   name="address" 
                                   value="{{ old('address') }}" 
                               required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror" 
                                   placeholder="Enter address">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Education Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                        Education Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- High School -->
                        <div>
                            <label for="high_school" class="block text-sm font-medium text-gray-700 mb-2">High School *</label>
                            <input type="text" 
                                   id="high_school" 
                                   name="high_school" 
                                   value="{{ old('high_school') }}" 
                                   required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('high_school') border-red-500 @enderror" 
                                   placeholder="Enter high school name">
                            @error('high_school')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Year of Completion -->
                    <div>
                            <label for="year_of_completion" class="block text-sm font-medium text-gray-700 mb-2">Year of Completion *</label>
                        <input type="text" 
                                   id="year_of_completion" 
                                   name="year_of_completion" 
                                   value="{{ old('year_of_completion') }}" 
                               required
                                   pattern="[0-9]{4}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('year_of_completion') border-red-500 @enderror" 
                                   placeholder="YYYY">
                            @error('year_of_completion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Qualification -->
                    <div>
                            <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">Highest Qualification *</label>
                            <input type="text" 
                                   id="qualification" 
                                   name="qualification" 
                                   value="{{ old('qualification') }}" 
                                   required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('qualification') border-red-500 @enderror" 
                                   placeholder="e.g., Bachelor Computer Science">
                            @error('qualification')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Year Obtained -->
                    <div>
                            <label for="year_obtained" class="block text-sm font-medium text-gray-700 mb-2">Year Obtained *</label>
                            <input type="text" 
                                   id="year_obtained" 
                                   name="year_obtained" 
                                   value="{{ old('year_obtained') }}" 
                                required
                                   pattern="[0-9]{4}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('year_obtained') border-red-500 @enderror" 
                                   placeholder="YYYY">
                            @error('year_obtained')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Institution -->
                        <div>
                            <label for="institution" class="block text-sm font-medium text-gray-700 mb-2">Institution *</label>
                            <input type="text" 
                                   id="institution" 
                                   name="institution" 
                                   value="{{ old('institution') }}" 
                                   required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('institution') border-red-500 @enderror" 
                                   placeholder="Enter university/college name">
                            @error('institution')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Application Details Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-briefcase text-purple-600 mr-2"></i>
                        Application Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Application Type -->
                        <div>
                            <label for="app_type" class="block text-sm font-medium text-gray-700 mb-2">Application Type *</label>
                            <select id="app_type" 
                                    name="app_type" 
                                    required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('app_type') border-red-500 @enderror">
                                <option value="">Select application type</option>
                                <option value="Full Time" {{ old('app_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ old('app_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Remote" {{ old('app_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                            @error('app_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Field -->
                        <div>
                            <label for="field" class="block text-sm font-medium text-gray-700 mb-2">Field of Interest *</label>
                            <select id="field" 
                                    name="field" 
                                    required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('field') border-red-500 @enderror">
                                <option value="">Select field</option>
                                <option value="Software Development" {{ old('field') == 'Software Development' ? 'selected' : '' }}>Software Development</option>
                                <option value="Web Development" {{ old('field') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                <option value="Data Analysis" {{ old('field') == 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                <option value="IT Support" {{ old('field') == 'IT Support' ? 'selected' : '' }}>IT Support</option>
                                <option value="Digital Marketing" {{ old('field') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                <option value="Others" {{ old('field') == 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('field')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-upload text-red-600 mr-2"></i>
                        Documents (Optional)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- CV Upload -->
                        <div>
                            <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-2">CV/Resume</label>
                            <input type="file" 
                                   id="cv_file" 
                                   name="cv_file" 
                                   accept=".pdf,.doc,.docx"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cv_file') border-red-500 @enderror">
                            @error('cv_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Copy Upload -->
                        <div>
                            <label for="id_copy_file" class="block text-sm font-medium text-gray-700 mb-2">ID Copy</label>
                            <input type="file" 
                                   id="id_copy_file" 
                                   name="id_copy_file" 
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('id_copy_file') border-red-500 @enderror">
                            @error('id_copy_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Qualification Copy Upload -->
                        <div>
                            <label for="qualification_copy_file" class="block text-sm font-medium text-gray-700 mb-2">Qualification Copy</label>
                            <input type="file" 
                                   id="qualification_copy_file" 
                                   name="qualification_copy_file" 
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('qualification_copy_file') border-red-500 @enderror">
                            @error('qualification_copy_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end mt-8 space-x-4">
                    <a href="{{ route('dashboard.internships') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Create Internship Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
