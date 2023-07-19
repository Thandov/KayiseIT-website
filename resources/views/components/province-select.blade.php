<select name="province" id="province" autocomplete="province" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('province') border-red-500 @enderror">
    <option value="">Select Province</option>
    <option value="Eastern Cape" {{ old('province') == 'Eastern Cape' ? 'selected' : '' }}>Eastern Cape</option>
    <option value="Free State" {{ old('province') == 'Free State' ? 'selected' : '' }}>Free State</option>
    <option value="Gauteng" {{ old('province') == 'Gauteng' ? 'selected' : '' }}>Gauteng</option>
    <option value="KwaZulu-Natal" {{ old('province') == 'KwaZulu-Natal' ? 'selected' : '' }}>KwaZulu-Natal</option>
    <option value="Limpopo" {{ old('province') == 'Limpopo' ? 'selected' : '' }}>Limpopo</option>
    <option value="Mpumalanga" {{ old('province') == 'Mpumalanga' ? 'selected' : '' }}>Mpumalanga</option>
    <option value="North West" {{ old('province') == 'North West' ? 'selected' : '' }}>North West</option>
    <option value="Northern Cape" {{ old('province') == 'Northern Cape' ? 'selected' : '' }}>Northern Cape</option>
    <option value="Western Cape" {{ old('province') == 'Western Cape' ? 'selected' : '' }}>Western Cape</option>
</select>