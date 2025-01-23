<div class="bg-white rounded-md shadow-md border-2 p-4">

    <form action="{{ route('contactsubmit') }}" method="post" id="contactForm" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <p>Which Services can we help with?</p>
            <hr>
            @foreach ($services as $service)
            <div class="flex items-center space-x-2">
                <!-- Checkbox -->
                <input type="checkbox" value="{{ $service->service_id }}" id="service-{{ $service->id }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">

                <!-- Label -->
                <label for="service-{{ $service->id }}" class="text-sm font-medium text-gray-900">{{ $service->name }}</label>
            </div>
            @endforeach
        </fieldset>
        <hr>
        <fieldset>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="w-full">
                    <label for="name" class="block font-medium text-sm text-gray-700">Your Name</label>
                    <div class="relative rounded-md">
                        <input type="text" id="name" name="name" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" placeholder="Your Name" required>
                    </div>
                </div>
                <div class="w-full">
                    <label for="email" class="block font-medium text-sm text-gray-700">Your Email</label>
                    <div class="relative rounded-md">
                        <input type="email" id="email" name="email" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" placeholder="Your Email" required>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="mt-2">
            <label for="subject" class="block font-medium text-sm text-gray-700">Subject</label>
            <div class="relative rounded-md">
                <input type="text" id="subject" name="subject" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out border-l-rose-600 sm:rounded-md" placeholder="Subject" required>
            </div>
        </div>
        <div class="mt-2">
            <label for="message" class="block font-medium text-sm text-gray-700">Message</label>
            <div class="relative rounded-md">
                <textarea id="message" name="message" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 sm:rounded-md" rows="5" style="height: 150px" placeholder="Your Message" required></textarea>
            </div>
        </div>
        <div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>
        <div class="mt-3">
            <x-front-end-btn linking="submit" color="blue" showme="" name="Send Message" />
        </div>
    </form>

    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', {
                    action: 'contactsubmit'
                }).then(function(token) {
                    document.getElementById("g-recaptcha-response").value = token;
                    document.getElementById("contactForm").submit();

                });
            });
        }
    </script>
</div>