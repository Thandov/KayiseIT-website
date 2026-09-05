<div class="ia-container">

    <div class="mb-5">
        <button type="button" onclick="hideApplyForm()" class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to my applications
        </button>
    </div>

    <div class="mb-5">
        <h3 class="text-xl font-bold text-gray-900">Apply for a programme</h3>
        <p class="text-sm text-gray-500 mt-1">Select a programme, complete the required fields, and submit without leaving this page.</p>
    </div>

    <div id="ia-alert-success" class="hidden mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm font-medium"></div>
    <div id="ia-alert-error"   class="hidden mb-4 p-4 rounded-lg bg-red-50   border border-red-200   text-red-800   text-sm font-medium"></div>

    <div class="mb-5">
        <div class="flex justify-between text-xs text-gray-500 mb-1.5">
            <span>Step <span id="ia-step-label">1</span> of <span id="ia-step-total">2</span></span>
            <span id="ia-pct-label">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-1.5">
            <div id="ia-progress-bar" class="h-1.5 bg-blue-500 rounded-full transition-all duration-300" style="width:0%"></div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form id="ia-form" action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <input type="hidden" name="internship_program_id" id="ia-program-id-hidden" value="">

            <div class="ia-step" data-step="1">
                <h5 class="font-bold text-gray-900 text-lg mb-1">Select a Programme</h5>
                <p class="text-sm text-gray-500 mb-4">Each programme has its own required fields.</p>
                <hr class="border-gray-200 mb-4">
                <div class="mb-4">
                    <label for="ia-program-select" class="block text-sm font-bold text-gray-700 mb-2">Programme *</label>
                    <select id="ia-program-select" name="selected_program_id" required
                        class="block w-full p-2.5 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="">Select programme</option>
                        @foreach($activePrograms as $prog)
                            <option value="{{ $prog->id }}">{{ $prog->name }}@if($prog->program_type) &mdash; {{ $prog->program_type }}@endif</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="ia-step hidden" data-step="2">
                <h5 class="font-bold text-gray-900 text-lg mb-1">Application details</h5>
                <p class="text-sm text-gray-500 mb-4" id="ia-program-name-label"></p>
                <hr class="border-gray-200 mb-4">
                <div id="ia-dynamic-fields" class="space-y-4">
                    <p class="text-sm text-gray-500">Loading form…</p>
                </div>
            </div>

            <div class="flex items-center mt-8 pt-5 border-t border-gray-200">
                <button type="button" id="ia-prev-btn" onclick="iaPrevStep()"
                    class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-600 transition-colors"
                    style="display:none;">
                    Previous
                </button>
                <div class="ml-auto flex items-center gap-3">
                    <button type="button" id="ia-next-btn" onclick="iaNextStep()"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition-colors">
                        Next &rarr;
                    </button>
                    <button type="button" id="ia-submit-btn" onclick="iaSubmitForm()"
                        class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition-colors disabled:opacity-60"
                        style="display:none;">
                        <span id="ia-submit-label">Submit Application</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function () {
    var IA_TOTAL = 2;
    var iaCurrent = 1;
    var fieldsLoadedFor = null;

    async function iaLoadProgramFields(programId) {
        var container = document.getElementById('ia-dynamic-fields');
        var label = document.getElementById('ia-program-name-label');
        var hidden = document.getElementById('ia-program-id-hidden');
        if (!container || !programId) return false;

        if (fieldsLoadedFor === programId) {
            return true;
        }

        container.innerHTML = '<p class="text-sm text-gray-500">Loading form…</p>';

        try {
            var response = await fetch('/api/programs/' + programId + '/form-fields', {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) throw new Error('load failed');
            var data = await response.json();
            container.innerHTML = data.html || '';
            if (label) label.textContent = data.program_name ? ('Applying for: ' + data.program_name) : '';
            if (hidden) hidden.value = programId;
            fieldsLoadedFor = programId;
            return true;
        } catch (e) {
            container.innerHTML = '<p class="text-sm text-red-600">Could not load the application form. Please try again.</p>';
            return false;
        }
    }

    function iaShowStep(step) {
        document.querySelectorAll('#ia-form .ia-step').forEach(function (el) {
            el.classList.add('hidden');
        });
        var target = document.querySelector('#ia-form .ia-step[data-step="' + step + '"]');
        if (target) target.classList.remove('hidden');

        document.getElementById('ia-step-label').textContent = step;
        var pct = Math.round(((step - 1) / (IA_TOTAL - 1)) * 100);
        document.getElementById('ia-progress-bar').style.width = pct + '%';
        document.getElementById('ia-pct-label').textContent = pct + '%';

        document.getElementById('ia-prev-btn').style.display   = step === 1 ? 'none' : 'inline-flex';
        document.getElementById('ia-next-btn').style.display   = step === IA_TOTAL ? 'none' : 'inline-flex';
        document.getElementById('ia-submit-btn').style.display = step === IA_TOTAL ? 'inline-flex' : 'none';
    }

    window.iaNextStep = async function () {
        if (iaCurrent === 1) {
            var programId = document.getElementById('ia-program-select').value;
            if (!programId) {
                alert('Please select a programme first.');
                return;
            }
            var ok = await iaLoadProgramFields(programId);
            if (!ok) return;
        }
        if (iaCurrent < IA_TOTAL) {
            iaCurrent++;
            iaShowStep(iaCurrent);
        }
    };

    window.iaPrevStep = function () {
        if (iaCurrent > 1) {
            iaCurrent--;
            iaShowStep(iaCurrent);
        }
    };

    window.iaResetForm = function () {
        var form = document.getElementById('ia-form');
        if (form) form.reset();
        iaCurrent = 1;
        fieldsLoadedFor = null;
        iaShowStep(1);
        document.getElementById('ia-alert-success').classList.add('hidden');
        document.getElementById('ia-alert-error').classList.add('hidden');
        document.getElementById('ia-dynamic-fields').innerHTML = '<p class="text-sm text-gray-500">Loading form…</p>';
    };

    window.iaSubmitForm = function () {
        var form       = document.getElementById('ia-form');
        var submitBtn  = document.getElementById('ia-submit-btn');
        var submitLbl  = document.getElementById('ia-submit-label');
        var alertOk    = document.getElementById('ia-alert-success');
        var alertErr   = document.getElementById('ia-alert-error');

        alertOk.classList.add('hidden');
        alertErr.classList.add('hidden');
        submitBtn.disabled = true;
        submitLbl.textContent = 'Submitting…';

        fetch(form.action, {
            method:  'POST',
            body:    new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept':           'application/json',
            },
        })
        .then(function (res) {
            return res.json().then(function (data) {
                return { ok: res.ok, data: data };
            });
        })
        .then(function (result) {
            if (!result.ok) {
                var errs = result.data.errors
                    ? Object.values(result.data.errors).flat().join(' ')
                    : (result.data.message || 'Something went wrong. Please try again.');
                alertErr.textContent = errs;
                alertErr.classList.remove('hidden');
                return;
            }
            alertOk.textContent = result.data.message || 'Application submitted successfully!';
            alertOk.classList.remove('hidden');

            fetch('/profile/applications-partial', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            })
            .then(function (r) { return r.text(); })
            .then(function (html) {
                var listContent = document.getElementById('apps-list-content');
                if (listContent) listContent.innerHTML = html;
            })
            .finally(function () {
                setTimeout(function () { hideApplyForm(); }, 1800);
            });
        })
        .catch(function () {
            alertErr.textContent = 'A network error occurred. Please check your connection and try again.';
            alertErr.classList.remove('hidden');
        })
        .finally(function () {
            submitBtn.disabled = false;
            submitLbl.textContent = 'Submit Application';
        });
    };

    document.getElementById('ia-program-select').addEventListener('change', function () {
        fieldsLoadedFor = null;
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { iaShowStep(1); });
    } else {
        iaShowStep(1);
    }
}());
</script>
