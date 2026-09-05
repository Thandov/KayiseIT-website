<div id="program-register-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" style="display: none;" aria-modal="true" role="dialog" aria-labelledby="program-register-title">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" data-close-program-register></div>

    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <div class="flex items-start justify-between gap-4 px-6 sm:px-10 pt-8 pb-4 border-b border-gray-100">
                <div>
                    <h2 id="program-register-title" class="text-2xl font-bold text-gray-900">Register</h2>
                    <p class="text-gray-600 text-sm mt-1">Complete the form below to register for your chosen programme.</p>
                </div>
                <button type="button" data-close-program-register class="flex-shrink-0 rounded-full p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="px-6 sm:px-10 py-6 sm:py-8 max-h-[calc(100vh-8rem)] overflow-y-auto">
                @if($errors->any())
                    <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-800">
                        <p class="font-semibold mb-2">Please fix the following:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('programs.register') }}" class="space-y-8" id="program-register-form" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Programme</h3>
                        <label for="internship_program_id" class="block text-sm font-medium text-gray-700 mb-1.5">Programme *</label>
                        <select id="internship_program_id" name="internship_program_id" required
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                            <option value="">Select programme</option>
                            @foreach($enquiryPrograms as $program)
                                <option value="{{ $program->id }}" {{ (string) old('internship_program_id') === (string) $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="program-dynamic-fields" class="space-y-6">
                        @if(old('internship_program_id') && ($oldProgram = $enquiryPrograms->firstWhere('id', (int) old('internship_program_id'))))
                            <x-program-form-fields :groupedFields="$oldProgram->getGroupedFormFields()" :values="old()" />
                        @endif
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                        <button type="button" data-close-program-register
                                class="inline-flex justify-center px-6 py-3 rounded-full text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="inline-flex justify-center px-10 py-3 rounded-full text-white font-semibold shadow-lg hover:-translate-y-0.5 transition-all"
                                style="background: #183ea4;">
                            Submit registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const modal = document.getElementById('program-register-modal');
    if (!modal) return;

    const programSelect = document.getElementById('internship_program_id');
    const fieldsContainer = document.getElementById('program-dynamic-fields');

    async function loadProgramFields(programId) {
        if (!fieldsContainer) return;
        if (!programId) {
            fieldsContainer.innerHTML = '<p class="text-sm text-gray-500">Select a programme to load the registration form.</p>';
            return;
        }

        fieldsContainer.innerHTML = '<p class="text-sm text-gray-500">Loading form…</p>';

        try {
            const response = await fetch('/api/programs/' + programId + '/form-fields', {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) throw new Error('Failed to load form');
            const data = await response.json();
            fieldsContainer.innerHTML = data.html || '';
        } catch (e) {
            fieldsContainer.innerHTML = '<p class="text-sm text-red-600">Could not load the form for this programme. Please try again.</p>';
        }
    }

    if (programSelect) {
        programSelect.addEventListener('change', function () {
            loadProgramFields(programSelect.value);
        });

        if (programSelect.value) {
            loadProgramFields(programSelect.value);
        }
    }

    window.openProgramRegisterModal = function (programId) {
        if (programSelect && programId) {
            programSelect.value = String(programId);
            loadProgramFields(programId);
        }
        modal.style.display = '';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const firstInput = modal.querySelector('input:not([type="hidden"])');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 100);
        }
    };

    window.closeProgramRegisterModal = function () {
        modal.style.display = 'none';
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    };

    modal.querySelectorAll('[data-close-program-register]').forEach((el) => {
        el.addEventListener('click', closeProgramRegisterModal);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display !== 'none') {
            closeProgramRegisterModal();
        }
    });

    @if($errors->any())
        openProgramRegisterModal({{ old('internship_program_id', 'null') }});
    @endif
})();
</script>
