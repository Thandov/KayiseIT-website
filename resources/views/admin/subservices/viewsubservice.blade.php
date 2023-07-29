<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/admin/admin_dashboard" class="ml-1 text-sm font-medium inline-flex">
                                <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard</a>
                        </li>
                        <a href="/admin/services/viewservice/{{$serviceID}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{$serviceName}}
                        </a>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">{{ $subservice->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
            <div id="service-info" class="p-4 border bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                <h2 class="text-lg font-bold mb-2">{{ $subservice->name }}</h2>
                <p>Price: R{{ $subservice->price }}</p>
                <div class="d-flex align-items-center justify-content-start">
                    <a href="{{ url('admin/services/addoptions/'.$subservice->id) }}" id="add-option-btn" class="btn btn-primary me-3">ADD Option</a>
                </div>
            </div>
            <div class="p-4 border bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-5" id="subservice-list">
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