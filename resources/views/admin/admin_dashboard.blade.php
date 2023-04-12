<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN DASHBOARD') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Sales Stats -->
        <div class="bg-white overflow-hidden shadow rounded-lg">

        </div>
        <!-- Leads and Clients -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">

            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">

            </div>
        </div>

        <!-- Invoices and Quotations -->
        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Invoices</h3>
                    <div class="mt-5">
                        <div class="bg-gray-200 rounded-lg h-40"></div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Quotations</h3>
                    <div class="mt-5">
                        <div class="bg-gray-200 rounded-lg h-40">



                        <div class="flex items-center">
            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                <i class="fas fa-cogs text-white"></i>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Quotations count testing
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            {{ $quotations->count() }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>


                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="col-span-12 sm:col-span-6 md:col-span-4 mt-6 bg-white shadow overflow-hidden rounded-lg">
            @include('admin.dashboard.dashservices')
        </div>
    </div>

    <!-- Modal -->
    <!-- This is the code for the modal -->
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    @include('admin.services.add-new-service')
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</x-app-layout>

<script>
    document.querySelector('#add-service-btn').addEventListener('click', function(e) {
        e.preventDefault();
        // your code here
        $('#myModal').modal('show');
    });
    document.querySelector('.close').addEventListener('click', function(e) {
        e.preventDefault();
        // your code here
        $('#myModal').modal('hide');
    });
</script>