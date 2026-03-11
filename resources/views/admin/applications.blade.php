<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg thando">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                <i class="fas fa-cogs text-white"></i>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Applications</h3>
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">All our Applications.</p>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="ml-auto">
                @if(isset($canCreateApplication) && $canCreateApplication)
                <button id="add-application-btn" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Add Application
                </button>
                @endif
            </div>
        </div>
        
        <form action="{{ route('admin.dashboard.applications.deleteSelected') }}" method="POST" id="delete-selected-form">
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
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Application
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
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
                    @if(!empty($applications))
                    @foreach($applications as $application)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-{{$application->id}}" value="{{$application->id}}" name="selected_ids[]" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox">
                                <label for="checkbox-table-{{$application->id}}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $application->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $application->app_type ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $application->field ?? 'No field selected' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($application->status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ url('dashboard/viewapplications/'.$application->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button onclick="deleteApplication(this)" 
                                        data-id="{{ $application->id }}"
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </form>

        <div class="flex justify-between items-center mt-4">
            <button type="button" onclick="deleteSelected()" class="h-10 px-4 py-2 bg-red-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Delete Selected
            </button>
            
            @if(isset($applications) && count($applications) > 0)
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">Total: {{ count($applications) }} applications</span>
            </div>
            @endif
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

    // Add application button functionality
    const addBtn = document.getElementById('add-application-btn');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            window.location.href = '/dashboard/applications/create';
        });
    }
});

function deleteSelected() {
    const selectedIds = document.querySelectorAll('input[name="selected_ids[]"]:checked');
    const selectedIdsArray = Array.from(selectedIds).map(input => input.value);
    
    if (selectedIdsArray.length === 0) {
        alert('Please select at least one application to delete.');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIdsArray.length} application(s)?`)) {
        document.getElementById('selected-ids-input').value = JSON.stringify(selectedIdsArray);
        document.getElementById('delete-selected-form').submit();
    }
}

function deleteApplication(button) {
    const id = button.getAttribute('data-id');
    if (confirm('Are you sure you want to delete this application?')) {
        const form = document.createElement('form');
        form.method = 'DELETE';
        form.action = `/dashboard/applications/delete/${id}`;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.getAttribute('content');
            form.appendChild(csrfInput);
        }
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>