<x-app-layout title="Staff Dashboard">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/admin/admin_dashboard" class="ml-1 text-sm font-medium inline-flex">
                                <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard</a>
                        </li>
                        <a href="/admin/staff/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Staff
                        </a>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">{{$employee->first_name ?? ''}}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- New display -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ url('admin/staff/viewstaff/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="action" value="update_employee">
                    <input type="hidden" name="user_id" value="{{ $employee->user_id ?? ''}}">

                    <x-img-upload image="{{$employee->profile_picture}}" />

                    <div class="mb-4">
                        <h2 class="text-3xl font-bold">{{ $employee->first_name ??'' }} {{ $employee->last_name ??'' }}</h2>
                    </div>
                    <div class=" grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name ??'' }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}">
                            @error('first_name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name ??'' }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}">
                            @error('last_name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $employee->email ??'' }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $employee->phone ??'' }}" autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                            @error('phone')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" value="{{ $employee->address ??'' }}" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror" value="{{ old('address') }}">
                            @error('address')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                            <input type="text" name="province" id="province" value="{{ $employee->province ??'' }}" autocomplete="province" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('province') border-red-500 @enderror" value="{{ old('province') }}">
                            @error('province')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="ID_number" class="block text-sm font-medium text-gray-700">ID Number</label>
                            <input type="text" name="ID_number" maxlength="13" id="ID_number" value="{{ $employee->ID_number ??'' }}" autocomplete="ID_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('ID_number') border-red-500 @enderror" value="{{ old('ID_number') }}">
                            @error('ID_number')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="id_verifi_doc" name="id_verifi_doc" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded @error('id_verifi_doc') border-red-500 @enderror">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="id_verifi_doc" class="font-medium text-gray-700">ID Verification Document</label>
                                </div>
                            </div>
                            @error('id_verifi_doc')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="proof_address_verifi_doc" name="proof_address_verifi_doc" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded @error('proof_address_verifi_doc') border-red-500 @enderror">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="proof_address_verifi_doc" class="font-medium text-gray-700">Proof of Address Verification Document</label>
                                </div>
                            </div>
                            @error('proof_address_verifi_doc')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="bank_confi_verifi" name="bank_confi_verifi" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded @error('bank_confi_verifi') border-red-500 @enderror">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="bank_confi_verifi" class="font-medium text-gray-700">Bank Confirmation Verification</label>
                                </div>
                            </div>
                            @error('bank_confi_verifi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $employee->date_of_birth ??'' }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('date_of_birth') border-red-500 @enderror" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                    </div>
                </form>
                <div class="xxxxxxx">
                    <form action="{{url('admin/staff/delete', $employee->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                        @csrf
                        @method('DELETE')
                        <x-front-end-btn linking="/admin/staff/delete" color="red" showme="delete_staff" name='Delete' />
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>