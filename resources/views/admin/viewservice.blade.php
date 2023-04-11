<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Service') }}
        </h2>
    </x-slot>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-7 gap-8">
        <div id="service-info" class="md:col-span-2">
            <div class="p-4 border rounded-md mb-4">
                <h2 class="text-lg font-bold mb-2">{{ $service->name }}</h2>
                <p class="text-sm text-gray-600">{{ $service->description }}</p>
                <button id="edit-service-info" class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Edit</button>
                <div id="edit-service-info-form" class="hidden">
                    <form method="POST" action="{{ url('/service/'.$service->id) }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="service-name" class="block text-gray-700 font-bold mb-2">Service Name:</label>
                            <input type="text" id="service-name" name="name" value="{{ $service->name }}" class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="service-description" class="block text-gray-700 font-bold mb-2">Service Description:</label>
                            <textarea id="service-description" name="description" class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $service->description }}</textarea>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="border p-4 rounded-md mb-4 md:col-span-5" id="subservice-list">
            <div class="card-header mb-4">
                <div class="row">
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ url('admin/services/addsubservices/'.$service->id) }}" id="add-subservice-btn" class="btn btn-primary me-3">ADD SUBSERVICE</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subservices as $subservice)
                    <!-- Inside the <tbody> of #subservice-list -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subservice->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subservice->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subservice->price }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ url('admin/viewsubservice/'.$subservice->id) }}" title="View">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <form method="POST" action="{{ url('subservice/'.$subservice->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                                <button type="submit" style="background-color: red" title="Delete" class="rounded-md px-3 py-1">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <!-- Modal -->
    <!-- This is the code for the modal -->
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Subservice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    @include('admin.subservices.add-new-subservice')
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</x-app-layout>

<script>
    $(document).ready(function() {
        $('.view-options-btn').click(function() {
            var subserviceId = $(this).data('subservice-id');

            $.ajax({
                type: 'GET',
                url: '/admin/viewoptions/' + subserviceId,
                success: function(data) {
                    $('#options-container').html(data);
                }
            });
        });
    });

    document.querySelector('#add-subservice-btn').addEventListener('click', function(e) {
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