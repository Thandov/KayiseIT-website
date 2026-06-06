@extends('admin.dashboard.layout')

@section('page-title', 'Settings')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your dashboard preferences and account shortcuts.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 max-w-3xl bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg text-sm" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 max-w-3xl">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">Public website — navigation menu</h2>
                <p class="mt-1 text-sm text-gray-600">Add, reorder, and nest links in the site header (WordPress-style menu builder).</p>
                <div class="mt-4">
                    <a href="{{ route('dashboard.nav-menu') }}"
                       class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 no-underline">
                        Edit navigation menu
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">Public website — floating buttons</h2>
                <p class="mt-1 text-sm text-gray-600">Control the green WhatsApp pill and the blue “Ask me” assistant on pages that use the main site layout (not the admin dashboard).</p>

                <form method="POST" action="{{ route('dashboard.settings.update') }}" class="mt-6 space-y-6">
                    @csrf

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 py-3 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-900">WhatsApp floating button</p>
                            <p class="text-sm text-gray-500 mt-0.5">Shows the fixed WhatsApp shortcut on the public site.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0">
                            <input type="checkbox" name="show_whatsapp_floating" value="1" class="sr-only peer"
                                @checked(old('show_whatsapp_floating', $siteSettings->show_whatsapp_floating))>
                            <span class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kg-100 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kg-500 relative"></span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 py-3 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-900">“Ask me” chatbot</p>
                            <p class="text-sm text-gray-500 mt-0.5">Shows the assistant launcher and chat panel on the public site.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer shrink-0">
                            <input type="checkbox" name="show_chatbot_floating" value="1" class="sr-only peer"
                                @checked(old('show_chatbot_floating', $siteSettings->show_chatbot_floating))>
                            <span class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kg-100 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kg-500 relative"></span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save floating buttons
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">Signed-in account</h2>
                <p class="mt-1 text-sm text-gray-600">Details for the user currently using the admin dashboard.</p>
                <dl class="mt-4 space-y-3 text-sm">
                    <div>
                        <dt class="font-medium text-gray-500">Name</dt>
                        <dd class="text-gray-900">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Email</dt>
                        <dd class="text-gray-900">{{ $user->email }}</dd>
                    </div>
                </dl>
                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150 no-underline">
                        Edit profile
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">Application</h2>
                <p class="mt-1 text-sm text-gray-600">Environment and framework information (read-only).</p>
                <dl class="mt-4 space-y-3 text-sm">
                    <div>
                        <dt class="font-medium text-gray-500">Environment</dt>
                        <dd class="text-gray-900">{{ app()->environment() }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Laravel</dt>
                        <dd class="text-gray-900">{{ app()->version() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
