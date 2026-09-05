<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration link invalid – KAYISE IT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-8 text-center">
            <x-application-logo class="w-16 h-16 fill-current text-gray-500 mx-auto mb-4" />
            <h1 class="text-xl font-bold text-gray-900 mb-2">Registration link invalid</h1>
            <p class="text-sm text-gray-600 mb-6">
                This registration link has expired, already been used, or is not valid. Please contact your administrator to request a new invite.
            </p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-kb-100 text-white text-sm font-medium rounded-md hover:bg-kb-200">
                Go to login
            </a>
        </div>
    </div>
</body>
</html>
