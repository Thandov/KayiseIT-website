@extends('admin.dashboard.layout')

@section('page-title', 'Add New Program')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.programs') }}" class="text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Programs
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Add New Program</h2>

            <form action="{{ route('dashboard.programs.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Type *</label>
                        <select name="program_type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">Select Type</option>
                            <option value="Internship" {{ old('program_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="TVET Placement" {{ old('program_type') == 'TVET Placement' ? 'selected' : '' }}>TVET Placement</option>
                            <option value="Short Program" {{ old('program_type') == 'Short Program' ? 'selected' : '' }}>Short Program</option>
                        </select>
                        @error('program_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Partner (Skills Development Only)</label>
                        <select name="partner_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">No Partner</option>
                            @foreach($skillsDevPartners as $partner)
                            <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                {{ $partner->name }}
                            </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Only Skills Development partners are shown. If MICT SETA partner is selected, MICT beneficiaries table will be used.</p>
                        @error('partner_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                        <input type="text" name="duration" value="{{ old('duration') }}" placeholder="e.g., 12 months" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('duration') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number Needed *</label>
                        <input type="number" name="number_needed" value="{{ old('number_needed') }}" min="1" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('number_needed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Recruitment Start Date *</label>
                        <input type="date" name="recruitment_start_date" value="{{ old('recruitment_start_date') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('recruitment_start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Recruitment End Date *</label>
                        <input type="date" name="recruitment_end_date" value="{{ old('recruitment_end_date') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('recruitment_end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Requirements *</label>
                        <textarea name="requirements" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('requirements') }}</textarea>
                        @error('requirements') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="has_stipend" value="1" {{ old('has_stipend') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            <span class="ml-2 text-sm text-gray-700">Has Stipend</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stipend Amount</label>
                        <input type="number" name="stipend_amount" value="{{ old('stipend_amount') }}" step="0.01" min="0"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stipend Currency</label>
                        <select name="stipend_currency" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="ZAR" {{ old('stipend_currency', 'ZAR') == 'ZAR' ? 'selected' : '' }}>ZAR</option>
                            <option value="USD" {{ old('stipend_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        </select>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="has_accreditation" value="1" {{ old('has_accreditation') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            <span class="ml-2 text-sm text-gray-700">Has Accreditation</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Accreditation Details</label>
                        <input type="text" name="accreditation_details" value="{{ old('accreditation_details') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="youth_beneficiaries" value="1" {{ old('youth_beneficiaries') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            <span class="ml-2 text-sm text-gray-700">Youth Beneficiaries</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('dashboard.programs') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-kb-100 text-white rounded-md hover:bg-kb-600">
                        Create Program
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
