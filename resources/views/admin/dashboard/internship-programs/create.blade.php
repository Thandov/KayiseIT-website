@extends('admin.dashboard.layout')

@section('page-title', 'Create Internship Program')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-[#16A34A] rounded-t-xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Create Internship Program</h1>
                <p class="text-green-100 text-lg">Add a new internship program to your platform</p>
            </div>
            <a href="{{ route('dashboard.internship-programs') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-xl rounded-b-xl border-l border-r border-b border-gray-200">
        <form action="{{ route('dashboard.internship-programs.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <!-- Basic Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Basic Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Program Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration') }}" placeholder="e.g., 6 months, 1 year" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea id="description" name="description" rows="4" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Recruitment Details -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Recruitment Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="recruitment_start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                        <input type="date" id="recruitment_start_date" name="recruitment_start_date" value="{{ old('recruitment_start_date') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('recruitment_start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="recruitment_end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                        <input type="date" id="recruitment_end_date" name="recruitment_end_date" value="{{ old('recruitment_end_date') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('recruitment_end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="number_needed" class="block text-sm font-medium text-gray-700 mb-2">Number of Positions *</label>
                        <input type="number" id="number_needed" name="number_needed" value="{{ old('number_needed') }}" min="1" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('number_needed')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Financial Information -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Financial Information
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="has_stipend" name="has_stipend" value="1" {{ old('has_stipend') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="has_stipend" class="ml-2 text-sm font-medium text-gray-700">This program offers a stipend</label>
                    </div>
                    
                    <div id="stipend_details" class="grid grid-cols-1 md:grid-cols-2 gap-6" style="display: none;">
                        <div>
                            <label for="stipend_amount" class="block text-sm font-medium text-gray-700 mb-2">Stipend Amount</label>
                            <input type="number" id="stipend_amount" name="stipend_amount" value="{{ old('stipend_amount') }}" step="0.01" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                            @error('stipend_amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="stipend_currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                            <select id="stipend_currency" name="stipend_currency" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                                <option value="ZAR" {{ old('stipend_currency', 'ZAR') == 'ZAR' ? 'selected' : '' }}>ZAR (South African Rand)</option>
                                <option value="USD" {{ old('stipend_currency') == 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                                <option value="EUR" {{ old('stipend_currency') == 'EUR' ? 'selected' : '' }}>EUR (Euro)</option>
                            </select>
                            @error('stipend_currency')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accreditation & Benefits -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Accreditation & Benefits
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="has_accreditation" name="has_accreditation" value="1" {{ old('has_accreditation') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="has_accreditation" class="ml-2 text-sm font-medium text-gray-700">This program offers accreditation</label>
                    </div>
                    
                    <div id="accreditation_details" style="display: none;">
                        <label for="accreditation_details" class="block text-sm font-medium text-gray-700 mb-2">Accreditation Details</label>
                        <textarea id="accreditation_details" name="accreditation_details" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">{{ old('accreditation_details') }}</textarea>
                        @error('accreditation_details')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="youth_beneficiaries" name="youth_beneficiaries" value="1" {{ old('youth_beneficiaries') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="youth_beneficiaries" class="ml-2 text-sm font-medium text-gray-700">Targets youth beneficiaries</label>
                    </div>
                </div>
            </div>

            <!-- Requirements -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Requirements
                </h3>
                
                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Program Requirements *</label>
                    <textarea id="requirements" name="requirements" rows="4" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">{{ old('requirements') }}</textarea>
                    @error('requirements')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sponsors/Partners -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Sponsors & Partners
                </h3>
                
                <div>
                    <label for="sponsors_partners" class="block text-sm font-medium text-gray-700 mb-2">Sponsors/Partners</label>
                    <textarea id="sponsors_partners" name="sponsors_partners" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">{{ old('sponsors_partners') }}</textarea>
                    @error('sponsors_partners')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Media Uploads -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Media & Documents
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                        <input type="file" id="image" name="image" accept="image/*" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="gallery" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                        <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('gallery')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="qr_code" class="block text-sm font-medium text-gray-700 mb-2">QR Code</label>
                        <input type="file" id="qr_code" name="qr_code" accept="image/*" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200">
                        @error('qr_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Status
                </h3>
                
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Active (program is visible to users)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard.internship-programs') }}" class="px-6 py-3 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 font-medium transition-all duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-[#16A34A] text-white rounded-lg hover:bg-[#15803d] font-medium transition-colors">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Program
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Toggle stipend details
document.getElementById('has_stipend').addEventListener('change', function() {
    const stipendDetails = document.getElementById('stipend_details');
    if (this.checked) {
        stipendDetails.style.display = 'grid';
    } else {
        stipendDetails.style.display = 'none';
    }
});

// Toggle accreditation details
document.getElementById('has_accreditation').addEventListener('change', function() {
    const accreditationDetails = document.getElementById('accreditation_details');
    if (this.checked) {
        accreditationDetails.style.display = 'block';
    } else {
        accreditationDetails.style.display = 'none';
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check if stipend checkbox is checked
    if (document.getElementById('has_stipend').checked) {
        document.getElementById('stipend_details').style.display = 'grid';
    }
    
    // Check if accreditation checkbox is checked
    if (document.getElementById('has_accreditation').checked) {
        document.getElementById('accreditation_details').style.display = 'block';
    }
});
</script>
@endsection
