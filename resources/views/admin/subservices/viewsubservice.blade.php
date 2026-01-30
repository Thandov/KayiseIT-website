<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <x-breadcrumb></x-breadcrumb>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
            <div id="service-info" class="p-4 border bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                <form action="{{ route('dashboard.editservice')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <!-- Input for Service Name -->
                    <div class="mb-4">
                        <label for="service-name" class="block text-gray-600 mb-2">Service Name</label>
                        <input type="text" id="service-name" name="name" class="cus-inp border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $subservice->name }}">
                    </div>

                    <!-- Input for Service Price -->
                    <div class="mb-4">
                        <label for="service-price" class="block text-gray-600 mb-2">Service Price</label>
                        <input type="text" id="service-price" name="price" class="cus-inp border rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $subservice->price }}">
                    </div>

                    <!-- Textarea for Service Description -->
                    <div class="mb-4">
                        <label for="service-description" class="block text-gray-600 mb-2">Service Description</label>
                        <textarea id="service-description" name="description" class="cus-inp border rounded-md p-2 w-full h-32 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $serviceDesc }}</textarea>
                    </div>

                    <!-- Save Button -->
                    <x-front-end-btn linking="{{ route('dashboard.editservice')}}" color="submit" showme="" name="Save" />
                </form>
            </div>

            <div class="p-4 border bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-5" id="subservice-list">
                <div class="d-flex align-items-center justify-content-start">
                    <x-front-end-btn linking="{{ url('admin/services/addoptions/'.$subservice->id) }}" color="blue" showme="add-option-btn" name="Add Option" />
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="card-header">
                            <th class="px-6 py-2">ID</th>
                            <th class="px-6 py-2">Name</th>
                            <th class="px-6 py-2">Price</th>
                            <th class="px-6 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                        <!-- Inside the <tbody> of #subservice-list -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $option->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $option->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $option->price }}</td>
                            <td class="py-3 px-6 text-center">
                                <form method="POST" action="{{ url('option/'.$option->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $option->id }}">
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
                    @include('admin.subservices.add-new-option')
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</x-app-layout>

<script>
    document.querySelector('#add-option-btn').addEventListener('click', function(e) {
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