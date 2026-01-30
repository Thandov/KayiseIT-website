<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Internship Applications</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage all internship applications</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button id="add-internship-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    Add Internship
                </button>
                <button id="delete-selected-btn" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" disabled>
                    <i class="fas fa-trash mr-2"></i>
                    Delete Selected
                </button>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <div class="mb-6 flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" id="search-input" placeholder="Search internships..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex gap-2">
                <select id="status-filter" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <button id="refresh-btn" class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <!-- Internships Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input id="select-all" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="internships-table-body" class="bg-white divide-y divide-gray-200">
                    @if(!empty($internships))
                    @foreach($internships as $internship)
                        <tr class="hover:bg-gray-50" data-id="{{ $internship->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="internship-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $internship->id }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $internship->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $internship->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $internship->email ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $internship->field ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $internship->status === 'approved' ? 'bg-green-100 text-green-800' : ($internship->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($internship->status ?? 'pending') }}
                            </span>
                        </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $internship->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                    <button data-id="{{ $internship->id }}" class="view-btn text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                    <button data-id="{{ $internship->id }}" class="edit-btn text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                    <button data-id="{{ $internship->id }}" class="delete-btn text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No internships found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing <span id="showing-count">{{ count($internships ?? []) }}</span> of <span id="total-count">{{ count($internships ?? []) }}</span> internships
            </div>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="internship-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">Add Internship</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
    </div>

            <form id="internship-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="internship-id" name="id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="id_no" class="block text-sm font-medium text-gray-700">ID Number *</label>
                        <input type="text" id="id_no" name="id_no" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700">Age *</label>
                        <input type="number" id="age" name="age" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                        <textarea id="address" name="address" rows="2" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div>
                        <label for="high_school" class="block text-sm font-medium text-gray-700">High School *</label>
                        <input type="text" id="high_school" name="high_school" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="year_of_completion" class="block text-sm font-medium text-gray-700">Year of Completion *</label>
                        <input type="number" id="year_of_completion" name="year_of_completion" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700">Qualification *</label>
                        <input type="text" id="qualification" name="qualification" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="year_obtained" class="block text-sm font-medium text-gray-700">Year Obtained *</label>
                        <input type="number" id="year_obtained" name="year_obtained" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="institution" class="block text-sm font-medium text-gray-700">Institution *</label>
                        <input type="text" id="institution" name="institution" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="app_type" class="block text-sm font-medium text-gray-700">Application Type *</label>
                        <select id="app_type" name="app_type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract">Contract</option>
                        </select>
                    </div>
                    <div>
                        <label for="field" class="block text-sm font-medium text-gray-700">Field *</label>
                        <input type="text" id="field" name="field" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <!-- File Uploads -->
                <div class="mt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Documents</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="cv_file" class="block text-sm font-medium text-gray-700">CV File</label>
                            <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div>
                            <label for="id_copy_file" class="block text-sm font-medium text-gray-700">ID Copy</label>
                            <input type="file" id="id_copy_file" name="id_copy_file" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div>
                            <label for="qualification_copy_file" class="block text-sm font-medium text-gray-700">Qualification Copy</label>
                            <input type="file" id="qualification_copy_file" name="qualification_copy_file" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span id="submit-text">Create Internship</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Internship Details</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="view-content" class="space-y-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Delete Internship</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this internship? This action cannot be undone.</p>
                </div>
                <div class="mt-4 flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button id="confirm-delete" class="px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentInternshipId = null;
let isEditMode = false;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize event listeners
    initializeEventListeners();
    updateDeleteButtonState();
});

function initializeEventListeners() {
    // Add internship button
    document.getElementById('add-internship-btn').addEventListener('click', function() {
        openCreateModal();
    });

    // Delete selected button
    document.getElementById('delete-selected-btn').addEventListener('click', function() {
        deleteSelectedInternships();
    });

    // Select all checkbox
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.internship-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDeleteButtonState();
    });

    // Individual checkboxes
    document.querySelectorAll('.internship-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateDeleteButtonState();
        });
    });

    // Action buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            viewInternship(this.getAttribute('data-id'));
        });
    });

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            editInternship(this.getAttribute('data-id'));
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteInternship(this.getAttribute('data-id'));
        });
    });

    // Search functionality
    document.getElementById('search-input').addEventListener('input', function() {
        filterInternships();
    });

    // Status filter
    document.getElementById('status-filter').addEventListener('change', function() {
        filterInternships();
    });

    // Refresh button
    document.getElementById('refresh-btn').addEventListener('click', function() {
        location.reload();
    });

    // Form submission
    document.getElementById('internship-form').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm();
    });
}

function openCreateModal() {
    isEditMode = false;
    document.getElementById('modal-title').textContent = 'Add Internship';
    document.getElementById('submit-text').textContent = 'Create Internship';
    document.getElementById('internship-form').reset();
    document.getElementById('internship-id').value = '';
    document.getElementById('internship-modal').classList.remove('hidden');
}

function editInternship(id) {
    isEditMode = true;
    currentInternshipId = id;
    
    // Fetch internship data
    fetch(`/dashboard/internships/view/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const internship = data.internship;
                
                // Populate form
                document.getElementById('internship-id').value = internship.id;
                document.getElementById('name').value = internship.name || '';
                document.getElementById('email').value = internship.email || '';
                document.getElementById('id_no').value = internship.id_no || '';
                document.getElementById('age').value = internship.age || '';
                document.getElementById('address').value = internship.address || '';
                document.getElementById('high_school').value = internship.high_school || '';
                document.getElementById('year_of_completion').value = internship.year_of_completion || '';
                document.getElementById('qualification').value = internship.qualification || '';
                document.getElementById('year_obtained').value = internship.year_obtained || '';
                document.getElementById('institution').value = internship.institution || '';
                document.getElementById('app_type').value = internship.app_type || '';
                document.getElementById('field').value = internship.field || '';
                document.getElementById('status').value = internship.status || 'pending';
                
                document.getElementById('modal-title').textContent = 'Edit Internship';
                document.getElementById('submit-text').textContent = 'Update Internship';
                document.getElementById('internship-modal').classList.remove('hidden');
            } else {
                showAlert('Error loading internship data', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error loading internship data', 'error');
        });
}

function viewInternship(id) {
    fetch(`/dashboard/internships/view/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const internship = data.internship;
                const content = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Name:</strong> ${internship.name || 'N/A'}</div>
                        <div><strong>Email:</strong> ${internship.email || 'N/A'}</div>
                        <div><strong>ID Number:</strong> ${internship.id_no || 'N/A'}</div>
                        <div><strong>Age:</strong> ${internship.age || 'N/A'}</div>
                        <div><strong>Address:</strong> ${internship.address || 'N/A'}</div>
                        <div><strong>High School:</strong> ${internship.high_school || 'N/A'}</div>
                        <div><strong>Year of Completion:</strong> ${internship.year_of_completion || 'N/A'}</div>
                        <div><strong>Qualification:</strong> ${internship.qualification || 'N/A'}</div>
                        <div><strong>Year Obtained:</strong> ${internship.year_obtained || 'N/A'}</div>
                        <div><strong>Institution:</strong> ${internship.institution || 'N/A'}</div>
                        <div><strong>Application Type:</strong> ${internship.app_type || 'N/A'}</div>
                        <div><strong>Field:</strong> ${internship.field || 'N/A'}</div>
                        <div><strong>Status:</strong> <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${internship.status === 'approved' ? 'bg-green-100 text-green-800' : (internship.status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')}">${(internship.status || 'pending').charAt(0).toUpperCase() + (internship.status || 'pending').slice(1)}</span></div>
                        <div><strong>Created:</strong> ${new Date(internship.created_at).toLocaleDateString()}</div>
                    </div>
                `;
                document.getElementById('view-content').innerHTML = content;
                document.getElementById('view-modal').classList.remove('hidden');
            } else {
                showAlert('Error loading internship data', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error loading internship data', 'error');
        });
}

function deleteInternship(id) {
    currentInternshipId = id;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function deleteSelectedInternships() {
    const selectedIds = Array.from(document.querySelectorAll('.internship-checkbox:checked')).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        showAlert('Please select at least one internship to delete', 'warning');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIds.length} internship(s)?`)) {
        fetch('/dashboard/internships/deleteSelected', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ selected_ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                location.reload();
            } else {
                showAlert(data.message || 'Error deleting internships', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error deleting internships', 'error');
        });
    }
}

function submitForm() {
    const form = document.getElementById('internship-form');
    const formData = new FormData(form);
    
    const url = isEditMode ? `/dashboard/internships/update/${currentInternshipId}` : '/dashboard/internships/store';
    const method = isEditMode ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            closeModal();
            location.reload();
        } else {
            showAlert(data.message || 'Error saving internship', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error saving internship', 'error');
    });
}

function closeModal() {
    document.getElementById('internship-modal').classList.add('hidden');
    document.getElementById('internship-form').reset();
}

function closeViewModal() {
    document.getElementById('view-modal').classList.add('hidden');
}

function closeDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
    currentInternshipId = null;
}

function updateDeleteButtonState() {
    const selectedCount = document.querySelectorAll('.internship-checkbox:checked').length;
    const deleteBtn = document.getElementById('delete-selected-btn');
    
    if (selectedCount > 0) {
        deleteBtn.disabled = false;
        deleteBtn.textContent = `Delete Selected (${selectedCount})`;
    } else {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<i class="fas fa-trash mr-2"></i>Delete Selected';
    }
}

function filterInternships() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const statusFilter = document.getElementById('status-filter').value;
    const rows = document.querySelectorAll('tbody tr[data-id]');
    
    rows.forEach(row => {
        const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        const field = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
        const status = row.querySelector('td:nth-child(6) span').textContent.toLowerCase();
        
        const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || field.includes(searchTerm);
        const matchesStatus = !statusFilter || status.includes(statusFilter);
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function showAlert(message, type) {
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${type === 'success' ? 'bg-green-100 text-green-800' : type === 'error' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}`;
    alert.textContent = message;
    
    document.body.appendChild(alert);
    
    // Remove after 3 seconds
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

// Delete confirmation
document.getElementById('confirm-delete').addEventListener('click', function() {
    if (currentInternshipId) {
        fetch(`/dashboard/internships/delete/${currentInternshipId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                closeDeleteModal();
                location.reload();
            } else {
                showAlert(data.message || 'Error deleting internship', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error deleting internship', 'error');
        });
    }
});
</script>