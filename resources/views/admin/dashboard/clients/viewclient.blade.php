<x-app-layout title="Staff Dashboard">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       @include('breadcrumb')
        <!-- New display -->
        <x-client-form :client="$client" />
    </div>
</x-app-layout>