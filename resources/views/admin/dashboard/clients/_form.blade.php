<form action="{{ isset($client) ? route('dashboard.clients.update') : route('admin.dashboard.clients.create') }}" method="POST" id="clientForm">
    @csrf
    @if(isset($client))
        <input type="hidden" name="user_id" value="{{ $client->user_id }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="company" class="block text-sm font-medium text-gray-700">Company Name *</label>
            <input type="text" name="company" id="company" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('company') border-red-500 @enderror"
                   value="{{ old('company', $client->company ?? '') }}">
            @error('company')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
            <input type="text" name="first_name" id="first_name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('first_name') border-red-500 @enderror"
                   value="{{ old('first_name', $client->name ?? '') }}">
            @error('first_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
            <input type="text" name="last_name" id="last_name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('last_name') border-red-500 @enderror"
                   value="{{ old('last_name', $client->surname ?? '') }}">
            @error('last_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <input type="email" name="email" id="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                   value="{{ old('email', $client->email ?? '') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
            <input type="text" name="phone" id="phone" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone') border-red-500 @enderror"
                   value="{{ old('phone', $client->phone ?? '') }}">
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
            @if(isset($client))
                <x-province-selected :client="$client" />
            @else
                <x-province-select />
            @endif
            @error('province')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
            <input type="text" name="address" id="address" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-500 @enderror"
                   value="{{ old('address', $client->address ?? '') }}">
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isset($client) ? 'Update Client' : 'Create Client' }}
        </button>
    </div>
</form>



