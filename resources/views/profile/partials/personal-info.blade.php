{{-- Alerts --}}
<div id="pi-alert-success" class="hidden mb-5 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm font-medium"></div>
<div id="pi-alert-error"   class="hidden mb-5 p-4 rounded-lg bg-red-50   border border-red-200   text-red-800   text-sm font-medium"></div>

<form id="personal-info-form" action="{{ route('profile.personal-info.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    {{-- ── Section 1: Contact & Identity ─────────────────────────────────── --}}
    <div class="mb-8">
        <h4 class="text-base font-bold text-gray-800 mb-1">Contact &amp; Identity</h4>
        <p class="text-xs text-gray-500 mb-4">Used to pre-fill programme applications.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label for="pi-phone" class="block text-sm font-bold text-gray-700 mb-1.5">Contact Number</label>
                <input type="tel" id="pi-phone" name="phone" value="{{ old('phone', $user->phone) }}"
                    placeholder="e.g. 073 123 4567"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="pi-id-number" class="block text-sm font-bold text-gray-700 mb-1.5">ID Number</label>
                <input type="text" id="pi-id-number" name="id_number" value="{{ old('id_number', $user->id_number) }}"
                    placeholder="13-digit SA ID" maxlength="20"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="pi-age" class="block text-sm font-bold text-gray-700 mb-1.5">Age</label>
                <input type="number" id="pi-age" name="age" value="{{ old('age', $user->age) }}"
                    min="1" max="120"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <p id="pi-age-hint" class="hidden mt-1 text-xs text-blue-600 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
                    <span></span>
                </p>
            </div>

            <div>
                <label for="pi-province" class="block text-sm font-bold text-gray-700 mb-1.5">Province</label>
                <select id="pi-province" name="province"
                    class="block w-full p-2.5 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">— Select province —</option>
                    @foreach(['Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo','Mpumalanga','Northern Cape','North West','Western Cape'] as $prov)
                        <option value="{{ $prov }}" {{ old('province', $user->province) === $prov ? 'selected' : '' }}>{{ $prov }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="pi-address" class="block text-sm font-bold text-gray-700 mb-1.5">Physical Address</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <input type="text" id="pi-address" name="address" value="{{ old('address', $user->address) }}"
                        placeholder="Start typing your address…"
                        autocomplete="off"
                        class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <p class="mt-1 text-xs text-gray-400">Powered by Google Maps — selecting a suggestion also fills Province.</p>
            </div>
        </div>
    </div>

    {{-- ── Section 2: Education ────────────────────────────────────────────── --}}
    <div class="mb-8 pt-6 border-t border-gray-200">
        <h4 class="text-base font-bold text-gray-800 mb-1">Education</h4>
        <p class="text-xs text-gray-500 mb-4">Your high school and tertiary background.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
            <div class="md:col-span-1">
                <label for="pi-high-school" class="block text-sm font-bold text-gray-700 mb-1.5">Name of High School</label>
                <input type="text" id="pi-high-school" name="high_school" value="{{ old('high_school', $user->high_school) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="pi-year-completion" class="block text-sm font-bold text-gray-700 mb-1.5">Year Completed</label>
                <input type="text" id="pi-year-completion" name="year_of_completion" value="{{ old('year_of_completion', $user->year_of_completion) }}"
                    placeholder="e.g. 2018" maxlength="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label for="pi-qualification" class="block text-sm font-bold text-gray-700 mb-1.5">Qualification Obtained</label>
                <input type="text" id="pi-qualification" name="qualification" value="{{ old('qualification', $user->qualification) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="pi-institution" class="block text-sm font-bold text-gray-700 mb-1.5">Institution</label>
                <input type="text" id="pi-institution" name="institution" value="{{ old('institution', $user->institution) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="pi-year-obtained" class="block text-sm font-bold text-gray-700 mb-1.5">Year Completed</label>
                <input type="text" id="pi-year-obtained" name="year_obtained" value="{{ old('year_obtained', $user->year_obtained) }}"
                    placeholder="e.g. 2022" maxlength="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
        </div>
    </div>

    {{-- ── Section 3: Documents ────────────────────────────────────────────── --}}
    <div class="mb-8 pt-6 border-t border-gray-200">
        <h4 class="text-base font-bold text-gray-800 mb-1">Supporting Documents</h4>
        <p class="text-xs text-gray-500 mb-4">PDF only, max 2 MB. Stored once and reused in your applications.</p>

        @php
            $docs = [
                ['field'=>'cv',                   'label'=>'CV',                   'path'=>$user->cv_path],
                ['field'=>'id_copy',              'label'=>'ID Copy',              'path'=>$user->id_copy_path],
                ['field'=>'qualification_copy',   'label'=>'Qualification Copy',   'path'=>$user->qualification_copy_path],
            ];
        @endphp

        <div class="space-y-4">
        @foreach($docs as $doc)
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">{{ $doc['label'] }}</label>
                @if($doc['path'])
                    <div class="flex items-center gap-3 p-3 rounded-lg bg-green-50 border border-green-200 mb-2" id="pi-{{ $doc['field'] }}-stored">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-xs text-green-700 font-medium flex-1">Document on file</span>
                        <button type="button" onclick="piShowReplace('{{ $doc['field'] }}')" class="text-xs text-blue-600 underline hover:text-blue-800">Replace</button>
                    </div>
                @endif
                <div id="pi-{{ $doc['field'] }}-input" class="{{ $doc['path'] ? 'hidden' : '' }}">
                    <input type="file" name="{{ $doc['field'] }}" accept=".pdf"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if($doc['path'])
                        <button type="button" onclick="piCancelReplace('{{ $doc['field'] }}')" class="mt-1 text-xs text-gray-500 underline">Cancel</button>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="pt-5 border-t border-gray-100 flex items-center justify-between">
        <p class="text-xs text-gray-400">This information pre-fills your programme applications.</p>
        <button type="submit" id="pi-save-btn" class="btn-primary">
            <span id="pi-save-label">Save information</span>
        </button>
    </div>
</form>

<script>
/* ── Google Places Autocomplete ──────────────────────────────────────── */
window.__initGoogleAddressPI = function () {
    var input = document.getElementById('pi-address');
    if (!input || !window.google) return;

    var ac = new google.maps.places.Autocomplete(input, {
        componentRestrictions: { country: 'ZA' },
        fields: ['address_components', 'formatted_address'],
        types: ['address'],
    });

    /* SA province name mapping */
    var provinceCodes = {
        'Gauteng': 'Gauteng',
        'Western Cape': 'Western Cape',
        'Eastern Cape': 'Eastern Cape',
        'KwaZulu-Natal': 'KwaZulu-Natal',
        'Free State': 'Free State',
        'Limpopo': 'Limpopo',
        'Mpumalanga': 'Mpumalanga',
        'North West': 'North West',
        'Northern Cape': 'Northern Cape',
    };

    ac.addListener('place_changed', function () {
        var place = ac.getPlace();
        if (!place || !place.address_components) return;

        input.value = place.formatted_address || input.value;

        var provinceEl = document.getElementById('pi-province');
        if (provinceEl) {
            for (var i = 0; i < place.address_components.length; i++) {
                var comp = place.address_components[i];
                if (comp.types.indexOf('administrative_area_level_1') !== -1) {
                    var longName = comp.long_name;
                    if (provinceCodes[longName]) {
                        provinceEl.value = provinceCodes[longName];
                    }
                    break;
                }
            }
        }
    });

    /* Prevent form submission on Enter inside autocomplete */
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && document.querySelector('.pac-container .pac-item')) {
            e.preventDefault();
        }
    });
};

(function () {

    /* ── Document replace helpers ──────────────────────────────────────── */
    window.piShowReplace = function (field) {
        var stored = document.getElementById('pi-' + field + '-stored');
        var input  = document.getElementById('pi-' + field + '-input');
        if (stored) stored.classList.add('hidden');
        if (input)  input.classList.remove('hidden');
    };
    window.piCancelReplace = function (field) {
        var stored = document.getElementById('pi-' + field + '-stored');
        var input  = document.getElementById('pi-' + field + '-input');
        if (stored) stored.classList.remove('hidden');
        if (input)  input.classList.add('hidden');
        var fileEl = input ? input.querySelector('input[type=file]') : null;
        if (fileEl) fileEl.value = '';
    };

    /* ── RSA ID → age ──────────────────────────────────────────────────── */
    function calcAgeFromRsaId(id) {
        if (!id || id.length < 6) return null;
        var yy = parseInt(id.substring(0, 2), 10);
        var mm = parseInt(id.substring(2, 4), 10);
        var dd = parseInt(id.substring(4, 6), 10);
        if (isNaN(yy) || isNaN(mm) || isNaN(dd)) return null;
        if (mm < 1 || mm > 12 || dd < 1 || dd > 31) return null;
        var now       = new Date();
        var currentYY = now.getFullYear() % 100;
        var fullYear  = yy <= currentYY ? 2000 + yy : 1900 + yy;
        var birth     = new Date(fullYear, mm - 1, dd);
        var age       = now.getFullYear() - birth.getFullYear();
        if (now.getMonth() < birth.getMonth() ||
           (now.getMonth() === birth.getMonth() && now.getDate() < birth.getDate())) age--;
        return (age > 0 && age < 150) ? age : null;
    }

    var idInput  = document.getElementById('pi-id-number');
    var ageInput = document.getElementById('pi-age');
    var ageHint  = document.getElementById('pi-age-hint');

    if (idInput && ageInput) {
        idInput.addEventListener('input', function () {
            var val = idInput.value.replace(/\D/g, '');
            var age = calcAgeFromRsaId(val);
            if (age !== null) {
                ageInput.value = age;
                if (ageHint) {
                    var sp = ageHint.querySelector('span');
                    if (sp) sp.textContent = 'Calculated from your ID number.';
                    ageHint.classList.remove('hidden');
                }
            } else {
                if (ageHint) ageHint.classList.add('hidden');
            }
        });
    }

    /* ── AJAX form submit ──────────────────────────────────────────────── */
    var form    = document.getElementById('personal-info-form');
    var saveBtn = document.getElementById('pi-save-btn');
    var saveLbl = document.getElementById('pi-save-label');
    var alertOk  = document.getElementById('pi-alert-success');
    var alertErr = document.getElementById('pi-alert-error');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        alertOk.classList.add('hidden');
        alertErr.classList.add('hidden');
        saveBtn.disabled = true;
        saveLbl.textContent = 'Saving…';

        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        })
        .then(function (res) {
            return res.json().then(function (body) { return { ok: res.ok, body: body }; });
        })
        .then(function (result) {
            if (!result.ok) {
                var errs = result.body.errors
                    ? Object.values(result.body.errors).flat().join(' ')
                    : (result.body.message || 'Something went wrong.');
                alertErr.textContent = errs;
                alertErr.classList.remove('hidden');
            } else {
                alertOk.textContent = result.body.message || 'Personal information saved.';
                alertOk.classList.remove('hidden');

                // Update stored-doc indicators for newly uploaded files
                ['cv', 'id_copy', 'qualification_copy'].forEach(function (field) {
                    var prop = field === 'cv' ? 'cv_stored' : (field === 'id_copy' ? 'id_stored' : 'qual_stored');
                    if (result.body[prop]) {
                        var stored = document.getElementById('pi-' + field + '-stored');
                        var input  = document.getElementById('pi-' + field + '-input');
                        if (stored) stored.classList.remove('hidden');
                        if (input)  input.classList.add('hidden');
                    }
                });

                // Unlock tabs if previously locked
                var root = document.querySelector('.profile-shell');
                if (root) {
                    root.querySelectorAll('[data-tab][disabled]').forEach(function (btn) {
                        btn.removeAttribute('disabled');
                        btn.removeAttribute('data-locked');
                        btn.removeAttribute('title');
                        btn.classList.remove('opacity-40', 'cursor-not-allowed');
                    });
                    delete root.dataset.initialTab;
                }
                var banner = document.getElementById('pi-completion-banner');
                if (banner) {
                    banner.style.transition = 'opacity 0.4s';
                    banner.style.opacity = '0';
                    setTimeout(function () { banner.remove(); }, 400);
                }
                document.querySelectorAll('.profile-tab .text-amber-500').forEach(function (el) { el.remove(); });
            }
        })
        .catch(function () {
            alertErr.textContent = 'Network error. Please try again.';
            alertErr.classList.remove('hidden');
        })
        .finally(function () {
            saveBtn.disabled = false;
            saveLbl.textContent = 'Save information';
        });
    });
}());
</script>
