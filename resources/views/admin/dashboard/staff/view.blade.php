@extends('admin.dashboard.layout')

@section('page-title', 'View Staff Member')

@section('content')
    <div class="p-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard.staff') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Staff List
            </a>
        </div>

        <!-- Staff Details Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-kb-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Staff Member Details</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.dashboard.staff') }}" class="px-4 py-2 bg-white bg-opacity-20 text-white rounded-md hover:bg-opacity-30 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('dashboard.staff.update', $employee->id) }}" method="POST" enctype="multipart/form-data" id="staffForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Profile Picture -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                            <div class="flex items-center space-x-4">
                                @if($employee->photo_url)
                                    <img id="profile_picture_preview" src="{{ $employee->photo_url }}" alt="{{ $employee->first_name }}" class="h-24 w-24 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div id="profile_picture_placeholder" class="h-24 w-24 rounded-full bg-kb-50 flex items-center justify-center border-2 border-gray-200">
                                        <span class="text-kb-100 font-bold text-2xl">{{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name ?? '', 0, 1) }}</span>
                                    </div>
                                    <img id="profile_picture_preview" src="" alt="{{ $employee->first_name }}" class="h-24 w-24 rounded-full object-cover border-2 border-gray-200 hidden">
                                @endif
                                <div>
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/gif,image/webp"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kb-50 file:text-kb-100 hover:file:bg-kb-100">
                                    <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, or WebP up to 10MB. Saved to Staff/{{ \Illuminate\Support\Str::slug($employee->first_name, '_') }}_{{ \Illuminate\Support\Str::slug($employee->last_name ?? '', '_') }}</p>
                                </div>
                            </div>
                            @error('profile_picture')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                            <input type="text" name="first_name" id="first_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('first_name') border-red-500 @enderror"
                                   value="{{ old('first_name', $employee->first_name) }}">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('last_name') border-red-500 @enderror"
                                   value="{{ old('last_name', $employee->last_name) }}">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Job Title -->
                        <div>
                            <label for="job_title_id" class="block text-sm font-medium text-gray-700">Job Title *</label>
                            @php
                                $titleOptions = $jobTitles ?? \App\Models\JobTitle::with('permissionGroups')->active()->orderBy('name')->get();
                                $selectedTitleId = old('job_title_id', $employee->job_title_id);
                            @endphp
                            <select name="job_title_id" id="job_title_id" required
                                    class="ki-select mt-1 @error('job_title_id') border-red-500 @enderror">
                                <option value="">— Select title —</option>
                                @foreach($titleOptions as $title)
                                    <option value="{{ $title->id }}" @selected((string) $selectedTitleId === (string) $title->id)>
                                        {{ $title->name }}@if($title->groupLabels()) ({{ $title->groupLabels() }})@endif
                                    </option>
                                @endforeach
                            </select>
                            @if($titleOptions->isEmpty())
                                <p class="mt-1 text-sm text-amber-700">
                                    No titles yet.
                                    @if(auth()->user()?->isDashboardAdmin())
                                        <a href="{{ route('dashboard.access', ['tab' => 'titles']) }}" class="underline font-medium">Create job titles</a>
                                        first, then refresh this page.
                                    @endif
                                </p>
                            @else
                                <p class="mt-1 text-xs text-gray-500">Shown on the organogram. Permissions come from the title’s group.</p>
                            @endif
                            @error('job_title_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <input type="hidden" name="job_title" id="job_title_text" value="{{ old('job_title', $employee->job_title) }}">
                            <script>
                                (function () {
                                    const select = document.getElementById('job_title_id');
                                    const hidden = document.getElementById('job_title_text');
                                    if (!select || !hidden) return;
                                    const sync = () => {
                                        const opt = select.options[select.selectedIndex];
                                        hidden.value = opt && opt.value ? opt.textContent.replace(/\s*\(.*\)\s*$/, '').trim() : '';
                                    };
                                    select.addEventListener('change', sync);
                                    sync();
                                })();
                            </script>
                        </div>

                        <!-- Work email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Work email</label>
                            <input type="email" name="email" id="email" required readonly
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm @error('email') border-red-500 @enderror"
                                   value="{{ old('email', $employee->email) }}">
                            <p class="mt-1 text-xs text-gray-500">Login address: firstname@kayiseit.co.za</p>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Personal email -->
                        <div>
                            <label for="personal_email" class="block text-sm font-medium text-gray-700">Personal email</label>
                            <input type="email" name="personal_email" id="personal_email"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('personal_email') border-red-500 @enderror"
                                   value="{{ old('personal_email', $employee->personal_email) }}"
                                   placeholder="name@gmail.com">
                            <p class="mt-1 text-xs text-gray-500">Optional. Activation can be sent here or to work email.</p>
                            @error('personal_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                            <input type="text" name="phone" id="phone" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('phone') border-red-500 @enderror"
                                   value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Province -->
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Province *</label>
                            <x-province-selected :client="(object)['province' => $employee->province]" />
                            @error('province')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Number -->
                        <div>
                            <label for="ID_number" class="block text-sm font-medium text-gray-700">ID Number *</label>
                            <input type="text" name="ID_number" id="ID_number" maxlength="13" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('ID_number') border-red-500 @enderror"
                                   value="{{ old('ID_number', $employee->ID_number) }}">
                            @error('ID_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                            <input type="text" name="address" id="address" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('address') border-red-500 @enderror"
                                   value="{{ old('address', $employee->address) }}">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('date_of_birth') border-red-500 @enderror"
                                   value="{{ old('date_of_birth', $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @include('admin.dashboard.staff._documents', ['employee' => $employee])

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Verification Status</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="flex items-center">
                                    <input id="id_verifi_doc" name="id_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('id_verifi_doc', $employee->id_verifi_doc) ? 'checked' : '' }}>
                                    <label for="id_verifi_doc" class="ml-2 block text-sm text-gray-900">ID Verification Document</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="proof_address_verifi_doc" name="proof_address_verifi_doc" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('proof_address_verifi_doc', $employee->proof_address_verifi_doc) ? 'checked' : '' }}>
                                    <label for="proof_address_verifi_doc" class="ml-2 block text-sm text-gray-900">Proof of Address</label>
                                </div>

                                <div class="flex items-center">
                                    <input id="bank_confi_verifi" name="bank_confi_verifi" type="checkbox" value="1"
                                           class="h-4 w-4 text-kb-100 focus:ring-kb-100 border-gray-300 rounded"
                                           {{ old('bank_confi_verifi', $employee->bank_confi_verifi) ? 'checked' : '' }}>
                                    <label for="bank_confi_verifi" class="ml-2 block text-sm text-gray-900">Bank Confirmation</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.dashboard.staff') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                            Update Staff Member
                        </button>
                    </div>
                </form>

                @php
                    $staffUser = $employee->user;
                    $accountActivated = $staffUser && $staffUser->email_verified_at;
                    $activationDelivery = old('delivery', \App\Helpers\StaffEmailHelper::preferredChannel($employee));
                @endphp
                @if($accountActivated)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900">Account status</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            This staff profile is activated.
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </p>
                        <p class="mt-2 text-sm text-gray-500">Login: {{ $staffUser->email }}. Use Password reset on the staff list if they need a new link.</p>
                    </div>
                @else
                <form action="{{ route('dashboard.staff.activation', $employee->id) }}" method="POST" class="mt-6 pt-6 border-t border-gray-200" id="staffActivationForm">
                    @csrf
                    <h3 class="text-sm font-semibold text-gray-900">Send activation email</h3>
                    <p class="mt-1 text-sm text-gray-600">Sends a set-password link. Prefer Work email — this server delivers to @kayiseit.co.za. External personal addresses are blocked by the host. Login stays the work email.</p>
                    <div class="mt-4 ki-cluster">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-800">
                            <input type="radio" name="delivery" value="work" class="text-kb-100 focus:ring-kb-100" {{ $activationDelivery === 'work' ? 'checked' : '' }}>
                            Work ({{ $employee->email }})
                        </label>
                        <label class="inline-flex items-center gap-2 text-sm text-gray-800 {{ $employee->personal_email ? '' : 'opacity-50' }}">
                            <input type="radio" name="delivery" value="personal" class="text-kb-100 focus:ring-kb-100" {{ $employee->personal_email ? '' : 'disabled' }} {{ $activationDelivery === 'personal' ? 'checked' : '' }}>
                            Personal{{ $employee->personal_email ? ' ('.$employee->personal_email.')' : ' (add a personal email first)' }}
                        </label>
                    </div>
                    @error('delivery')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-4">
                        <button type="submit" id="staffActivationSubmit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100 disabled:opacity-50">
                            Send activation email
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pictureInput = document.getElementById('profile_picture');
            const preview = document.getElementById('profile_picture_preview');
            const placeholder = document.getElementById('profile_picture_placeholder');
            if (pictureInput && preview) {
                pictureInput.addEventListener('change', function() {
                    const file = pictureInput.files && pictureInput.files[0];
                    if (!file) {
                        return;
                    }
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                });
            }

            const firstNameInput = document.getElementById('first_name');
            const emailInput = document.getElementById('email');
            if (firstNameInput && emailInput) {
                const keepDotCom = (emailInput.value || '').toLowerCase().endsWith('@kayiseit.com');
                const syncWorkEmail = function() {
                    const local = firstNameInput.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9]+/g, '');
                    const domain = keepDotCom ? 'kayiseit.com' : 'kayiseit.co.za';
                    emailInput.value = local ? local + '@' + domain : '';
                };
                firstNameInput.addEventListener('input', syncWorkEmail);
            }

            const idNumberInput = document.getElementById('ID_number');
            const dateInput = document.getElementById('date_of_birth');

            // Auto-fill date of birth from ID number
            if (idNumberInput && dateInput) {
                idNumberInput.addEventListener('input', function() {
                    const code = idNumberInput.value;

                    if (code.length === 13) {
                        const year = '19' + code.substr(0, 2);
                        const month = code.substr(2, 2);
                        const day = code.substr(4, 2);

                        // Format the date as 'YYYY-MM-DD' and set it as the value of the date input
                        dateInput.value = `${year}-${month}-${day}`;
                    }
                });
            }

            const activationForm = document.getElementById('staffActivationForm');
            const activationSubmit = document.getElementById('staffActivationSubmit');
            if (activationForm && activationSubmit) {
                activationForm.addEventListener('submit', function() {
                    activationSubmit.disabled = true;
                    activationSubmit.textContent = 'Sending…';
                });
            }
        });
    </script>
@endsection



