<form action="{{ isset($employee) ? route('dashboard.staff.update', $employee->id) : route('dashboard.staff.create') }}" method="POST" enctype="multipart/form-data" id="staffForm">
    @csrf
    @if(isset($employee))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
            <input type="text" name="first_name" id="first_name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('first_name') border-red-500 @enderror"
                   value="{{ old('first_name', $employee->first_name ?? '') }}">
            @error('first_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
            <input type="text" name="last_name" id="last_name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('last_name') border-red-500 @enderror"
                   value="{{ old('last_name', $employee->last_name ?? '') }}">
            @error('last_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <input type="email" name="email" id="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                   value="{{ old('email', $employee->email ?? '') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
            <input type="text" name="phone" id="phone" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone') border-red-500 @enderror"
                   value="{{ old('phone', $employee->phone ?? '') }}">
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
            @if(isset($employee))
                <x-province-selected :client="(object)['province' => $employee->province]" />
            @else
                <x-province-select />
            @endif
            @error('province')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ID_number" class="block text-sm font-medium text-gray-700">ID Number *</label>
            <input type="text" name="ID_number" id="ID_number" maxlength="13" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_number') border-red-500 @enderror"
                   value="{{ old('ID_number', $employee->ID_number ?? '') }}">
            @error('ID_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
            <input type="text" name="address" id="address" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-500 @enderror"
                   value="{{ old('address', $employee->address ?? '') }}">
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kb-50 file:text-kb-100 hover:file:bg-kb-100 @error('profile_picture') border-red-500 @enderror">
            @error('profile_picture')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @if(isset($employee) && $employee->profile_picture)
                <p class="mt-2 text-sm text-gray-500">Current: <a href="{{ asset('storage/' . $employee->profile_picture) }}" target="_blank" class="text-kb-100 hover:text-kb-200">View</a></p>
            @endif
        </div>

        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date_of_birth') border-red-500 @enderror"
                   value="{{ old('date_of_birth', $employee->date_of_birth ?? '') }}">
            @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <div class="space-y-3">
                <div class="flex items-center">
                    <input id="id_verifi_doc" name="id_verifi_doc" type="checkbox" value="1"
                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                           {{ old('id_verifi_doc', $employee->id_verifi_doc ?? false) ? 'checked' : '' }}>
                    <label for="id_verifi_doc" class="ml-2 block text-sm text-gray-900">ID Verification Document</label>
                </div>

                <div class="flex items-center">
                    <input id="proof_address_verifi_doc" name="proof_address_verifi_doc" type="checkbox" value="1"
                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                           {{ old('proof_address_verifi_doc', $employee->proof_address_verifi_doc ?? false) ? 'checked' : '' }}>
                    <label for="proof_address_verifi_doc" class="ml-2 block text-sm text-gray-900">Proof of Address Verification Document</label>
                </div>

                <div class="flex items-center">
                    <input id="bank_confi_verifi" name="bank_confi_verifi" type="checkbox" value="1"
                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                           {{ old('bank_confi_verifi', $employee->bank_confi_verifi ?? false) ? 'checked' : '' }}>
                    <label for="bank_confi_verifi" class="ml-2 block text-sm text-gray-900">Bank Confirmation Verification</label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
            {{ isset($employee) ? 'Update Staff' : 'Create Staff' }}
        </button>
    </div>
</form>



