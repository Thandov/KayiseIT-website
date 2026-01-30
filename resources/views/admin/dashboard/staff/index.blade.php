@extends('admin.dashboard.layout')

@section('page-title', 'Staff Dashboard')

@section('content')
    <div class="p-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Dashboard Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Staff Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage your team members efficiently</p>
                </div>
                <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-200 focus:bg-kb-200 active:bg-kb-300 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Staff
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Staff</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Provinces</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->pluck('province')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Verified</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->where('id_verifi_doc', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">All Staff Members</h2>
            </div>
            
            @if($employees->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Province</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" value="{{ $employee->id }}" class="staff-checkbox rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($employee->profile_picture)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->first_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-kb-50 flex items-center justify-center">
                                            <span class="text-kb-100 font-medium">{{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name ?? '', 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $employee->first_name }} {{ $employee->last_name ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->phone ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $employee->province ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->ID_number ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('dashboard.staff.view', $employee->id) }}" class="text-kb-100 hover:text-kb-200">View</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('dashboard.staff.view', $employee->id) }}" class="text-kg-700 hover:text-kg-600">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <button data-staff-id="{{ $employee->id }}" class="delete-staff-btn text-red-600 hover:text-red-900">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                <button onclick="deleteSelected()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete Selected
                </button>
                <div class="flex items-center space-x-4">
                    <p class="text-sm text-gray-700">Showing <span class="font-medium">{{ $employees->firstItem() }}</span> to <span class="font-medium">{{ $employees->lastItem() }}</span> of <span class="font-medium">{{ $employees->total() }}</span> staff</p>
                    <div>
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No staff members</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding a new team member.</p>
                <div class="mt-6">
                    <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Staff
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div id="staffModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-lg font-bold text-gray-900">Add New Staff Member</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent">
                @include('admin.dashboard.staff._form', ['employee' => null])
            </div>
        </div>
    </div>

    <script>
        // Select All Checkbox
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.staff-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Modal Functions
        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Add New Staff Member';
            const form = document.getElementById('staffForm');
            if (form) {
                form.reset();
                form.action = '{{ route("dashboard.staff.create") }}';
            }
            document.getElementById('staffModal').classList.remove('hidden');
        }

        function openEditModal(staffId, staffName) {
            // Redirect to view page for editing
            window.location.href = `/dashboard/staff/${staffId}`;
        }

        function closeModal() {
            document.getElementById('staffModal').classList.add('hidden');
        }

        // Delete Functions
        function deleteStaff(staffId) {
            if (confirm('Are you sure you want to delete this staff member? This action cannot be undone.')) {
                fetch(`/dashboard/staff/delete/${staffId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Staff member deleted successfully!');
                        location.reload();
                    } else {
                        alert('Failed to delete staff member: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the staff member.');
                });
            }
        }

        function deleteSelected() {
            const selected = document.querySelectorAll('.staff-checkbox:checked');
            if (selected.length === 0) {
                alert('Please select at least one staff member to delete.');
                return;
            }
            
            if (confirm(`Are you sure you want to delete ${selected.length} staff member(s)? This action cannot be undone.`)) {
                selected.forEach(checkbox => {
                    deleteStaff(checkbox.value);
                });
            }
        }

        // Event listeners for edit and delete buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-staff-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const staffId = this.getAttribute('data-staff-id');
                    const staffName = this.getAttribute('data-staff-name');
                    openEditModal(staffId, staffName);
                });
            });

            document.querySelectorAll('.delete-staff-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const staffId = this.getAttribute('data-staff-id');
                    deleteStaff(staffId);
                });
            });
        });

        // Close modal on outside click
        document.getElementById('staffModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
