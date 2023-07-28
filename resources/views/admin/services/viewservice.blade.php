<x-app-layout>
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
                    <a href="/admin/services/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Services
                    </a>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">{{ $service->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <i class="fas fa-cogs text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $service->name }}</h3>
                                </dt>

                            </dl>
                        </div>
                        <div class="ml-auto">
                            <x-front-end-btn linking="{{ route('admin.services.addsubservices', ['id' => $service->id]) }}" color="blue" showme="add-subservice-btn" name="Add Subservice" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-4 gap-4">
                        <div class="border rounded-md mb-4 md:col-span-5 overflow-hidden" id="subservice-list">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Price</th>
                                        <th class="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subservices as $subservice)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border px-4 py-2">{{ $subservice->id }}</td>
                                        <td class="border px-4 py-2">{{ $subservice->name }}</td>
                                        <td class="border px-4 py-2">{{ $subservice->price }}</td>
                                        <td class="border px-4 py-2">
                                            <div class="flex items-center justify-center space-x-4">
                                                <a href="{{ url('admin/subservices/viewsubservice/'.$subservice->id) }}" title="View" class="text-blue-600 hover:text-blue-800">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <form method="POST" action="{{ url('subservices/'.$subservice->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="subservice_id" value="{{ $subservice->id }}">
                                                    <button type="submit" title="Delete" class="text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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