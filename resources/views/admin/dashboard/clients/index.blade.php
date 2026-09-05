@extends('admin.dashboard.layout')

@section('page-title', 'Clients')

@section('content')
@php
    $status = $status ?? 'all';
    $leadCount = $leadCount ?? 0;
    $clientCount = $clientCount ?? 0;
    $totalCount = $leadCount + $clientCount;
@endphp
<div class="ki-page">
    <div class="ki-toolbar ki-panel">
        <div class="ki-toolbar-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 m-0">Clients</h1>
                <p class="mt-2 text-sm text-gray-600 m-0">Leads and clients are the same record. A sale flips the badge to Client.</p>
            </div>
        </div>
        <div class="ki-toolbar-end">
            <button type="button" onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-kb-100 text-white text-sm font-semibold rounded-md hover:bg-kb-200">
                Add
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="ki-panel bg-green-50 border border-green-200 text-green-800 text-sm" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="ki-panel bg-red-50 border border-red-200 text-red-800 text-sm" role="alert">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="ki-panel">
            <p class="text-sm text-gray-500 m-0">Total</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2 m-0">{{ $totalCount }}</p>
        </div>
        <div class="ki-panel">
            <p class="text-sm text-gray-500 m-0">Leads</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2 m-0">{{ $leadCount }}</p>
        </div>
        <div class="ki-panel">
            <p class="text-sm text-gray-500 m-0">Clients</p>
            <p class="text-2xl font-semibold text-gray-900 mt-2 m-0">{{ $clientCount }}</p>
        </div>
    </div>

    <div class="ki-toolbar" role="tablist">
        <a href="{{ route('dashboard.clients', ['status' => 'all']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'all' ? 'bg-kb-100 text-white' : 'bg-white border border-gray-300 text-gray-700' }}">All</a>
        <a href="{{ route('dashboard.clients', ['status' => 'lead']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'lead' ? 'bg-kb-100 text-white' : 'bg-white border border-gray-300 text-gray-700' }}">Leads</a>
        <a href="{{ route('dashboard.clients', ['status' => 'client']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md {{ $status === 'client' ? 'bg-kb-100 text-white' : 'bg-white border border-gray-300 text-gray-700' }}">Clients</a>
    </div>

    <div class="ki-panel" style="padding: 0;">
        @if($clients->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 ki-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                            </th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inquiry</th>
                            <th scope="col" class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($clients as $person)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $person->id }}" class="client-checkbox rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                                </td>
                                <td>
                                    <div class="text-sm font-medium text-gray-900">{{ $person->displayName() }}</div>
                                    @if($person->phone)
                                        <div class="text-xs text-gray-500">{{ $person->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($person->isConvertedClient())
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Client</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Lead</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-700">{{ $person->email ?? '—' }}</td>
                                <td class="text-sm text-gray-700">{{ $person->company ?: '—' }}</td>
                                <td class="text-sm text-gray-500">{{ $person->inquiry_subject ? \Illuminate\Support\Str::limit($person->inquiry_subject, 40) : '—' }}</td>
                                <td>
                                    <div class="ki-table-actions justify-end">
                                        <a href="{{ route('dashboard.clients.viewclient', $person->id) }}" class="text-sm text-kb-100 hover:text-kb-200">View</a>
                                        <button type="button" data-client-id="{{ $person->id }}" class="edit-client-btn text-sm text-gray-600 hover:text-gray-900">Edit</button>
                                        <button type="button" data-client-id="{{ $person->id }}" class="delete-client-btn text-sm text-red-600 hover:text-red-800">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ki-toolbar" style="padding: var(--ki-space-card);">
                <button type="button" onclick="deleteSelected()" class="px-4 py-2 text-sm rounded-md border border-red-200 text-red-600">Delete selected</button>
                <p class="text-sm text-gray-500 m-0">{{ $clients->count() }} shown</p>
            </div>
        @else
            <div class="p-6 text-sm text-gray-500">No records yet. Add one, or wait for a contact form inquiry.</div>
        @endif
    </div>
</div>

<div id="clientModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="ki-toolbar mb-4">
            <h3 id="modalTitle" class="text-lg font-bold text-gray-900 m-0">Add</h3>
            <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <span class="sr-only">Close</span>
                &times;
            </button>
        </div>
        <div id="modalContent">
            @include('admin.dashboard.clients._form', ['client' => null])
        </div>
    </div>
</div>

<script>
    document.getElementById('select-all')?.addEventListener('change', function() {
        document.querySelectorAll('.client-checkbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    function openCreateModal() {
        document.getElementById('modalTitle').textContent = 'Add lead or client';
        const form = document.getElementById('clientForm');
        if (form) {
            form.reset();
            form.action = '{{ route("admin.dashboard.clients.create") }}';
        }
        document.getElementById('clientModal').classList.remove('hidden');
    }

    function openEditModal(clientId) {
        window.location.href = '{{ url("/dashboard/clients/viewclient") }}/' + clientId;
    }

    function closeModal() {
        document.getElementById('clientModal').classList.add('hidden');
    }

    function deleteClient(clientId) {
        if (!confirm('Delete this record?')) {
            return;
        }
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ url("/dashboard/clients/delete") }}/' + clientId;
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
        document.body.appendChild(form);
        form.submit();
    }

    function deleteSelected() {
        const selected = document.querySelectorAll('.client-checkbox:checked');
        if (selected.length === 0) {
            alert('Select at least one record.');
            return;
        }
        if (!confirm('Delete ' + selected.length + ' record(s)?')) {
            return;
        }
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.dashboard.clients.deleteSelected") }}';
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
        ids.value = JSON.stringify(Array.from(selected).map(cb => cb.value));
        form.appendChild(ids);
        document.body.appendChild(form);
        form.submit();
    }

    document.getElementById('clientModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-client-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                openEditModal(this.getAttribute('data-client-id'));
            });
        });
        document.querySelectorAll('.delete-client-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                deleteClient(this.getAttribute('data-client-id'));
            });
        });
    });
</script>
@endsection
