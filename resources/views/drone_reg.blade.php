<x-app-layout>
    <style>
        .registration-section {
            display: none;
        }

        .current-section {
            display: block;
        }
    </style>
    <div class="grid justify-content-center">
    <div class="w-10/12 m-5 p-5 rounded-md shadow-md bg-slate-200">
        <form action="#" method="post" id="registrationForm">
            @csrf

            <!-- Section 1 -->
            <div class="registration-section current-section" id="section1">

                <h1>Applicant Details</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="name" class="block text-sm font-medium text-gray-600">Full Names</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Age</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Grade</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">School Name</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 p-2 w-full border rounded-md"></textarea>
                </div>
                <div class="mt-6">
                    <button type="button" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="nextSection('section2')">Next</button>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="registration-section" id="section2">
                <h1>Guardian Details</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="name" class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Relation to Applicant</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Phone number</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 p-2 w-full border rounded-md"></textarea>
                </div>
                <div class="mt-6">
                    <button type="button" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600" onclick="prevSection('section1')">Previous</button>
                    <button type="button" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="nextSection('section3')">Next</button>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="registration-section" id="section3">
            <h1>Applicant Details</h1>
                <div class="mb-4" style="display: inline;">
                    <label for="name" class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Age</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Grade</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">School Name</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 p-2 w-full border rounded-md"></textarea>
                </div>
                <div class="mt-6">
                    <button type="button" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600" onclick="prevSection('section2')">Previous</button>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function nextSection(nextSectionId) {
            $('.current-section').removeClass('current-section').hide();
            $('#' + nextSectionId).addClass('current-section').show();
        }

        function prevSection(prevSectionId) {
            $('.current-section').removeClass('current-section').hide();
            $('#' + prevSectionId).addClass('current-section').show();
        }
    </script>
</x-app-layout>