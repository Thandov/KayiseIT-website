@if ($client)
<select name="province" id="province" autocomplete="province" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('province') border-red-500 @enderror">
    <option value="">Select Province</option>
    <option value="Eastern Cape" {{ $client->province === 'Eastern Cape' ? 'selected' : '' }}>Eastern Cape</option>
    <option value="Free State" {{ $client->province === 'Free State' ? 'selected' : '' }}>Free State</option>
    <option value="Gauteng" {{ $client->province === 'Gauteng' ? 'selected' : '' }}>Gauteng</option>
    <option value="KwaZulu-Natal" {{ $client->province === 'KwaZulu-Natal' ? 'selected' : '' }}>KwaZulu-Natal</option>
    <option value="Limpopo" {{ $client->province === 'Limpopo' ? 'selected' : '' }}>Limpopo</option>
    <option value="Mpumalanga" {{ $client->province === 'Mpumalanga' ? 'selected' : '' }}>Mpumalanga</option>
    <option value="North West" {{ $client->province === 'North West' ? 'selected' : '' }}>North West</option>
    <option value="Northern Cape" {{ $client->province === 'Northern Cape' ? 'selected' : '' }}>Northern Cape</option>
    <option value="Western Cape" {{ $client->province === 'Western Cape' ? 'selected' : '' }}>Western Cape</option>
</select>
@endif