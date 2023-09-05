<x-app-layout>
    <x-alerting />
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('breadcrumb')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Services</h3>
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All our services.</p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="ml-auto">
                        <x-front-end-btn linking="{{ route('dashboard.services.addservice') }}" color="blue" showme="add-service-btn" name="Add Service" />
                    </div>
                </div>
                <div class="mt-4">
                    <form action="{{ route('admin.dashboard.clients.deleteSelected') }}" method="POST" id="delete-selected-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="selected_ids" id="selected-ids-input" value="">

                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">Select All</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($services as $service)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-{{$service->id}}" value="{{$service->id}}" name="selected_ids[]" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox">
                                            <label for="checkbox-table-{{$service->id}}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">{{ $service->name }}</td>
                                    <td align="right">
                                        <x-front-end-btn linking="/dashboard/services/{{ $service->slug }}" color="blue" showme="" name="View" />
                                        <button type="button" class="text-red-700 hover:text-red-900" onclick="deleteRow({{ $service->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>

                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="deleteSelected()" class="h-10 px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete Selected</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#checkbox-all').click(function() {
            // Check or uncheck all checkboxes based on the state of the checkbox-all.
            $('.checkbox').prop('checked', this.checked);
        });
    });

    function deleteSelected() {
        const selectedIds = document.querySelectorAll('input[name="selected_ids[]"]:checked');
        const selectedIdsArray = Array.from(selectedIds).map(input => input.value);
        document.getElementById('selected-ids-input').value = JSON.stringify(selectedIdsArray);
        document.getElementById('delete-selected-form').submit();
    }

    function deleteRow(service_id) {
        if (confirm('Are you sure you want to delete this service?')) {
            // Create a form element and submit it to delete the individual row
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "/dashboard/services/deleteservice/" + service_id; // Use string concatenation
            form.innerHTML = `
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">`;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>