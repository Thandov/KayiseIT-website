@extends('admin.dashboard.layout')

@section('page-title', 'View Staff Member')

@section('content')
    <div class="p-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard.staff') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Staff List
            </a>
        </div>

        <!-- Staff Details Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-kb-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Staff Member Details</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.dashboard.staff') }}" class="px-4 py-2 bg-white bg-opacity-20 text-white rounded-md hover:bg-opacity-30 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('dashboard.staff.update', $employee->id) }}" method="POST" enctype="multipart/form-data" id="staffForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Profile Picture -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                            <div class="flex items-center space-x-4">
                                @if($employee->profile_picture)
                                    <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->first_name }}" class="h-24 w-24 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div class="h-24 w-24 rounded-full bg-kb-50 flex items-center justify-center border-2 border-gray-200">
                                        <span class="text-kb-100 font-bold text-2xl">{{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name ?? '', 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kb-50 file:text-kb-100 hover:file:bg-kb-100">
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('profile_picture')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                            <input type="text" name="first_name" id="first_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('first_name') border-red-500 @enderror"
                                   value="{{ old('first_name', $employee->first_name) }}">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('last_name') border-red-500 @enderror"
                                   value="{{ old('last_name', $employee->last_name) }}">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('email') border-red-500 @enderror"
                                   value="{{ old('email', $employee->email) }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                            <input type="text" name="phone" id="phone" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('phone') border-red-500 @enderror"
                                   value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Province -->
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
                            <x-province-selected :client="(object)['province' => $employee->province]" />
                            @error('province')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Number -->
                        <div>
                            <label for="ID_number" class="block text-sm font-medium text-gray-700">ID Number *</label>
                            <input type="text" name="ID_number" id="ID_number" maxlength="13" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('ID_number') border-red-500 @enderror"
                                   value="{{ old('ID_number', $employee->ID_number) }}">
                            @error('ID_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                            <input type="text" name="address" id="address" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('address') border-red-500 @enderror"
                                   value="{{ old('address', $employee->address) }}">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('date_of_birth') border-red-500 @enderror"
                                   value="{{ old('date_of_birth', $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Verification Status -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Verification Status</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="flex items-center">
                                    <input id="id_verifi_doc" name="id_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('id_verifi_doc', $employee->id_verifi_doc) ? 'checked' : '' }}>
                                    <label for="id_verifi_doc" class="ml-2 block text-sm text-gray-900">ID Verification Document</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="proof_address_verifi_doc" name="proof_address_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('proof_address_verifi_doc', $employee->proof_address_verifi_doc) ? 'checked' : '' }}>
                                    <label for="proof_address_verifi_doc" class="ml-2 block text-sm text-gray-900">Proof of Address</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="bank_confi_verifi" name="bank_confi_verifi" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('bank_confi_verifi', $employee->bank_confi_verifi) ? 'checked' : '' }}>
                                    <label for="bank_confi_verifi" class="ml-2 block text-sm text-gray-900">Bank Confirmation</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.dashboard.staff') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                            Update Staff Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idNumberInput = document.getElementById('ID_number');
            const dateInput = document.getElementById('date_of_birth');

            // Auto-fill date of birth from ID number
            if (idNumberInput && dateInput) {
                idNumberInput.addEventListener('input', function() {
                    const code = idNumberInput.value;

                    if (code.length === 13) {
                        const year = '19' + code.substr(0, 2);
                        const month = code.substr(2, 2);
                        const day = code.substr(4, 2);

                        // Format the date as 'YYYY-MM-DD' and set it as the value of the date input
                        dateInput.value = `${year}-${month}-${day}`;
                    }
                });
            }
        });
    </script>
@endsection



