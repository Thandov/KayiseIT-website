@extends('admin.dashboard.layout')

@section('page-title', 'Add New Intern/Learner')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.interns-learners') }}" class="text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Interns & Learners
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Add New Intern/Learner</h2>

            <form action="{{ route('dashboard.interns-learners.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surname *</label>
                        <input type="text" name="surname" value="{{ old('surname') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('surname') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ID Number</label>
                        <input type="text" name="id_number" value="{{ old('id_number') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select name="gender" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('address') }}</textarea>
                    </div>

                    <!-- Program & Status -->
                    <div class="md:col-span-2 mt-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Program & Status</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Internship Application</label>
                        <select name="internship_application_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="">None</option>
                            @foreach($applications as $application)
                            <option value="{{ $application->id }}" {{ old('internship_application_id') == $application->id ? 'selected' : '' }}>
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
                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="terminated" {{ old('status') == 'terminated' ? 'selected' : '' }}>Terminated</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('dashboard.interns-learners') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-kb-100 text-white rounded-md hover:bg-kb-600">
                        Create Intern/Learner
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
