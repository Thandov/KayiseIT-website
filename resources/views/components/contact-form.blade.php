<div class="ki-card">
    <form action="{{ route('contactsubmit') }}" method="post" id="contactForm">
        @csrf
        <fieldset class="ki-stack-tight">
            <legend class="text-sm font-semibold text-slate-900">Which services can we help with?</legend>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ($services as $service)
                    <label for="service-{{ $service->id }}" class="ki-cluster text-sm font-medium text-gray-900">
                        <input
                            type="checkbox"
                            name="services[]"
                            value="{{ $service->service_id }}"
                            id="service-{{ $service->id }}"
                            class="h-4 w-4 flex-shrink-0 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span>{{ $service->name }}</span>
                    </label>
                @endforeach
            </div>
        </fieldset>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Your Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input mt-2 block w-full sm:text-sm sm:leading-5 sm:rounded-md" placeholder="Your Name" required>
            </div>
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Your Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input mt-2 block w-full sm:text-sm sm:leading-5 sm:rounded-md" placeholder="Your Email" required>
            </div>
        </div>

        <div class="mt-4">
            <label for="subject" class="block font-medium text-sm text-gray-700">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject', request('ref') ? 'Case study: '.request('ref') : '') }}" class="form-input mt-2 block w-full sm:text-sm sm:leading-5 sm:rounded-md" placeholder="Subject" required>
        </div>
        <div class="mt-4">
            <label for="message" class="block font-medium text-sm text-gray-700">Message</label>
            <textarea id="message" name="message" class="form-textarea mt-2 block w-full sm:text-sm sm:leading-5 sm:rounded-md" rows="5" placeholder="Your Message" required>{{ old('message') }}</textarea>
        </div>
        <div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>
        <div class="mt-6">
            <button type="submit" class="ki-btn">Send Message</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var form = this;
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', {
                action: 'contactsubmit'
            }).then(function (token) {
                document.getElementById('g-recaptcha-response').value = token;
                form.submit();
            });
        });
    });
</script>
