<div class="">
    <h5 class="font-bold text-gray-900 text-xl mb-2">Personal Details</h5>
    <p class="text-base text-gray-600 mb-4">We need a bit more personal info</p>
    <hr class="border-gray-300 mb-4">
</div>

<!-- Physical Address -->
<div class="mb-4">
    <label for="phone" class="block text-sm font-bold text-black font-bold mb-2">Contact Number:</label>
    <input type="text" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
</div>
<div class="grid grid-cols-4 gap-4">
    <!-- ID Number -->
    <div class="mb-4 col-span-3">
        <label for="id_number" class="block text-sm font-bold text-black font-bold mb-2">ID Number:</label>
        <input type="text" id="id_number" name="id_number" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <!-- Age -->
    <div class="mb-4">
        <label for="age" class="block text-sm font-bold text-black font-bold mb-2">Age:</label>
        <input type="number" id="age" name="age" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>
</div>

<div class="">
    <h5 class="font-bold text-gray-900 text-xl mb-2">Address</h5>
    <p class="text-base text-gray-600 mb-4">Tell us where you are based.</p>
    <hr class="border-gray-300 mb-4">
</div>

<!-- Physical Address -->
<div class="mb-4">
    <label for="address" class="block text-sm font-bold text-black font-bold mb-2">Physical Address:</label>
    <input type="text" id="address" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
</div>
<div class="mb-4">
    <label for="province" class="block text-sm font-bold text-black font-bold mb-2">Province:</label>
    <select name="province" id="province" class="block w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
        <option value="Eastern Cape">Eastern Cape</option>
        <option value="Free State">Free State</option>
        <option value="Gauteng">Gauteng</option>
        <option value="KwaZulu-Natal">KwaZulu-Natal</option>
        <option value="Limpopo">Limpopo</option>
        <option value="Mpumalanga">Mpumalanga</option>
        <option value="Northern Cape">Northern Cape</option>
        <option value="North West">North West</option>
        <option value="Western Cape">Western Cape</option>
    </select>
</div>

