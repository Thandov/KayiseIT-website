<form action="{{ isset($client) ? route('dashboard.clients.update') : route('admin.dashboard.clients.create') }}" method="POST" id="clientForm">
    @csrf
    @if(isset($client))
        <input type="hidden" name="user_id" value="{{ $client->user_id }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                <option value="lead" @selected(old('status', $client->status ?? 'lead') === 'lead')>Lead</option>
                <option value="client" @selected(old('status', $client->status ?? 'lead') === 'client')>Client</option>
            </select>
        </div>
        <div>
            <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
            <input type="text" name="company" id="company"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('company', $client->company ?? '') }}">
        </div>

        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First name *</label>
            <input type="text" name="first_name" id="first_name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('first_name', $client->name ?? '') }}">
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
            <input type="text" name="last_name" id="last_name"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('last_name', $client->surname ?? '') }}">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <input type="email" name="email" id="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('email', $client->email ?? '') }}">
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('phone', $client->phone ?? '') }}">
        </div>

        <div>
            <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
            @if(isset($client))
                <x-province-selected :client="$client" />
            @else
                <x-province-select />
            @endif
        </div>

        <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="address"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                   value="{{ old('address', $client->address ?? '') }}">
        </div>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-kb-100 hover:bg-kb-200">
            {{ isset($client) ? 'Save' : 'Add' }}
        </button>
    </div>
</form>



