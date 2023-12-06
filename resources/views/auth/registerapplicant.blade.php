<x-guest-layout>
    <h1 class="font-bold text-center ">Create account</h1>
    <form method="POST" action="{{ route('registerapplicant') }}" id="registerForm">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Account Type')" />
            <select id="role_id" name="role_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                <option value="client">Client</option>
                <option value="business">Business</option>
            </select>
        </div>
        <div><input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"></div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('loginapplicant') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="button" onclick="onClick(event)">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.site_key ') }}', {
                        action: 'register'
                    }).then(function(token) {
                    document.getElementById("g-recaptcha-response").value = token;
                    document.getElementById("registerForm").submit();

                });
            });
        }
    </script>
    <!-- <script>
        function onSubmit(token) {
            document.getElementById("registerForm").submit();
        }
    </script> -->
</x-guest-layout>