<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-[#183ea4] text-white">
                <h2 class="text-2xl font-bold">Internship Application Details</h2>
                <p class="text-blue-200">View and manage internship application details</p>
            </div>
            
            <div class="p-6">
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-2"></i>
                        Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">ID Number</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->id_no ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Age</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->age ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Address</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->address ?? 'N/A' }}</p>
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
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">High School</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->high_school ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Year of Completion</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->year_of_completion ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Qualification</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->qualification ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Year Obtained</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->year_obtained ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Institution</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->institution ?? 'N/A' }}</p>
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
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Application Type</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->app_type ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Field of Interest</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->field ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Application ID</label>
                            <p class="text-sm text-gray-900 mt-1 font-mono">{{ $internship->app_id ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Application Date</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $internship->created_at->format('M d, Y H:i A') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-upload text-red-600 mr-2"></i>
                        Documents
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($internship->cv_path)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">CV/Resume</label>
                            <a href="{{ asset('storage/' . $internship->cv_path) }}" 
                               target="_blank" 
                               class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-flex items-center">
                                <i class="fas fa-download mr-1"></i>
                                {{ basename($internship->cv_path) }}
                            </a>
                        </div>
                        @endif

                        @if($internship->id_copy_path)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">ID Copy</label>
                            <a href="{{ asset('storage/' . $internship->id_copy_path) }}" 
                               target="_blank" 
                               class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-flex items-center">
                                <i class="fas fa-download mr-1"></i>
                                {{ basename($internship->id_copy_path) }}
                            </a>
                        </div>
                        @endif

                        @if($internship->qualification_copy_path)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-500">Qualification Copy</label>
                            <a href="{{ asset('storage/' . $internship->qualification_copy_path) }}" 
                               target="_blank" 
                               class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-flex items-center">
                                <i class="fas fa-download mr-1"></i>
                                {{ basename($internship->qualification_copy_path) }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end mt-8 space-x-4">
                    <a href="{{ route('dashboard.internships') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to List
                    </a>
                    <a href="{{ route('dashboard.internships.edit', $internship->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Application
                    </a>
                    <button onclick="deleteInternship({{ $internship->id }})"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Application
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteInternship(id) {
            if (confirm('Are you sure you want to delete this internship application? This action cannot be undone.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ url('/dashboard/internships/delete') }}/" + id;
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken.getAttribute('content');
                    form.appendChild(csrfInput);
                }
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>
