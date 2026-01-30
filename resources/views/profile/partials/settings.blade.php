<div class="grid md:grid-cols-3 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="md:col-span-2">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
    <div>
        @include('profile.partials.delete-user-form')
    </div>
</div>