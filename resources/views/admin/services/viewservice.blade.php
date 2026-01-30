<x-app-layout>
    {{$service}}
    <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb></x-breadcrumb>
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
                        <x-front-end-btn linking="{{ route('dashboard.services.addsubservices', ['id' => $service->id]) }}" color="blue" showme="add-subservice-btn" name="Add Subservice" />
                    </div>
                </div>
                @if ($extras)
                <div class="grid md:grid-cols-8 gap-4">
                    
                    @include('admin.services._addService')
                    
                    <div id="subservice-list" class="md:col-span-5">
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
                                            <a href="{{ url('dashboard/subservices/viewsubservice/'.$subservice->id) }}" title="View" class="text-blue-600 hover:text-blue-800">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <form method="POST" action="{{ route('dashboard.subservices.deletesubservice') }}">
                                                @csrf
                                                <input type="hidden" name="subservice_id" value="{{ $subservice->subserv_id }}">
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

                @else
                <div class="">
                    <div id="service-info" class="p-4 overflow-hidden sm:rounded-lg">
                        @include('admin.services._addService')
                    </div>
                </div>
                @endif
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
                url: '/dashboard/viewoptions/' + subserviceId,
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