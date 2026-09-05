@extends('admin.dashboard.layout')

@section('page-title', 'Edit Intern/Learner')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.interns-learners') }}" class="text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Interns & Learners
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Intern/Learner</h2>

            <form action="{{ route('dashboard.interns-learners.update', $internLearner->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $internLearner->first_name) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $internLearner->middle_name) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surname *</label>
                        <input type="text" name="surname" value="{{ old('surname', $internLearner->surname) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('surname') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $internLearner->email) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $internLearner->phone) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ID Number</label>
                        <input type="text" name="id_number" value="{{ old('id_number', $internLearner->id_number) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $internLearner->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select name="gender" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $internLearner->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $internLearner->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $internLearner->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('address', $internLearner->address) }}</textarea>
                    </div>

                    <!-- Program & Status -->
                    <div class="md:col-span-2 mt-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Program & Status</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Linked Application</label>
                        <select name="person_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">None</option>
                            @foreach($applications as $application)
                            <option value="{{ $application->id }}" {{ old('person_id', $internLearner->person_id) == $application->id ? 'selected' : '' }}>
                                {{ $application->name }} ({{ $application->email }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                        <select name="program_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">Select Program</option>
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id', $internLearner->program_id) == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="active" {{ old('status', $internLearner->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status', $internLearner->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="terminated" {{ old('status', $internLearner->status) == 'terminated' ? 'selected' : '' }}>Terminated</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $internLearner->start_date?->format('Y-m-d')) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $internLearner->end_date?->format('Y-m-d')) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('notes', $internLearner->notes) }}</textarea>
                    </div>
                </div>

                @if($mictBeneficiary)
                <!-- MICT SETA Beneficiary Fields -->
                <div class="mt-8 border-t pt-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">MICT SETA Beneficiary Information</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">MICT Data Available</span>
                    </div>
                    
                    <input type="hidden" name="mict_beneficiary_id" value="{{ $mictBeneficiary->id }}">
                    
                    <div class="space-y-6">
                        <!-- Learner Details Section -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-4 cursor-pointer" onclick="toggleSection('learner-details')">
                                <i class="fas fa-user mr-2"></i>Learner Details
                                <i class="fas fa-chevron-down float-right transform transition-transform" id="learner-details-icon"></i>
                            </h4>
                            <div id="learner-details" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                    <select name="learner_title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="">Select</option>
                                        <option value="Mr" {{ old('learner_title', $mictBeneficiary->learner_title) == 'Mr' ? 'selected' : '' }}>Mr</option>
                                        <option value="Ms" {{ old('learner_title', $mictBeneficiary->learner_title) == 'Ms' ? 'selected' : '' }}>Ms</option>
                                        <option value="Mrs" {{ old('learner_title', $mictBeneficiary->learner_title) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                        <option value="Dr" {{ old('learner_title', $mictBeneficiary->learner_title) == 'Dr' ? 'selected' : '' }}>Dr</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Maiden Name</label>
                                    <input type="text" name="maiden_name" value="{{ old('maiden_name', $mictBeneficiary->maiden_name) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of ID</label>
                                    <input type="text" name="type_of_id" value="{{ old('type_of_id', $mictBeneficiary->type_of_id) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Residence Status</label>
                                    <input type="text" name="residence_status" value="{{ old('residence_status', $mictBeneficiary->residence_status) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Marital Status</label>
                                    <select name="marital_status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="">Select</option>
                                        <option value="Single" {{ old('marital_status', $mictBeneficiary->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('marital_status', $mictBeneficiary->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ old('marital_status', $mictBeneficiary->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ old('marital_status', $mictBeneficiary->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Race</label>
                                    <input type="text" name="race" value="{{ old('race', $mictBeneficiary->race) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Disabled?</label>
                                    <select name="disabled" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('disabled', $mictBeneficiary->disabled) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('disabled', $mictBeneficiary->disabled) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of Disability</label>
                                    <input type="text" name="type_of_disability" value="{{ old('type_of_disability', $mictBeneficiary->type_of_disability) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                    <input type="number" name="age" value="{{ old('age', $mictBeneficiary->age) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SA Citizen?</label>
                                    <select name="sa_citizen" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('sa_citizen', $mictBeneficiary->sa_citizen) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('sa_citizen', $mictBeneficiary->sa_citizen) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nationality</label>
                                    <input type="text" name="nationality" value="{{ old('nationality', $mictBeneficiary->nationality) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Language</label>
                                    <input type="text" name="first_language" value="{{ old('first_language', $mictBeneficiary->first_language) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employed?</label>
                                    <select name="employed" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('employed', $mictBeneficiary->employed) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('employed', $mictBeneficiary->employed) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Length of Unemployment (Years)</label>
                                    <input type="number" name="length_of_unemployment_years" value="{{ old('length_of_unemployment_years', $mictBeneficiary->length_of_unemployment_years) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employment Start Date</label>
                                    <input type="date" name="employment_start_date" value="{{ old('employment_start_date', $mictBeneficiary->employment_start_date?->format('Y-m-d')) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Learner Agreement Start Date</label>
                                    <input type="date" name="learner_agreement_start_date" value="{{ old('learner_agreement_start_date', $mictBeneficiary->learner_agreement_start_date?->format('Y-m-d')) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Learner Agreement End Date</label>
                                    <input type="date" name="learner_agreement_end_date" value="{{ old('learner_agreement_end_date', $mictBeneficiary->learner_agreement_end_date?->format('Y-m-d')) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Start Date</label>
                                    <input type="date" name="program_start_date" value="{{ old('program_start_date', $mictBeneficiary->program_start_date?->format('Y-m-d')) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount Allocated</label>
                                    <input type="number" step="0.01" name="amount_allocated" value="{{ old('amount_allocated', $mictBeneficiary->amount_allocated) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Previous Internship?</label>
                                    <select name="previous_internship" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('previous_internship', $mictBeneficiary->previous_internship) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('previous_internship', $mictBeneficiary->previous_internship) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year of Study</label>
                                    <input type="text" name="year_of_study" value="{{ old('year_of_study', $mictBeneficiary->year_of_study) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                            </div>
                        </div>

                        <!-- Physical Address Section -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-4 cursor-pointer" onclick="toggleSection('physical-address')">
                                <i class="fas fa-map-marker-alt mr-2"></i>Physical Address
                                <i class="fas fa-chevron-down float-right transform transition-transform" id="physical-address-icon"></i>
                            </h4>
                            <div id="physical-address" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address Line 1</label>
                                    <input type="text" name="physical_address_1" value="{{ old('physical_address_1', $mictBeneficiary->physical_address_1) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address Line 2</label>
                                    <input type="text" name="physical_address_2" value="{{ old('physical_address_2', $mictBeneficiary->physical_address_2) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address Line 3</label>
                                    <input type="text" name="physical_address_3" value="{{ old('physical_address_3', $mictBeneficiary->physical_address_3) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                                    <input type="text" name="physical_postal_code" value="{{ old('physical_postal_code', $mictBeneficiary->physical_postal_code) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                            </div>
                        </div>

                        <!-- Postal Address Section -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-4 cursor-pointer" onclick="toggleSection('postal-address')">
                                <i class="fas fa-envelope mr-2"></i>Postal Address
                                <i class="fas fa-chevron-down float-right transform transition-transform" id="postal-address-icon"></i>
                            </h4>
                            <div id="postal-address" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Address Line 1</label>
                                    <input type="text" name="postal_address_1" value="{{ old('postal_address_1', $mictBeneficiary->postal_address_1) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Address Line 2</label>
                                    <input type="text" name="postal_address_2" value="{{ old('postal_address_2', $mictBeneficiary->postal_address_2) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Address Line 3</label>
                                    <input type="text" name="postal_address_3" value="{{ old('postal_address_3', $mictBeneficiary->postal_address_3) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                                    <input type="text" name="postal_address_postal_code" value="{{ old('postal_address_postal_code', $mictBeneficiary->postal_address_postal_code) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of Area</label>
                                    <select name="type_of_area" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="">Select</option>
                                        <option value="Urban" {{ old('type_of_area', $mictBeneficiary->type_of_area) == 'Urban' ? 'selected' : '' }}>Urban</option>
                                        <option value="Rural" {{ old('type_of_area', $mictBeneficiary->type_of_area) == 'Rural' ? 'selected' : '' }}>Rural</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cellphone</label>
                                    <input type="text" name="cellphone" value="{{ old('cellphone', $mictBeneficiary->cellphone) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Telephone</label>
                                    <input type="text" name="telephone" value="{{ old('telephone', $mictBeneficiary->telephone) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fax</label>
                                    <input type="text" name="fax" value="{{ old('fax', $mictBeneficiary->fax) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                            </div>
                        </div>

                        <!-- Qualification Section -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-4 cursor-pointer" onclick="toggleSection('qualification')">
                                <i class="fas fa-graduation-cap mr-2"></i>Qualification Details
                                <i class="fas fa-chevron-down float-right transform transition-transform" id="qualification-icon"></i>
                            </h4>
                            <div id="qualification" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Highest NQF Qualification</label>
                                    <input type="text" name="highest_nqf_qualification" value="{{ old('highest_nqf_qualification', $mictBeneficiary->highest_nqf_qualification) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Other Qualification</label>
                                    <input type="text" name="other_qualification" value="{{ old('other_qualification', $mictBeneficiary->other_qualification) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Title of Highest Qualification</label>
                                    <input type="text" name="title_of_highest_qualification" value="{{ old('title_of_highest_qualification', $mictBeneficiary->title_of_highest_qualification) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Has Matriculated?</label>
                                    <select name="has_matriculated" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('has_matriculated', $mictBeneficiary->has_matriculated) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('has_matriculated', $mictBeneficiary->has_matriculated) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Matriculated in SA?</label>
                                    <select name="matriculated_in_sa" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                        <option value="0" {{ old('matriculated_in_sa', $mictBeneficiary->matriculated_in_sa) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('matriculated_in_sa', $mictBeneficiary->matriculated_in_sa) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Province of High School</label>
                                    <input type="text" name="province_of_high_school" value="{{ old('province_of_high_school', $mictBeneficiary->province_of_high_school) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year of National Senior Certificate</label>
                                    <input type="text" name="year_of_national_senior_certificate" value="{{ old('year_of_national_senior_certificate', $mictBeneficiary->year_of_national_senior_certificate) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                            </div>
                        </div>

                        <!-- Guardian/Parent Section -->
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-4 cursor-pointer" onclick="toggleSection('guardian')">
                                <i class="fas fa-users mr-2"></i>Guardian/Parent Details
                                <i class="fas fa-chevron-down float-right transform transition-transform" id="guardian-icon"></i>
                            </h4>
                            <div id="guardian" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="guardian_first_name" value="{{ old('guardian_first_name', $mictBeneficiary->guardian_first_name) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="guardian_last_name" value="{{ old('guardian_last_name', $mictBeneficiary->guardian_last_name) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of ID</label>
                                    <input type="text" name="guardian_type_of_id" value="{{ old('guardian_type_of_id', $mictBeneficiary->guardian_type_of_id) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ID Number</label>
                                    <input type="text" name="guardian_id_number" value="{{ old('guardian_id_number', $mictBeneficiary->guardian_id_number) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Telephone</label>
                                    <input type="text" name="guardian_telephone" value="{{ old('guardian_telephone', $mictBeneficiary->guardian_telephone) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cellphone</label>
                                    <input type="text" name="guardian_cellphone" value="{{ old('guardian_cellphone', $mictBeneficiary->guardian_cellphone) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Home Address</label>
                                    <textarea name="guardian_home_address" rows="2"
                                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('guardian_home_address', $mictBeneficiary->guardian_home_address) }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Address</label>
                                    <textarea name="guardian_postal_address" rows="2"
                                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('guardian_postal_address', $mictBeneficiary->guardian_postal_address) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" name="guardian_email_address" value="{{ old('guardian_email_address', $mictBeneficiary->guardian_email_address) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('dashboard.interns-learners') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-kb-100 text-white rounded-md hover:bg-kb-600">
                        Update Intern/Learner
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const icon = document.getElementById(sectionId + '-icon');
            
            if (section.style.display === 'none') {
                section.style.display = 'grid';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                section.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
        
        // Initialize sections as collapsed
        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['learner-details', 'physical-address', 'postal-address', 'qualification', 'guardian'];
            sections.forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section) {
                    section.style.display = 'none';
                }
            });
        });
    </script>
@endsection
