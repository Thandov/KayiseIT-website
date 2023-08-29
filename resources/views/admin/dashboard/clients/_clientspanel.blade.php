<!-- Clients Panel Stats -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 pt-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Client Panel</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 justify-items-center mx-auto py-4 gap-2">
                
                @include('admin.dashboard.clients._newest')
            </div>
        </div>
    </div>
</div>