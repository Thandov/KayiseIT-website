<x-app-layout>

   <div class="container py-5 mx-auto grid grid-cols-1 md:grid-cols-7 gap-8">
        <div id="service-info" class="md:col-span-2">
            <div class="p-4 border rounded-md mb-4">
                <h2 class="text-lg font-bold mb-2">{{ $subservice->name }}</h2>
                <p>Price: R{{ $subservice->price }}</p>
                <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ url('admin/services/addoptions/'.$subservice->id) }}" id="add-option-btn" class="btn btn-primary me-3">ADD Option</a>
                        </div>
            </div>
        </div>

        <div class="border p-4 rounded-md mb-4 md:col-span-5" id="subservice-list">
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
