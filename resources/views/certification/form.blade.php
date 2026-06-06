<x-app-layout
    title="Download your training certificate | KAYISE IT"
    description="Enter your learner details to verify eligibility and download your KAYISE IT training certificate as a PDF."
    keywords="KAYISE IT certificate, training certificate download, learner certificate"
>
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
        $certificateFailed = $errors->has('certificate');
        $supportRoute = \Illuminate\Support\Facades\Route::has('certification.support') ? route('certification.support') : route('certification.submit');
        $certJsonBodyField = \App\Http\Middleware\PrepareCertificationAjaxJson::JSON_RESPONSE_BODY_FLAG;
    @endphp
    <div class="pt-24 pb-10 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
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

                @if ($errors->any() && !$certificateFailed)
                    <div id="cert-blade-validation-errors" class="mb-6 rounded-md bg-red-50 p-4 text-red-800">
                        <div class="font-semibold mb-2">Please fix the following errors:</div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div id="cert-ajax-errors" class="mb-6 rounded-md bg-red-50 p-4 text-red-800 hidden" role="alert">
                    <ul id="cert-ajax-errors-list" class="list-disc list-inside text-sm"></ul>
                </div>

                <div id="cert-certificate-failed-banner" class="mb-6 rounded-md bg-amber-50 border border-amber-200 p-4 text-amber-900 {{ $certificateFailed ? '' : 'hidden' }}">
                    <p class="font-semibold mb-1">Certificate could not be generated automatically</p>
                    <p id="cert-certificate-failed-text" class="text-sm">
                        @if ($certificateFailed)
                            {{ $errors->first('certificate') }}
                        @else
                            Please add your <strong>name</strong>, <strong>surname</strong>, and <strong>email address</strong> below so we can help you manually. Then tap <strong>Email support</strong>.
                        @endif
                    </p>
                </div>

                <div id="cert-success-panel" class="mb-6 rounded-md bg-green-50 border border-green-200 p-6 text-green-900 hidden" role="status">
                    <p class="text-lg font-semibold mb-2">Message sent</p>
                    <p id="cert-success-panel-text" class="text-sm"></p>
                </div>

                <form
                    id="certification-form"
                    method="POST"
                    action="{{ $certificateFailed ? $supportRoute : route('certification.submit') }}"
                    class="space-y-6"
                    data-submit-url="{{ route('certification.submit') }}"
                    data-support-url="{{ \Illuminate\Support\Facades\Route::has('certification.support') ? route('certification.support') : '' }}"
                    data-initial-support="{{ $certificateFailed ? '1' : '0' }}"
                    data-json-body-field="{{ $certJsonBodyField }}"
                >
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number<span class="text-red-600">*</span></label>
                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required placeholder="13-digit ID number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p class="mt-1 text-sm text-gray-500">Required. Your ID must appear in our learner records. Your name and surname on the certificate will come from that record.</p>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name<span id="name-required-star" class="text-red-600 {{ $certificateFailed ? '' : 'hidden' }}">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" {{ $certificateFailed ? 'required' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p id="name-help" class="mt-1 text-sm text-gray-500">{{ $certificateFailed ? 'Required so we can match your request.' : 'Optional. Only used if your record is missing a first name.' }}</p>
                        </div>

                        <div>
                            <label for="surname" class="block text-sm font-medium text-gray-700">Surname<span id="surname-required-star" class="text-red-600 {{ $certificateFailed ? '' : 'hidden' }}">*</span></label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname') }}" {{ $certificateFailed ? 'required' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p id="surname-help" class="mt-1 text-sm text-gray-500">{{ $certificateFailed ? 'Required so we can match your request.' : 'Optional. Only used if your record is missing a surname.' }}</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email<span id="email-required-star" class="text-red-600 {{ $certificateFailed ? '' : 'hidden' }}">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" {{ $certificateFailed ? 'required' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <p id="email-help" class="mt-1 text-sm text-gray-500">{{ $certificateFailed ? 'Required — we will use this to reply to you.' : 'Optional. Used to send you the certificate or contact you if needed.' }}</p>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap gap-4 items-center">
                        <button type="submit" id="cert-submit-btn" class="inline-flex items-center justify-center min-w-[10rem] px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-60 disabled:cursor-not-allowed">
                            <span id="cert-submit-label">{{ $certificateFailed ? 'Email support' : 'Generate certificate' }}</span>
                            <span id="cert-submit-loading" class="hidden ml-2" aria-hidden="true">…</span>
                        </button>
                        <p id="cert-footer-hint" class="text-sm text-gray-500 {{ $certificateFailed ? 'hidden' : '' }}">If your ID is not found, you will see a message and can contact support.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        (function () {
            var form = document.getElementById('certification-form');
            if (!form) return;

            var submitUrl = form.getAttribute('data-submit-url');
            var supportUrl = form.getAttribute('data-support-url');
            var btn = document.getElementById('cert-submit-btn');
            var label = document.getElementById('cert-submit-label');
            var loading = document.getElementById('cert-submit-loading');
            var banner = document.getElementById('cert-certificate-failed-banner');
            var bannerText = document.getElementById('cert-certificate-failed-text');
            var ajaxErrors = document.getElementById('cert-ajax-errors');
            var ajaxErrorsList = document.getElementById('cert-ajax-errors-list');
            var successPanel = document.getElementById('cert-success-panel');
            var successPanelText = document.getElementById('cert-success-panel-text');
            var footerHint = document.getElementById('cert-footer-hint');
            var nameEl = document.getElementById('name');
            var surnameEl = document.getElementById('surname');
            var emailEl = document.getElementById('email');
            var nameStar = document.getElementById('name-required-star');
            var surnameStar = document.getElementById('surname-required-star');
            var emailStar = document.getElementById('email-required-star');
            var nameHelp = document.getElementById('name-help');
            var surnameHelp = document.getElementById('surname-help');
            var emailHelp = document.getElementById('email-help');

            var supportMode = form.getAttribute('data-initial-support') === '1';
            var jsonBodyField = form.getAttribute('data-json-body-field') || '_certification_json_response';

            function csrfToken() {
                var m = document.querySelector('meta[name="csrf-token"]');
                return m ? m.getAttribute('content') : '';
            }

            function setLoading(isLoading, message) {
                btn.disabled = isLoading;
                loading.classList.toggle('hidden', !isLoading);
                if (message) label.textContent = message;
            }

            function showAjaxErrors(messages) {
                ajaxErrorsList.innerHTML = '';
                messages.forEach(function (t) {
                    var li = document.createElement('li');
                    li.textContent = t;
                    ajaxErrorsList.appendChild(li);
                });
                ajaxErrors.classList.remove('hidden');
            }

            function clearAjaxErrors() {
                ajaxErrors.classList.add('hidden');
                ajaxErrorsList.innerHTML = '';
            }

            function enterSupportMode(serverMessage) {
                supportMode = true;
                form.setAttribute('action', supportUrl);
                banner.classList.remove('hidden');
                if (serverMessage) {
                    bannerText.textContent = serverMessage;
                }
                nameEl.setAttribute('required', 'required');
                surnameEl.setAttribute('required', 'required');
                emailEl.setAttribute('required', 'required');
                nameStar.classList.remove('hidden');
                surnameStar.classList.remove('hidden');
                emailStar.classList.remove('hidden');
                nameHelp.textContent = 'Required so we can match your request.';
                surnameHelp.textContent = 'Required so we can match your request.';
                emailHelp.textContent = 'Required — we will use this to reply to you.';
                label.textContent = 'Email support';
                if (footerHint) footerHint.classList.add('hidden');
            }

            function parseErrorsPayload(data) {
                var list = [];
                if (data.errors) {
                    Object.keys(data.errors).forEach(function (k) {
                        var arr = data.errors[k];
                        if (Array.isArray(arr)) arr.forEach(function (x) { list.push(x); });
                    });
                }
                return list;
            }

            function readFetchJson(res) {
                return res.text().then(function (text) {
                    var data = null;
                    var trimmed = (text || '').trim();
                    if (trimmed !== '') {
                        try {
                            data = JSON.parse(trimmed);
                        } catch (ignore) {
                            data = null;
                        }
                    }
                    return { res: res, data: data, rawText: text || '', redirected: false };
                });
            }

            function messageForNonJsonResponse(res, rawText) {
                var s = res.status;
                if (s === 0) {
                    return 'Your browser could not complete the certificate request (often due to a redirect or security filter). Try refreshing the page, turning off strict blockers for this site, or use another browser. If it keeps happening, email info@kayiseit.com.';
                }
                if (s === 419) {
                    return 'Your session has expired. Refresh this page and try again.';
                }
                if (s === 401 || s === 403) {
                    return 'You do not have permission to complete this action.';
                }
                if (s === 503 || s === 504) {
                    return 'The service is temporarily unavailable. Please try again in a moment.';
                }
                if (s >= 500) {
                    return 'Something went wrong on the server. Please try again or email info@kayiseit.com.';
                }
                if (s === 404) {
                    return 'The request could not be processed. Please refresh the page and try again.';
                }
                if (s >= 200 && s < 300 && rawText && /<!DOCTYPE\s+html|<\s*html[\s>]/i.test(rawText)) {
                    return 'We could not read the server response (the site returned a web page instead of data). Refresh this page and try again.';
                }
                return 'Something went wrong (HTTP ' + s + '). Please refresh the page and try again.';
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                clearAjaxErrors();
                var bladeValBox = document.getElementById('cert-blade-validation-errors');
                if (bladeValBox) bladeValBox.classList.add('hidden');

                if (supportMode) {
                    if (!supportUrl || !String(supportUrl).trim()) {
                        setLoading(false, 'Email support');
                        showAjaxErrors(['Support is temporarily unavailable. Please email info@kayiseit.com directly.']);
                        return;
                    }
                    setLoading(true, 'Sending…');
                    var bodySupport = new URLSearchParams(new FormData(form));
                    bodySupport.set(jsonBodyField, '1');
                    fetch(supportUrl, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-Certification-Ajax': '1',
                            'X-CSRF-TOKEN': csrfToken()
                        },
                        body: bodySupport
                    })
                        .then(readFetchJson)
                        .then(function (_ref) {
                            var res = _ref.res;
                            var data = _ref.data;
                            setLoading(false, 'Email support');
                            if (data === null) {
                                showAjaxErrors([messageForNonJsonResponse(res, _ref.rawText)]);
                                return;
                            }
                            if (res.ok && data.success) {
                                form.classList.add('hidden');
                                banner.classList.add('hidden');
                                successPanelText.textContent = data.message || 'Thank you. Our team has received your details.';
                                successPanel.classList.remove('hidden');
                                successPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            } else if (res.status === 422 && data.errors) {
                                showAjaxErrors(parseErrorsPayload(data));
                            } else {
                                var msg = data.message || (parseErrorsPayload(data).join(' ') || 'Something went wrong. Please try again.');
                                showAjaxErrors([msg]);
                            }
                        })
                        .catch(function () {
                            setLoading(false, 'Email support');
                            showAjaxErrors(['Network error. Please check your connection and try again.']);
                        });
                    return;
                }

                setLoading(true, 'Generating…');
                var bodyGen = new URLSearchParams(new FormData(form));
                bodyGen.set(jsonBodyField, '1');
                fetch(submitUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-Certification-Ajax': '1',
                        'X-CSRF-TOKEN': csrfToken()
                    },
                    body: bodyGen
                })
                    .then(readFetchJson)
                    .then(function (_ref2) {
                        var res = _ref2.res;
                        var data = _ref2.data;
                        setLoading(false, 'Generate certificate');

                        if (data === null) {
                            showAjaxErrors([messageForNonJsonResponse(res, _ref2.rawText)]);
                            return;
                        }

                        if (res.ok && data.success && data.redirect) {
                            window.location.href = data.redirect;
                            return;
                        }

                        if (data.certificate_failed) {
                            enterSupportMode(data.message || '');
                            setLoading(false, 'Email support');
                            return;
                        }

                        if (res.status === 422 && data.errors) {
                            showAjaxErrors(parseErrorsPayload(data));
                            return;
                        }

                        showAjaxErrors([data.message || 'Something went wrong. Please try again.']);
                    })
                    .catch(function () {
                        setLoading(false, 'Generate certificate');
                        showAjaxErrors(['Network error. Please check your connection and try again.']);
                    });
            });

            if (supportMode) {
                label.textContent = 'Email support';
            }
        })();
    </script>
</x-app-layout>
