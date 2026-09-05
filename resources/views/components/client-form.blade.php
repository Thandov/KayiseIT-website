<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('dashboard.clients.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="action" value="update_client">
            <input type="hidden" name="user_id" value="{{ $client->user_id ?? ''}}">
            <input type="hidden" name="client_id" value="{{ $client->id ?? ''}}">
            <div class="mb-4 ki-toolbar">
                <h2 class="text-3xl font-bold m-0">{{ $client->displayName() }}</h2>
                @if($client->isConvertedClient())
                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Client</span>
                @else
                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Lead</span>
                @endif
            </div>
            @if($client->inquiry_subject || $client->inquiry_message)
                <div class="mb-6 rounded-lg border border-amber-100 bg-amber-50 p-4">
                    <p class="text-sm font-medium text-gray-800 m-0">{{ $client->inquiry_subject ?: 'Inquiry' }}</p>
                    @if($client->inquiry_message)
                        <p class="text-sm text-gray-600 mt-2 whitespace-pre-line m-0">{{ $client->inquiry_message }}</p>
                    @endif
                </div>
            @endif
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                        <option value="lead" @selected(old('status', $client->status) === 'lead')>Lead</option>
                        <option value="client" @selected(old('status', $client->status) === 'client')>Client</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Recording a sale also sets this to Client.</p>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <label for="company" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company" id="company" autocomplete="company" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('company') border-red-500 @enderror" value="{{ old('company', $client->company ?? '') }}">
                    @error('company')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('first_name') border-red-500 @enderror" value="{{ old('first_name', $client->name ?? '') }}">
                    @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('last_name') border-red-500 @enderror" value="{{ old('last_name', $client->surname ?? '') }}">
                    @error('last_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" value="{{ old('email', $client->email ?? '') }}">
                    @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror" value="{{ old('phone', $client->phone ?? '') }}">
                    @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror" value="{{ old('address', $client->address ?? '') }}">
                    @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                    <x-province-selected :client="$client" />
                    @error('province')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Footer of the form -->
            <div class="px-4 py-3 bg-gray-50 text-right flex justify-between items-center gap-3">
                <form action="{{ route('admin.dashboard.clients.delete', $client->id) }}" method="POST" onsubmit="return confirm('Delete this record?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Delete
                    </button>
                </form>
                <div class="ki-table-actions">
                    <a href="{{ route('dashboard.clients') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-kb-100 hover:bg-kb-200">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>