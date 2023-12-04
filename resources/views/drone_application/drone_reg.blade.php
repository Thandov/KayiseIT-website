<x-app-layout>
    <div class="flex justify-content-center  bg-slate-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('drone_application') }}">
                @csrf

                <div><input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"></div>

                <h1 class="my-4">Applicant</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="surname" class="block text-sm font-medium text-gray-600">Surname</label>
                    <input type="text" id="surname" name="surname" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="dob" class="block text-sm font-medium text-gray-600">Date Of Birth</label>
                    <input id="dob" name="dob" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select name="gender" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium text-gray-600">age</label>
                    <input id="age" name="age" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <x-input-label for="level" :value="__('Highest Education Level')" />
                    <select name="highest_level" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                        <option value="Primary">Primary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Tertiary">Tertiary</option>
                    </select>
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="school_name" class="block text-sm font-medium text-gray-600">School Name</label>
                    <input type="text" id="school_name" name="school_name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="number" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input id="number" name="number" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="address" class="block text-sm font-medium text-gray-600">Home Adress</label>
                    <input id="address" name="address" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <h1 class="my-4">Guardian</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="guardian_name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" id="guardian_name" name="guardian_name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="relation" class="block text-sm font-medium text-gray-600">Relation</label>
                    <input type="text" id="relation" name="relation" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="guardian_number" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input id="guardian_number" name="guardian_number" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="guardian_email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input id="guardian_email" name="guardian_email" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="guardian_address" class="block text-sm font-medium text-gray-600">Home Adress</label>
                    <input id="guardian_address" name="guardian_address" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <h1 class="my-4">Next Of kin</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="kin_name_2" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" id="kin_name_2" name="kin_name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="relation_2" class="block text-sm font-medium text-gray-600">Relation</label>
                    <input type="text" id="relation_2" name="kin_relation" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="kin_number_2" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input id="kin_number_2" name="kin_number" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <h1 class="my-4">Programme</h1>
                <div class="mb-4" style="display: inline;">
                    <x-input-label for="course" :value="__('Course Name')" />
                    <select name="course" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                        <option value="client">Drone Workshop 1</option>
                    </select>
                </div>
                <div class="mb-4" style="display: inline;">
                    <x-input-label for="paid" :value="__('Paid?')" />
                    <select id="paid" name="paid" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="mb-4" style="display: inline;">
                    <label for="payment_date" class="block text-sm font-medium text-gray-600">Payment Date:</label>
                    <input type="text" id="payment_date" name="payment_date" class="mt-1 p-2 w-full border rounded-md">
                </div>


                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button type="submit">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>