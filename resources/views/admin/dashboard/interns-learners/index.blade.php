@extends('admin.dashboard.layout')

@section('page-title', 'Interns & Learners')

@section('content')
    <div class="p-6">
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
                    <h1 class="text-3xl font-bold text-gray-900">Interns & Learners</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage interns and learners in your programs</p>
                </div>
                <a href="{{ route('dashboard.interns-learners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Intern/Learner
                </a>
            </div>
        </div>

        <!-- Interns & Learners Table -->
        @if(!$internsLearners->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($internsLearners as $internLearner)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="item-checkbox rounded border-gray-300 text-kb-600 focus:ring-kb-500" value="{{ $internLearner->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $internLearner->full_name }}</div>
                                @if($internLearner->id_number)
                                <div class="text-sm text-gray-500">ID: {{ $internLearner->id_number }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $internLearner->email }}</div>
                                @if($internLearner->phone)
                                <div class="text-sm text-gray-500">{{ $internLearner->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($internLearner->program)
                                <span class="text-sm text-gray-900">{{ $internLearner->program->name }}</span>
                                @else
                                <span class="text-sm text-gray-400">No program assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($internLearner->status === 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($internLearner->status === 'completed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Terminated</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $internLearner->start_date ? $internLearner->start_date->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('dashboard.interns-learners.view', $internLearner->id) }}" 
                                   class="text-kb-600 hover:text-kb-900 mr-3">View</a>
                                <a href="{{ route('dashboard.interns-learners.edit', $internLearner->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('dashboard.interns-learners.delete', $internLearner->id) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this intern/learner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="mt-4 flex items-center justify-between">
            <button id="deleteSelected" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                Delete Selected
            </button>
            
            <!-- Pagination -->
            @if($internsLearners->hasPages())
            <div class="flex items-center space-x-1">
                @if($internsLearners->previousPageUrl())
                <a href="{{ $internsLearners->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                @foreach(range(1, $internsLearners->lastPage()) as $page)
                    @if($page == $internsLearners->currentPage())
                    <span class="px-3 py-2 text-sm font-medium text-white bg-kb-100 border border-kb-100 rounded">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $internsLearners->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                @if($internsLearners->nextPageUrl())
                <a href="{{ $internsLearners->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @endif
            </div>
            @endif
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12">
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                    <i class="fas fa-users text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No interns or learners found</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first intern or learner.</p>
                <a href="{{ route('dashboard.interns-learners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600">
                    <i class="fas fa-plus mr-2"></i>
                    Add Intern/Learner
                </a>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Select all checkbox
        document.getElementById('selectAll')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateDeleteButton();
        });

        // Individual checkboxes
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        function updateDeleteButton() {
            const checked = document.querySelectorAll('.item-checkbox:checked');
            const deleteBtn = document.getElementById('deleteSelected');
            if (deleteBtn) {
                deleteBtn.disabled = checked.length === 0;
            }
        }

        // Delete selected
        document.getElementById('deleteSelected')?.addEventListener('click', function() {
            const checked = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
            if (checked.length === 0) return;
            
            if (confirm('Are you sure you want to delete ' + checked.length + ' selected item(s)?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.dashboard.interns-learners.deleteSelected") }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);

                const ids = document.createElement('input');
                ids.type = 'hidden';
                ids.name = 'selected_ids';
                ids.value = JSON.stringify(checked);
                form.appendChild(ids);

                document.body.appendChild(form);
                form.submit();
            }
        });
    </script>
@endsection
