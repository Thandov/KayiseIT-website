@php
    $person = $person ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
        <input type="text" name="name" value="{{ old('name', $person?->name) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Surname *</label>
        <input type="text" name="surname" value="{{ old('surname', $person?->surname) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('surname') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">ID Number *</label>
        <input type="text" name="id_number" value="{{ old('id_number', $person?->id_number) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('id_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
        <input type="email" name="email" value="{{ old('email', $person?->email) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Cellphone *</label>
        <input type="text" name="cellphone" value="{{ old('cellphone', $person?->cellphone) }}" required
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('cellphone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
        <select name="country" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
            @php $countries = ['South Africa', 'Botswana', 'Lesotho', 'Mozambique', 'Namibia', 'Zimbabwe', 'Other']; @endphp
            @foreach($countries as $country)
                <option value="{{ $country }}" {{ old('country', $person?->country ?? 'South Africa') === $country ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
        @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Province *</label>
        @php $selectedProvince = old('province', $person?->province); @endphp
        <select name="province" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
            <option value="">Select Province</option>
            @foreach(['Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo','Mpumalanga','North West','Northern Cape','Western Cape'] as $prov)
                <option value="{{ $prov }}" {{ $selectedProvince === $prov ? 'selected' : '' }}>{{ $prov }}</option>
            @endforeach
        </select>
        @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Location Type *</label>
        <select name="location_type" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
            <option value="">Select type</option>
            <option value="town" {{ old('location_type', $person?->location_type) === 'town' ? 'selected' : '' }}>Town</option>
            <option value="township" {{ old('location_type', $person?->location_type) === 'township' ? 'selected' : '' }}>Township</option>
        </select>
        @error('location_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Town / Township Name *</label>
        <input type="text" name="location_name" value="{{ old('location_name', $person?->location_name) }}" required
               placeholder="e.g. Polokwane or Seshego"
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
        @error('location_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Program *</label>
        <select name="internship_program_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kb-500 focus:ring-kb-500">
            <option value="">Select program</option>
            @forelse($programs as $program)
                <option value="{{ $program->id }}" {{ (string) old('internship_program_id', $person?->internship_program_id) === (string) $program->id ? 'selected' : '' }}>
                    {{ $program->name }}
                    @if($program->allows_enquiry) (Enquiry enabled) @endif
                </option>
            @empty
                <option value="" disabled>No active programs — create one under Programs first</option>
            @endforelse
        </select>
        @error('internship_program_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
