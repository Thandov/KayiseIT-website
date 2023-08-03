<x-app-layout title="Staff Dashboard">
    <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        @include('breadcrumb')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Clients</h3>
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All our clients.</p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="ml-auto">
                        <x-front-end-btn linking="{{ url('admin/clients/newclient') }}" color="blue" showme="add-client-btn" name="Add Client" />
                    </div>
                </div>
                @include('admin.clients._view')
            </div>
        </div>
    </div>

</x-app-layout>