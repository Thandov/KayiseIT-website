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
        
        <form action="{{ route('admin.dashboard.services.deleteSelected') }}" method="POST" id="delete-selected-form">
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
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $service->service_type ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="/dashboard/services/{{ $service->slug }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                   title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" onclick="editService({{ $service->id }})" 
                                        class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" onclick="deleteService({{ $service->id }})" 
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <div class="flex justify-between items-center mt-4">
            <button type="button" onclick="deleteSelected()" class="h-10 px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Delete Selected
            </button>
            
            @if(isset($services) && count($services) > 0)
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">Total: {{ count($services) }} services</span>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('checkbox-all');
    const checkboxes = document.querySelectorAll('.checkbox');
    
    if (selectAllCheckbox && checkboxes.length > 0) {
        selectAllCheckbox.addEventListener('click', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }
});

function deleteSelected() {
    const selectedIds = document.querySelectorAll('input[name="selected_ids[]"]:checked');
    const selectedIdsArray = Array.from(selectedIds).map(input => input.value);
    
    if (selectedIdsArray.length === 0) {
        alert('Please select at least one service to delete.');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIdsArray.length} service(s)?`)) {
        document.getElementById('selected-ids-input').value = JSON.stringify(selectedIdsArray);
        document.getElementById('delete-selected-form').submit();
    }
}

function editService(id) {
    window.location.href = `/dashboard/services/viewservice/${id}`;
}

function deleteService(id) {
    if (confirm('Are you sure you want to delete this service?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/dashboard/services/deleteservice/${id}`;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.getAttribute('content');
            form.appendChild(csrfInput);
        } else {
            alert('CSRF token not found. Please refresh the page and try again.');
            return;
        }
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
