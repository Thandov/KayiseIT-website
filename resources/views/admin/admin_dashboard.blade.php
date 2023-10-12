<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN DASHBOARD') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                @include('admin.dashboard.sales._salestats')
            </div>
            <div class="col-span-1">
                <!-- Leads and Clients -->
                @include('admin.dashboard.clients._clientspanel')
            </div>
        </div>

        <!-- Invoices and Quotations -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 my-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 pt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Action Page</h3>
                    <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                        <x-dash-card name="Clients" href="dashboard/clients"></x-dash-card>
                        <x-dash-card name="Staff" href="dashboard/staff"></x-dash-card>
                        <x-dash-card name="Career Mapping" href="dashboard/careermapping"></x-dash-card>
                        <x-dash-card name="Carousel" href="/dashboard/carousel"></x-dash-card>
                        <x-dash-card name="Blogs" href="dashboard/blogs/"></x-dash-card>
                        <x-dash-card name="Services" href="dashboard/services/"></x-dash-card>
                        <x-dash-card name="Invoices" href="dashboard/invoices/"></x-dash-card>
                        <x-dash-card name="Quotations" href="dashboard/quotations/"></x-dash-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>