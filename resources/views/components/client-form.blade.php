<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('dashboard.clients.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="action" value="update_client">
            <input type="hidden" name="user_id" value="{{ $client->user_id ?? ''}}">
            <div class="mb-4">
                <h2 class="text-3xl font-bold">{{ $client->company ??'' }}</h2>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <label for="company" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company" id="company" value="{{ $client->company ??'' }}" autocomplete="company" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('company') border-red-500 @enderror" value="{{ old('company') }}">
                    @error('company')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $client->first_name ??'' }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}">
                    @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $client->last_name ??'' }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}">
                    @error('last_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $client->email ??'' }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $client->phone ??'' }}" autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                    @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ $client->address ??'' }}" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror" value="{{ old('address') }}">
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
            <div class="formfoot mt-4 flex">
                <div class="updatewrp text-right col-start-2">
                    <x-front-end-btn linking="update" color="submit" showme="" name="Update" />
                </div>
        </form>
        <div class="relative deletewrp col-start-3">
            <div class="kingbtn">
                <form action="{{ url('dashboard/clients/delete', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?')">
                    @csrf
                    @method('DELETE')
                    <x-front-end-btn linking="/dashboard/clients/delete" color="red" showme="delete_staff" name='Delete' />
                </form>
            </div>
        </div>
    </div>
</div>
</div>