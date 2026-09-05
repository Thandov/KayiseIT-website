<x-app-layout title="Request Your Certificate">
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
    @endphp
    <div class="pt-24 pb-10 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ url()->previous() ?: url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Request Your Certificate</h1>
                <p class="text-gray-600 mb-6">Enter your South African ID number below. If it matches our learner records, we will use your name from those records to generate your certificate. You do not need to log in.</p>

                @if (session('success'))
                    <div class="mb-6 rounded-md bg-green-50 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-800">
                        <div class="font-semibold mb-2">Please fix the following errors:</div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('certification.submit') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number<span class="text-red-600">*</span></label>
                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required placeholder="13-digit ID number" autocomplete="off" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Required. Your ID must appear in our learner records. Your name and surname on the certificate will come from that record.</p>
                            <p id="cert-lookup-status" class="mt-1 text-sm text-indigo-600 hidden" aria-live="polite"></p>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Optional. Only used if your record is missing a first name.</p>
                        </div>

                        <div>
                            <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Optional. Only used if your record is missing a surname.</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Optional. Used to send you the certificate or contact you if needed.</p>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap gap-4 items-center">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Generate certificate
                        </button>
                        <p class="text-sm text-gray-500">If your ID is not found, you will see a message and can contact support.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            (function () {
                var lookupUrl = @json(route('certification.lookup'));
                var idEl = document.getElementById('id_number');
                var nameEl = document.getElementById('name');
                var surnameEl = document.getElementById('surname');
                var statusEl = document.getElementById('cert-lookup-status');
                if (!idEl || !nameEl || !surnameEl) return;

                function digitsOnly(s) {
                    return (s || '').replace(/\D/g, '');
                }

                function setStatus(text) {
                    if (!statusEl) return;
                    if (text) {
                        statusEl.textContent = text;
                        statusEl.classList.remove('hidden');
                    } else {
                        statusEl.textContent = '';
                        statusEl.classList.add('hidden');
                    }
                }

                var lookupSeq = 0;
                var debounceTimer;

                function runLookup() {
                    var d = digitsOnly(idEl.value);
                    if (d.length < 9 || d.length > 13) {
                        setStatus('');
                        return;
                    }
                    var mySeq = ++lookupSeq;
                    setStatus('Looking up your record…');
                    var url = lookupUrl + (lookupUrl.indexOf('?') >= 0 ? '&' : '?') + 'id=' + encodeURIComponent(idEl.value);
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: { Accept: 'application/json' }
                    })
                        .then(function (res) {
                            return res.json().then(function (data) {
                                return { res: res, data: data };
                            });
                        })
                        .then(function (o) {
                            if (mySeq !== lookupSeq) return;
                            setStatus('');
                            if (!o.res.ok || !o.data || !o.data.found) return;
                            if (typeof o.data.name === 'string') nameEl.value = o.data.name;
                            if (typeof o.data.surname === 'string') surnameEl.value = o.data.surname;
                        })
                        .catch(function () {
                            if (mySeq !== lookupSeq) return;
                            setStatus('');
                        });
                }

                idEl.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    var d = digitsOnly(idEl.value);
                    if (d.length < 9) {
                        setStatus('');
                        return;
                    }
                    debounceTimer = setTimeout(function () {
                        runLookup();
                    }, 320);
                });

                idEl.addEventListener('paste', function () {
                    clearTimeout(debounceTimer);
                    setTimeout(function () {
                        var d = digitsOnly(idEl.value);
                        if (d.length >= 9) runLookup();
                    }, 0);
                });
            })();
        </script>
    @endpush
</x-app-layout>
