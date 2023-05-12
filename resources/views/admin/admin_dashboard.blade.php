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
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Action Page</h3>
                    <div class="mt-5">
                        <div class="bg-gray-200 rounded-lg">
                            <div
                                class="grid grid-cols-1 md:grid-cols-4 flex justify-items-center gap-8 py-12 px-4 md:px-8 max-w-screen-xl mx-auto">

                                <div class="col-span-2 md:col-span-1">

                                    <a href="{{ url('admin/clients') }}"
                                        class="inline-flex items-center justify-content-center w-64 h-40 px-4 py-2 border border-transparent rounded-md font-semibold text-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Clients
                                    </a>
                                </div>
                                <div class="col-span-2 md:col-span-1">

                                    <a href="{{ url('admin/staff') }}"
                                        class="inline-flex items-center justify-content-center w-64 h-40 px-4 px-4 py-2 border border-transparent rounded-md font-semibold text-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Staff
                                    </a>

                                </div>
                                <div class="col-span-2 md:col-span-1">

                                    <a href="{{ url('admin/invoices') }}"
                                        class="inline-flex items-center justify-content-center w-64 h-40 px-4 px-4 py-2 border border-transparent rounded-md font-semibold text-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        
                                        <dl>
                                            <dt>
                                                Invoices
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-center text-gray-900">
                                                    {{ $invoices->count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                        
                                    </a>

                                </div>
                                <div class="col-span-1 md:col-span-1">

                                    <a href="{{ url('admin/quotations') }}"
                                        class="inline-flex items-center justify-content-center w-64 h-40 px-4 px-4 py-2 border border-transparent rounded-md font-semibold text-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                                        <dl>
                                            <dt>
                                                Quotations
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-center text-gray-900">
                                                    {{ $quotations->count() }}
                                                </div>
                                            </dd>
                                        </dl>

                                    </a>
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
    document.querySelector('#add-service-btn').addEventListener('click', function (e) {
        e.preventDefault();
        // your code here
        $('#myModal').modal('show');
    });
    document.querySelector('.close').addEventListener('click', function (e) {
        e.preventDefault();
        // your code here
        $('#myModal').modal('hide');
    });

    function previewImage(event) {
    var file = event.target.files[0];
    var formData = new FormData();
    formData.append('icon', file);

    var preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(file);

    // Send the FormData object to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/upload');
    xhr.send(formData);
}

</script>
