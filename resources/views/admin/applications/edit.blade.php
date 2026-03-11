<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <h2 class="text-2xl font-bold">Edit Application</h2>
                <p class="text-blue-200">Update the application details.</p>
            </div>
            
            <form method="POST" action="{{ route('dashboard.applications.update', $application->id) }}" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $application->name) }}" 
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                               placeholder="Enter full name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $application->email) }}" 
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                               placeholder="Enter email address">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Application Type -->
                    <div>
                        <label for="app_type" class="block text-sm font-medium text-gray-700 mb-2">Application Type</label>
                        <input type="text" 
                               id="app_type" 
                               name="app_type" 
                               value="{{ old('app_type', $application->app_type) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('app_type') border-red-500 @enderror" 
                               placeholder="Internship, TVET Placement, etc.">
                        @error('app_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field -->
                    <div>
                        <label for="field" class="block text-sm font-medium text-gray-700 mb-2">Field</label>
                        <input type="text"
                                  id="field"
                                  name="field"
                                  value="{{ old('field', $application->field) }}"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('field') border-red-500 @enderror" 
                                  placeholder="Software & Web Development">
                        @error('field')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Program Partner -->
                    <div class="md:col-span-2">
                        <label for="program_partner" class="block text-sm font-medium text-gray-700 mb-2">Program Partner</label>
                        <input type="text"
                               id="program_partner"
                               name="program_partner"
                               value="{{ old('program_partner', $application->program_partner) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('program_partner') border-red-500 @enderror"
                               placeholder="Optional partner name">
                        @error('program_partner')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select id="status" 
                                name="status" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                            <option value="">Select status</option>
                            <option value="pending" {{ old('status', $application->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $application->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $application->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end mt-8 space-x-4">
                    <a href="{{ route('dashboard.applications') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Update Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
