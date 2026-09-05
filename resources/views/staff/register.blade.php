<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Staff Registration – KAYISE IT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen py-10 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
                </a>
                <h1 class="mt-4 text-2xl font-bold text-gray-900">Staff Registration</h1>
                <p class="mt-2 text-sm text-gray-600">Complete your details and create your account.</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 md:p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('staff.register.submit', $invite->token) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                            <input type="text" name="first_name" id="first_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('first_name') }}">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('last_name') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" required readonly
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm"
                                   value="{{ old('email', $invite->email) }}">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                            <input type="text" name="phone" id="phone" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
                            <x-province-select />
                        </div>

                        <div>
                            <label for="ID_number" class="block text-sm font-medium text-gray-700">ID Number *</label>
                            <input type="text" name="ID_number" id="ID_number" maxlength="13" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('ID_number') }}">
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                            <input type="text" name="address" id="address" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('address') }}">
                        </div>

                        <div>
                            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kb-50 file:text-kb-100 hover:file:bg-kb-100">
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   value="{{ old('date_of_birth') }}">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                            <input type="password" name="password" id="password" required minlength="8"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   autocomplete="new-password">
                            <p class="mt-1 text-xs text-gray-500">Minimum 8 characters.</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                                   autocomplete="new-password">
                        </div>

                        <div class="md:col-span-2">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input id="id_verifi_doc" name="id_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('id_verifi_doc') ? 'checked' : '' }}>
                                    <label for="id_verifi_doc" class="ml-2 block text-sm text-gray-900">ID Verification Document</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="proof_address_verifi_doc" name="proof_address_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('proof_address_verifi_doc') ? 'checked' : '' }}>
                                    <label for="proof_address_verifi_doc" class="ml-2 block text-sm text-gray-900">Proof of Address Verification Document</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="bank_confi_verifi" name="bank_confi_verifi" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('bank_confi_verifi') ? 'checked' : '' }}>
                                    <label for="bank_confi_verifi" class="ml-2 block text-sm text-gray-900">Bank Confirmation Verification</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                            Submit registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
