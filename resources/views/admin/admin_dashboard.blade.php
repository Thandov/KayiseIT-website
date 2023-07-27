<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN DASHBOARD') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Sales Stats -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            SALES STATS
        </div>
        <!-- Leads and Clients -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            CLIENT LEADS
        </div>
        <!-- Invoices and Quotations -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 pt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Action Page</h3>
                    <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                        <x-dash-card name="Clients" href="admin/clients"></x-dash-card>
                        <x-dash-card name="Staff" href="admin/staff"></x-dash-card>
                        <x-dash-card name="Career Mapping" href="admin/dashboard/careermapping_dashboard"></x-dash-card>
                        <x-dash-card name="Carousel" href="/admin/carousel/carousels"></x-dash-card>
                        <x-dash-card name="Blogs" href="admin/blogs/view_all_blogs"></x-dash-card>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services -->
        <div class="my-4 bg-white shadow overflow-hidden rounded-lg">
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