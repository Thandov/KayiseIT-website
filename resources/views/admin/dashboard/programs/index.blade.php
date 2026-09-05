@extends('admin.dashboard.layout')

@section('page-title', 'Programs')

@section('content')
    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{!! session('success') !!}</span>
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
                    <h1 class="text-3xl font-bold text-gray-900">Programs</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage internship programs, TVET placements, and short programs</p>
                </div>
                <a href="{{ route('dashboard.programs.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 focus:bg-kb-700 active:bg-kb-700 focus:outline-none focus:ring-2 focus:ring-kb-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Program
                </a>
            </div>
        </div>

        <!-- Programs Table -->
        @if(!$programs->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-kb-600 focus:ring-kb-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recruitment Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number Needed</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Public page</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($programs as $program)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="item-checkbox rounded border-gray-300 text-kb-600 focus:ring-kb-500" value="{{ $program->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $program->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($program->program_type === 'Internship') bg-blue-100 text-blue-800
                                    @elseif($program->program_type === 'TVET Placement') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800
                                    @endif">
                                    {{ $program->program_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $program->duration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $program->recruitment_start_date->format('M d, Y') }} - {{ $program->recruitment_end_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $program->number_needed }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($program->is_active)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                           class="enquiry-toggle rounded border-gray-300 text-kb-600 focus:ring-kb-500"
                                           data-url="{{ route('dashboard.programs.toggle-enquiry', $program->id) }}"
                                           {{ $program->allows_enquiry ? 'checked' : '' }}>
                                    <span class="ml-2 text-xs font-medium enquiry-label {{ $program->allows_enquiry ? 'text-sky-700' : 'text-emerald-700' }}">
                                        {{ $program->allows_enquiry ? 'Collecting' : 'Running' }}
                                    </span>
                                </label>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="ki-table-actions">
                                    <a href="{{ route('dashboard.programs.view', $program->id) }}"
                                       class="text-kb-600 hover:text-kb-900">View</a>
                                    <a href="{{ route('dashboard.programs.edit', $program->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('dashboard.programs.delete', $program->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this program?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-2 flex flex-wrap items-center justify-between gap-2">
            <div class="ki-table-actions">
                <span id="selectedCount" class="text-xs text-gray-500">0 selected</span>
                <button type="button" data-bulk-action="activate"
                        class="bulk-action px-3 py-2 text-sm rounded-md bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>Activate</button>
                <button type="button" data-bulk-action="deactivate"
                        class="bulk-action px-3 py-2 text-sm rounded-md bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>Inactive</button>
                <button type="button" data-bulk-action="delete"
                        class="bulk-action px-3 py-2 text-sm rounded-md bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>Delete</button>
            </div>

            @if($programs->hasPages())
            <div class="flex items-center gap-1">
                @if($programs->previousPageUrl())
                <a href="{{ $programs->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                @foreach(range(1, $programs->lastPage()) as $page)
                    @if($page == $programs->currentPage())
                    <span class="px-3 py-2 text-sm font-medium text-white bg-kb-100 border border-kb-100 rounded">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $programs->url($page) }}" 
                       class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50">
                        {{ $page }}
                    </a>
                    @endif
                @endforeach

                @if($programs->nextPageUrl())
                <a href="{{ $programs->nextPageUrl() }}" 
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
                    <i class="fas fa-briefcase text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No programs found</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first program.</p>
                <a href="{{ route('dashboard.programs.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600">
                    <i class="fas fa-plus mr-2"></i>
                    Add Program
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
            updateBulkActions();
        });

        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActions);
        });

        function selectedIds() {
            return Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
        }

        function updateBulkActions() {
            const checked = selectedIds();
            const countEl = document.getElementById('selectedCount');
            if (countEl) {
                countEl.textContent = checked.length === 1 ? '1 selected' : checked.length + ' selected';
            }
            document.querySelectorAll('.bulk-action').forEach(btn => {
                btn.disabled = checked.length === 0;
            });
            const selectAll = document.getElementById('selectAll');
            const all = document.querySelectorAll('.item-checkbox');
            if (selectAll && all.length) {
                selectAll.checked = checked.length === all.length;
                selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
            }
        }

        function submitBulk(action) {
            const checked = selectedIds();
            if (checked.length === 0) return;

            if (action === 'delete' && !confirm('Delete ' + checked.length + ' selected program(s)? This cannot be undone.')) {
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("dashboard.programs.bulk") }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            checked.forEach(function (id) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }

        document.querySelectorAll('.bulk-action').forEach(function (button) {
            button.addEventListener('click', function () {
                submitBulk(this.dataset.bulkAction);
            });
        });

        document.querySelectorAll('.enquiry-toggle').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const label = this.closest('label').querySelector('.enquiry-label');
                fetch(this.dataset.url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            checkbox.checked = data.allows_enquiry;
                            if (label) {
                                label.textContent = data.allows_enquiry ? 'Collecting' : 'Running';
                                label.classList.toggle('text-sky-700', data.allows_enquiry);
                                label.classList.toggle('text-emerald-700', !data.allows_enquiry);
                            }
                        }
                    })
                    .catch(() => {
                        checkbox.checked = !checkbox.checked;
                        alert('Could not update enquiry setting. Please try again.');
                    });
            });
        });

    </script>
@endsection
