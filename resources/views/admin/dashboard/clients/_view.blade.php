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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Province
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (!empty($clients) && count($clients) > 0)
                @foreach ($clients as $client)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-{{$client->id}}" value="{{$client->id}}" name="selected_ids[]" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox">
                            <label for="checkbox-table-{{$client->id}}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $client->first_name }} {{ $client->surname ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $client->company ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $client->email ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $client->phone ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $client->province ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboard.clients.viewclient', $client->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            <span class="text-gray-300">|</span>
                            <button type="button" class="text-red-600 hover:text-red-900 delete-client-btn" data-client-id="{{ $client->id }}">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        No clients found. <a href="#" class="text-blue-600 hover:text-blue-800 add-client-btn">Add your first client</a>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </form>

    <div class="flex justify-end mt-4">
        <button type="button" onclick="deleteSelected()" class="h-10 px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete Selected</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(function($) {
            $('#checkbox-all').click(function() {
                // Check or uncheck all checkboxes based on the state of the checkbox-all.
                $('.checkbox').prop('checked', this.checked);
            });
        });

        function deleteSelected() {
            const selectedIds = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            const selectedIdsArray = Array.from(selectedIds).map(input => input.value);
            
            if (selectedIdsArray.length === 0) {
                alert('Please select at least one client to delete.');
                return;
            }
            
            if (confirm(`Are you sure you want to delete ${selectedIdsArray.length} client(s)?`)) {
                document.getElementById('selected-ids-input').value = JSON.stringify(selectedIdsArray);
                document.getElementById('delete-selected-form').submit();
            }
        }

        function deleteRow(clientId) {
            if (confirm('Are you sure you want to delete this client? This action cannot be undone.')) {
                // Create a form element and submit it to delete the individual row
                const form = document.createElement('form');
                form.method = 'POST';
                const baseUrl = '/dashboard/clients/delete/';
                form.action = baseUrl + clientId;
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                // Add method spoofing
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Add event listeners for delete buttons
        document.querySelectorAll('.delete-client-btn').forEach(button => {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-client-id');
                deleteRow(clientId);
            });
        });
    });
</script>