@extends('admin.dashboard.layout')

@section('page-title', 'Staff Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/organogram.css') }}">
@endpush

@section('content')
    <div class="ki-page">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="ki-toolbar ki-panel">
            <div class="ki-toolbar-start">
                <div class="min-w-0">
                    <h1 class="text-2xl font-bold text-gray-900">Staff Dashboard</h1>
                    <p class="text-sm text-gray-600">
                        @if(!empty($isAdmin))
                            Manage your team members and reporting structure
                        @else
                            Team organogram and sales leaderboard
                        @endif
                    </p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                <div class="inline-flex items-center gap-2 p-1 rounded-lg bg-slate-100" role="tablist" aria-label="Staff views">
                    @if(!empty($isAdmin))
                    <button type="button" id="staffTabList" class="staff-tab-btn is-active" role="tab" aria-selected="true" data-staff-tab="list">
                        List
                    </button>
                    @endif
                    <button type="button" id="staffTabOrganogram" class="staff-tab-btn {{ empty($isAdmin) ? 'is-active' : '' }}" role="tab" aria-selected="{{ empty($isAdmin) ? 'true' : 'false' }}" data-staff-tab="organogram">
                        Organogram
                    </button>
                    <button type="button" id="staffTabLeaderboard" class="staff-tab-btn" role="tab" aria-selected="false" data-staff-tab="leaderboard">
                        Sales Leaderboard
                    </button>
                </div>
                @if(!empty($isAdmin))
                <button type="button" onclick="openInviteModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-kb-100 rounded-md font-semibold text-xs text-kb-100 uppercase tracking-widest hover:bg-kb-50 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Email registration link
                </button>
                <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-200 focus:bg-kb-200 active:bg-kb-300 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Staff
                </button>
                @endif
            </div>
        </div>

        @if(!empty($isAdmin))
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="ki-panel">
                <div class="ki-cluster">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-500">Total Staff</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="ki-panel">
                <div class="ki-cluster">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-500">Active</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="ki-panel">
                <div class="ki-cluster">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-500">Provinces</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->pluck('province')->unique()->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="ki-panel">
                <div class="ki-cluster">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-500">Verified</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $employees->where('id_verifi_doc', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="staffPanelList" class="ki-panel !p-0 overflow-hidden" role="tabpanel">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">All Staff Members</h2>
            </div>

            @if($employees->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 ki-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                            </th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Province</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Number</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account</th>
                            <th scope="col" class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap">
                                <input type="checkbox" value="{{ $employee->id }}" class="staff-checkbox rounded border-gray-300 text-kb-100 focus:ring-kb-100">
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="ki-cluster">
                                    @if($employee->photo_url)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $employee->photo_url }}" alt="{{ $employee->first_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-kb-50 flex items-center justify-center">
                                            <span class="text-kb-100 font-medium">{{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name ?? '', 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-gray-900">{{ $employee->first_name }} {{ $employee->last_name ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->job_title ?: '—' }}</div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->email ?? 'N/A' }}</div>
                                @if($employee->personal_email)
                                    <div class="text-xs text-gray-500">{{ $employee->personal_email }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->phone ?? 'N/A' }}</div>
                            </td>
                            <td class="whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $employee->province ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $employee->ID_number ?? 'N/A' }}</div>
                            </td>
                            <td class="whitespace-nowrap">
                                @if(!$employee->user)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-700">No login</span>
                                @elseif($employee->user->email_verified_at)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">Pending</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium">
                                <div class="ki-table-actions">
                                    <a href="{{ route('dashboard.staff.view', $employee->id) }}" class="text-kb-100 hover:text-kb-200">View</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('dashboard.staff.view', $employee->id) }}" class="text-kg-700 hover:text-kg-600">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <button type="button" data-staff-id="{{ $employee->id }}" class="delete-staff-btn text-red-600 hover:text-red-900">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-3">
                <div class="ki-cluster">
                    <span id="staffSelectedCount" class="text-sm text-gray-500">0 selected</span>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <span>Send to</span>
                        <select id="staffBulkDelivery" class="rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100">
                            <option value="work">Work email</option>
                            <option value="personal">Personal email</option>
                        </select>
                    </label>
                    <button type="button" data-staff-bulk="activate" class="staff-bulk-action inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Email activation
                    </button>
                    <button type="button" data-staff-bulk="reset" class="staff-bulk-action inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Password reset
                    </button>
                    <button type="button" data-staff-bulk="delete" class="staff-bulk-action inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Delete selected
                    </button>
                </div>
                <div class="ki-cluster">
                    <p class="text-sm text-gray-700">Showing <span class="font-medium">{{ $employees->firstItem() }}</span> to <span class="font-medium">{{ $employees->lastItem() }}</span> of <span class="font-medium">{{ $employees->total() }}</span> staff</p>
                    <div>
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No staff members</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding a new team member.</p>
                <div class="mt-6">
                    <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Staff
                    </button>
                </div>
            </div>
            @endif
        </div>
        @endif

        <div id="staffPanelOrganogram" class="ki-panel {{ !empty($isAdmin) ? 'hidden' : '' }}" role="tabpanel" @if(!empty($isAdmin)) hidden @endif>
            <div class="organogram-shell">
                <div class="ki-toolbar">
                    <div class="ki-toolbar-start">
                        <div class="min-w-0">
                            <h2 class="text-lg font-semibold text-gray-900">Organogram</h2>
                            <p class="organogram-hint" id="organogramHint">
                                @if(!empty($isAdmin))
                                    Click a person, then click their new manager. Use “Make top-level” to clear a manager. Zoom and pan the chart as needed.
                                @else
                                    Reporting structure for the team (view only). Zoom and pan to explore.
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="ki-toolbar-end">
                        <button type="button" id="organogramFitBtn" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-xs font-semibold uppercase tracking-widest text-gray-700 bg-white hover:bg-gray-50">
                            Fit
                        </button>
                        <button type="button" id="organogramExpandBtn" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-xs font-semibold uppercase tracking-widest text-gray-700 bg-white hover:bg-gray-50">
                            Expand all
                        </button>
                        @if(!empty($isAdmin))
                        <button type="button" id="organogramPromoteBtn" class="inline-flex items-center px-3 py-2 border border-kb-100 rounded-md text-xs font-semibold uppercase tracking-widest text-kb-100 bg-white hover:bg-kb-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Make top-level
                        </button>
                        @endif
                        <span id="organogramStatus" class="organogram-saving" aria-live="polite"></span>
                    </div>
                </div>

                <div id="organogramEmpty" class="organogram-empty hidden">No staff members yet. Add staff to build the organogram.</div>
                <div id="organogramChart" class="organogram-chart" aria-label="Staff organogram chart"></div>
            </div>
        </div>

        <div id="staffPanelLeaderboard" class="ki-panel !p-0 overflow-hidden hidden" role="tabpanel" hidden>
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="ki-toolbar">
                    <div class="ki-toolbar-start min-w-0">
                        <h2 class="text-lg font-semibold text-gray-900">Sales Leaderboard</h2>
                        <p class="text-sm text-gray-500">Financial year {{ $fy['label'] ?? '' }}. Totals only — commission is never shown here.</p>
                    </div>
                </div>
            </div>

            @if(!empty($isAdmin))
            <div class="px-6 py-4 border-b border-gray-100 bg-slate-50">
                <form method="POST" action="{{ route('dashboard.staff.sales.store') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
                    @csrf
                    <div class="lg:col-span-2">
                        <label for="sale_employee_id" class="block text-xs font-medium text-gray-600 mb-1">Staff member</label>
                        <select id="sale_employee_id" name="employee_id" required class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100">
                            <option value="">Select staff…</option>
                            @foreach($salesEmployees as $saleEmployee)
                                <option value="{{ $saleEmployee->id }}">{{ $saleEmployee->full_name }}@if($saleEmployee->job_title) — {{ $saleEmployee->job_title }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sale_amount" class="block text-xs font-medium text-gray-600 mb-1">Sale amount (R)</label>
                        <input id="sale_amount" type="number" step="0.01" min="0" name="amount" required class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100" placeholder="0.00">
                    </div>
                    <div>
                        <label for="sale_commission" class="block text-xs font-medium text-gray-600 mb-1">Commission (private)</label>
                        <input id="sale_commission" type="number" step="0.01" min="0" name="commission" class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100" placeholder="Optional">
                    </div>
                    <div>
                        <label for="sale_date" class="block text-xs font-medium text-gray-600 mb-1">Sale date</label>
                        <input id="sale_date" type="date" name="sale_date" required value="{{ now()->toDateString() }}" class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100">
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                            Record sale
                        </button>
                    </div>
                    <div class="md:col-span-2 lg:col-span-6 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label for="sale_client_id" class="block text-xs font-medium text-gray-600 mb-1">Lead or client</label>
                            <select id="sale_client_id" name="client_id" class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100">
                                <option value="">Select… or type a name</option>
                                @php $salePeople = $salePeople ?? collect(); @endphp
                                @if($salePeople->where('status', 'lead')->isNotEmpty())
                                    <optgroup label="Leads">
                                        @foreach($salePeople->where('status', 'lead') as $person)
                                            <option value="{{ $person->id }}">{{ $person->displayName() }}@if($person->email) — {{ $person->email }}@endif</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                @if($salePeople->where('status', 'client')->isNotEmpty())
                                    <optgroup label="Clients">
                                        @foreach($salePeople->where('status', 'client') as $person)
                                            <option value="{{ $person->id }}">{{ $person->displayName() }}@if($person->email) — {{ $person->email }}@endif</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="sale_client" class="block text-xs font-medium text-gray-600 mb-1">Name if not listed</label>
                            <input id="sale_client" type="text" name="client_name" class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100" placeholder="Creates or converts this person">
                        </div>
                        <div class="md:col-span-2">
                            <label for="sale_notes" class="block text-xs font-medium text-gray-600 mb-1">Notes (optional)</label>
                            <input id="sale_notes" type="text" name="notes" class="w-full rounded-md border-gray-300 text-sm focus:border-kb-100 focus:ring-kb-100" placeholder="Deal reference">
                        </div>
                    </div>
                </form>
            </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 ki-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total sales</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($salesLeaderboard as $row)
                            @php
                                $isMe = !empty($currentEmployee) && (int) $currentEmployee->id === (int) $row->employee_id;
                            @endphp
                            <tr class="{{ $isMe ? 'bg-kg-50' : '' }}">
                                <td class="whitespace-nowrap text-sm font-semibold text-gray-900">#{{ $row->rank }}</td>
                                <td class="whitespace-nowrap">
                                    <div class="ki-cluster">
                                        @if($row->profile_picture_url)
                                            <img src="{{ $row->profile_picture_url }}" alt="" class="h-8 w-8 rounded-full object-cover">
                                        @else
                                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-xs font-semibold text-slate-700">{{ $row->initials }}</span>
                                        @endif
                                        <div class="min-w-0">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $row->full_name }}
                                                @if($isMe)<span class="text-xs font-normal text-kg-700">(you)</span>@endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap text-sm text-gray-600">{{ $row->job_title ?: '—' }}</td>
                                <td class="whitespace-nowrap text-sm font-semibold text-gray-900 text-right">R {{ number_format($row->total_sales, 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No staff sales recorded yet for this financial year.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="inviteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Email registration link</h3>
                <button type="button" onclick="closeInviteModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <p class="text-sm text-gray-600 mb-4">Add one or more email addresses. Each person will receive their own unique link to complete the staff registration form.</p>

            <form action="{{ route('dashboard.staff.invites') }}" method="POST" id="inviteForm">
                @csrf
                <div id="emailChipsContainer" class="min-h-[48px] flex flex-wrap items-center gap-2 p-2 border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-kb-100 focus-within:border-kb-100">
                    <input type="text" id="emailChipInput" placeholder="Type email and press Enter or comma"
                           class="flex-1 min-w-[200px] border-0 focus:ring-0 text-sm p-1"
                           autocomplete="off">
                </div>
                <p id="inviteEmailError" class="mt-2 text-sm text-red-600 hidden"></p>
                <div id="inviteHiddenInputs"></div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeInviteModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-kb-100 hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-100">
                        Send invites
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="staffModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-lg font-bold text-gray-900">Add New Staff Member</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent">
                @include('admin.dashboard.staff._form', ['employee' => null])
            </div>
        </div>
    </div>

    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@3"></script>
    <script>
        const organogramSaveUrl = @json(route('dashboard.staff.organogram'));
        const canEditOrganogram = @json(!empty($isAdmin));
        const organogramCsrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        let organogramEmployees = @json($organogramEmployees ?? []);
        let organogramSnapshot = null;
        let organogramSaveTimer = null;
        let organogramInitialized = false;
        let organogramChart = null;
        let organogramSelectedId = null;
        const ORGANOGRAM_ROOT_ID = 'root';

        document.getElementById('select-all')?.addEventListener('change', function() {
            document.querySelectorAll('.staff-checkbox').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateStaffBulkActions();
        });

        document.querySelectorAll('.staff-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateStaffBulkActions);
        });

        function syncStaffWorkEmail() {
            const firstNameInput = document.getElementById('first_name');
            const emailInput = document.getElementById('email');
            if (!firstNameInput || !emailInput) {
                return;
            }
            const local = firstNameInput.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '');
            emailInput.value = local ? local + '@kayiseit.co.za' : '';
        }

        document.getElementById('first_name')?.addEventListener('input', syncStaffWorkEmail);

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Add New Staff Member';
            const form = document.getElementById('staffForm');
            if (form) {
                form.reset();
                form.action = '{{ route("dashboard.staff.create") }}';
                syncStaffWorkEmail();
            }
            document.getElementById('staffModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('staffModal').classList.add('hidden');
        }

        const inviteEmails = new Set();

        function openInviteModal() {
            inviteEmails.clear();
            renderEmailChips();
            document.getElementById('emailChipInput').value = '';
            document.getElementById('inviteEmailError').classList.add('hidden');
            document.getElementById('inviteModal').classList.remove('hidden');
            document.getElementById('emailChipInput').focus();
        }

        function closeInviteModal() {
            document.getElementById('inviteModal').classList.add('hidden');
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function addEmailChip(email) {
            const normalized = email.trim().toLowerCase();
            if (!normalized) return;
            if (!isValidEmail(normalized)) {
                const errorEl = document.getElementById('inviteEmailError');
                errorEl.textContent = `"${email.trim()}" is not a valid email address.`;
                errorEl.classList.remove('hidden');
                return;
            }
            document.getElementById('inviteEmailError').classList.add('hidden');
            inviteEmails.add(normalized);
            renderEmailChips();
        }

        function removeEmailChip(email) {
            inviteEmails.delete(email);
            renderEmailChips();
        }

        function renderEmailChips() {
            const container = document.getElementById('emailChipsContainer');
            const input = document.getElementById('emailChipInput');
            const hiddenInputs = document.getElementById('inviteHiddenInputs');

            container.querySelectorAll('.email-chip').forEach(chip => chip.remove());

            inviteEmails.forEach(email => {
                const chip = document.createElement('span');
                chip.className = 'email-chip inline-flex items-center gap-1 px-2 py-1 rounded-md bg-kb-50 text-kb-100 text-sm';
                chip.innerHTML = `<span>${email}</span><button type="button" class="text-kb-100 hover:text-kb-200 font-bold leading-none" aria-label="Remove ${email}">&times;</button>`;
                chip.querySelector('button').addEventListener('click', () => removeEmailChip(email));
                container.insertBefore(chip, input);
            });

            hiddenInputs.innerHTML = '';
            inviteEmails.forEach(email => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'emails[]';
                hidden.value = email;
                hiddenInputs.appendChild(hidden);
            });
        }

        document.getElementById('emailChipInput')?.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                addEmailChip(this.value.replace(',', ''));
                this.value = '';
            } else if (e.key === 'Backspace' && this.value === '' && inviteEmails.size > 0) {
                removeEmailChip(Array.from(inviteEmails).pop());
            }
        });

        document.getElementById('emailChipInput')?.addEventListener('blur', function() {
            if (this.value.trim()) {
                addEmailChip(this.value);
                this.value = '';
            }
        });

        document.getElementById('inviteForm')?.addEventListener('submit', function(e) {
            const input = document.getElementById('emailChipInput');
            if (input.value.trim()) {
                addEmailChip(input.value);
                input.value = '';
            }
            if (inviteEmails.size === 0) {
                e.preventDefault();
                const errorEl = document.getElementById('inviteEmailError');
                errorEl.textContent = 'Please add at least one email address.';
                errorEl.classList.remove('hidden');
            }
        });

        document.getElementById('inviteModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeInviteModal();
        });

        function selectedStaffIds() {
            return Array.from(document.querySelectorAll('.staff-checkbox:checked')).map(cb => cb.value);
        }

        function updateStaffBulkActions() {
            const checked = selectedStaffIds();
            const countEl = document.getElementById('staffSelectedCount');
            if (countEl) {
                countEl.textContent = checked.length === 1 ? '1 selected' : checked.length + ' selected';
            }
            document.querySelectorAll('.staff-bulk-action').forEach(btn => {
                btn.disabled = checked.length === 0;
            });
            const selectAll = document.getElementById('select-all');
            const all = document.querySelectorAll('.staff-checkbox');
            if (selectAll && all.length) {
                selectAll.checked = checked.length === all.length;
                selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
            }
        }

        function submitStaffBulk(action) {
            const checked = selectedStaffIds();
            if (checked.length === 0) {
                alert('Please select at least one staff member.');
                return;
            }

            const confirms = {
                activate: 'Send account activation emails to ' + checked.length + ' staff member(s)?',
                reset: 'Send password reset emails to ' + checked.length + ' staff member(s)?',
                delete: 'Delete ' + checked.length + ' staff member(s)? This cannot be undone.'
            };
            if (!confirm(confirms[action] || 'Continue with this bulk action?')) {
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = @json(route('dashboard.staff.bulk'));

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = organogramCsrf;
            form.appendChild(csrf);

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            if (action === 'activate' || action === 'reset') {
                const deliveryInput = document.createElement('input');
                deliveryInput.type = 'hidden';
                deliveryInput.name = 'delivery';
                deliveryInput.value = document.getElementById('staffBulkDelivery')?.value || 'work';
                form.appendChild(deliveryInput);
            }

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

        function deleteStaff(staffId) {
            if (!confirm('Are you sure you want to delete this staff member? This action cannot be undone.')) {
                return;
            }
            fetch(`/dashboard/staff/delete/${staffId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': organogramCsrf,
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
            .catch(() => alert('An error occurred while deleting the staff member.'));
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-staff-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteStaff(this.getAttribute('data-staff-id'));
                });
            });
            document.querySelectorAll('.staff-bulk-action').forEach(btn => {
                btn.addEventListener('click', function() {
                    submitStaffBulk(this.getAttribute('data-staff-bulk'));
                });
            });
            updateStaffBulkActions();
        });

        document.getElementById('staffModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function setStaffTab(tab) {
            const listBtn = document.getElementById('staffTabList');
            const orgBtn = document.getElementById('staffTabOrganogram');
            const boardBtn = document.getElementById('staffTabLeaderboard');
            const listPanel = document.getElementById('staffPanelList');
            const orgPanel = document.getElementById('staffPanelOrganogram');
            const boardPanel = document.getElementById('staffPanelLeaderboard');
            const tabs = {
                list: { btn: listBtn, panel: listPanel },
                organogram: { btn: orgBtn, panel: orgPanel },
                leaderboard: { btn: boardBtn, panel: boardPanel },
            };

            if (!tabs[tab] || !tabs[tab].btn) {
                tab = listBtn ? 'list' : 'organogram';
            }

            Object.keys(tabs).forEach((key) => {
                const entry = tabs[key];
                if (!entry.btn || !entry.panel) return;
                const active = key === tab;
                entry.btn.classList.toggle('is-active', active);
                entry.btn.setAttribute('aria-selected', active ? 'true' : 'false');
                entry.panel.classList.toggle('hidden', !active);
                if (active) {
                    entry.panel.removeAttribute('hidden');
                } else {
                    entry.panel.setAttribute('hidden', 'hidden');
                }
            });

            if (tab === 'organogram') {
                initOrganogram();
            }

            try {
                localStorage.setItem('staffDashboardTab', tab);
            } catch (e) {}
        }

        document.getElementById('staffTabList')?.addEventListener('click', () => setStaffTab('list'));
        document.getElementById('staffTabOrganogram')?.addEventListener('click', () => setStaffTab('organogram'));
        document.getElementById('staffTabLeaderboard')?.addEventListener('click', () => setStaffTab('leaderboard'));

        (function bootStaffTab() {
            const params = new URLSearchParams(window.location.search);
            let tab = params.get('tab');
            if (!tab) {
                try { tab = localStorage.getItem('staffDashboardTab'); } catch (e) {}
            }
            const canList = !!document.getElementById('staffTabList');
            if (tab === 'list' && !canList) tab = 'leaderboard';
            if (!tab || !['list', 'organogram', 'leaderboard'].includes(tab)) {
                tab = canList ? 'list' : 'organogram';
            }
            setStaffTab(tab);
        })();

        function setOrganogramStatus(message, state) {
            const el = document.getElementById('organogramStatus');
            if (!el) return;
            el.textContent = message || '';
            el.classList.toggle('is-error', state === 'error');
            el.classList.toggle('is-ok', state === 'ok');
        }

        function cloneEmployees(list) {
            return JSON.parse(JSON.stringify(list));
        }

        function escapeHtml(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function getDescendantIds(employeeId, list) {
            const ids = [];
            const queue = list.filter(e => Number(e.manager_id) === Number(employeeId)).map(e => e.id);
            while (queue.length) {
                const id = queue.shift();
                if (ids.includes(id)) continue;
                ids.push(id);
                list.filter(e => Number(e.manager_id) === Number(id)).forEach(e => queue.push(e.id));
            }
            return ids;
        }

        function wouldCreateCycle(employeeId, managerId, list) {
            if (managerId === null || managerId === '' || managerId === ORGANOGRAM_ROOT_ID) return false;
            if (Number(employeeId) === Number(managerId)) return true;
            return getDescendantIds(employeeId, list).includes(Number(managerId));
        }

        function isRoot(employee) {
            return employee.manager_id === null || employee.manager_id === '' || employee.manager_id === undefined;
        }

        function childrenOf(managerId) {
            return organogramEmployees
                .filter(e => {
                    if (managerId === null || managerId === '' || managerId === ORGANOGRAM_ROOT_ID) return isRoot(e);
                    return Number(e.manager_id) === Number(managerId);
                })
                .sort((a, b) => (a.sort_order - b.sort_order) || String(a.first_name).localeCompare(String(b.first_name)));
        }

        function employeeDisplayName(employee) {
            return `${employee.first_name || ''} ${employee.last_name || ''}`.trim() || 'Staff';
        }

        function toChartData() {
            const roots = childrenOf(null);
            const ordered = [];
            const walk = (managerId) => {
                childrenOf(managerId).forEach((e) => {
                    ordered.push(e);
                    walk(e.id);
                });
            };
            walk(null);

            const people = (ordered.length ? ordered : organogramEmployees).map((e) => ({
                id: String(e.id),
                parentId: e.manager_id ? String(e.manager_id) : ORGANOGRAM_ROOT_ID,
                name: employeeDisplayName(e),
                title: e.job_title || 'No title',
                image: e.profile_picture_url || '',
                initials: e.initials || '?',
                view_url: e.view_url || '',
                isRoot: false,
            }));

            return [
                {
                    id: ORGANOGRAM_ROOT_ID,
                    parentId: '',
                    name: 'KAYISE IT',
                    title: 'Organisation',
                    image: '',
                    initials: 'KI',
                    view_url: '',
                    isRoot: true,
                },
                ...people,
            ];
        }

        function assignmentsFromEmployees() {
            const assignments = [];
            const visit = (managerId) => {
                childrenOf(managerId).forEach((e, index) => {
                    assignments.push({
                        id: e.id,
                        manager_id: managerId === null || managerId === ORGANOGRAM_ROOT_ID ? null : Number(managerId),
                        sort_order: index,
                    });
                    visit(e.id);
                });
            };
            visit(null);
            const seen = new Set(assignments.map((a) => a.id));
            organogramEmployees.forEach((e) => {
                if (!seen.has(e.id)) {
                    assignments.push({ id: e.id, manager_id: null, sort_order: 0 });
                }
            });
            return assignments;
        }

        function persistOrganogram(assignments) {
            setOrganogramStatus('Saving…');
            return fetch(organogramSaveUrl, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': organogramCsrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ assignments })
            })
            .then(async (response) => {
                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    const message = data.message
                        || (data.errors && Object.values(data.errors).flat().join(' '))
                        || 'Could not save organogram.';
                    throw new Error(message);
                }
                organogramSnapshot = cloneEmployees(organogramEmployees);
                setOrganogramStatus('Saved', 'ok');
                setTimeout(() => setOrganogramStatus(''), 2000);
            })
            .catch((err) => {
                organogramEmployees = cloneEmployees(organogramSnapshot || organogramEmployees);
                organogramSelectedId = null;
                updatePromoteButton();
                renderOrganogram();
                setOrganogramStatus(err.message || 'Save failed', 'error');
                if (window.Swal) {
                    Swal.fire({ icon: 'error', title: 'Organogram', text: err.message || 'Save failed' });
                } else {
                    alert(err.message || 'Save failed');
                }
            });
        }

        function scheduleOrganogramSave() {
            clearTimeout(organogramSaveTimer);
            organogramSaveTimer = setTimeout(() => {
                persistOrganogram(assignmentsFromEmployees());
            }, 200);
        }

        function updatePromoteButton() {
            const btn = document.getElementById('organogramPromoteBtn');
            if (!btn) return;
            const selected = organogramEmployees.find((e) => String(e.id) === String(organogramSelectedId));
            btn.disabled = !selected || isRoot(selected);
        }

        function updateOrganogramHint() {
            const hint = document.getElementById('organogramHint');
            if (!hint || !canEditOrganogram) return;
            if (!organogramSelectedId) {
                hint.textContent = 'Click a person, then click their new manager. Use “Make top-level” to clear a manager. Zoom and pan the chart as needed.';
                return;
            }
            const selected = organogramEmployees.find((e) => String(e.id) === String(organogramSelectedId));
            const name = selected ? employeeDisplayName(selected) : 'Selected person';
            hint.textContent = `${name} selected — click a manager to reassign, or use “Make top-level”. Click them again to clear selection.`;
        }

        function setManager(employeeId, managerId) {
            if (!canEditOrganogram) return;

            if (wouldCreateCycle(employeeId, managerId, organogramEmployees)) {
                setOrganogramStatus('That move would create a reporting cycle.', 'error');
                if (window.Swal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid move',
                        text: 'A person cannot report to themselves or to someone in their team.'
                    });
                }
                return;
            }

            const employee = organogramEmployees.find((e) => Number(e.id) === Number(employeeId));
            if (!employee) return;

            const previousManager = employee.manager_id;
            const nextManager = managerId === null || managerId === ORGANOGRAM_ROOT_ID ? null : Number(managerId);
            if (Number(previousManager) === Number(nextManager) || (previousManager == null && nextManager == null)) {
                organogramSelectedId = null;
                updatePromoteButton();
                updateOrganogramHint();
                renderOrganogram(false);
                return;
            }

            const siblings = childrenOf(nextManager);
            employee.manager_id = nextManager;
            employee.sort_order = siblings.length;
            organogramSelectedId = null;
            updatePromoteButton();
            updateOrganogramHint();
            renderOrganogram(false);
            scheduleOrganogramSave();
        }

        function handleNodeClick(nodeId) {
            const id = String(nodeId);
            if (id === ORGANOGRAM_ROOT_ID) {
                if (canEditOrganogram && organogramSelectedId) {
                    setManager(organogramSelectedId, null);
                }
                return;
            }

            if (!canEditOrganogram) {
                return;
            }

            if (!organogramSelectedId) {
                organogramSelectedId = id;
                updatePromoteButton();
                updateOrganogramHint();
                renderOrganogram(false);
                return;
            }

            if (String(organogramSelectedId) === id) {
                organogramSelectedId = null;
                updatePromoteButton();
                updateOrganogramHint();
                renderOrganogram(false);
                return;
            }

            setManager(organogramSelectedId, id);
        }

        function nodeContent(d) {
            const data = d.data;
            const selected = String(data.id) === String(organogramSelectedId);
            const width = d.width || 240;
            const height = d.height || 88;
            const border = selected ? '2px solid #183ea4' : (data.isRoot ? '1px solid #183ea4' : '1px solid #e5e7eb');
            const bg = data.isRoot ? '#183ea4' : '#ffffff';
            const nameColor = data.isRoot ? '#ffffff' : '#0f172a';
            const titleColor = data.isRoot ? 'rgba(255,255,255,0.85)' : '#64748b';
            const shadow = selected
                ? '0 0 0 3px rgba(24,62,164,0.2)'
                : '0 1px 2px rgba(15,23,42,0.04)';

            const avatar = data.isRoot
                ? `<div style="flex-shrink:0;width:40px;height:40px;border-radius:9999px;background:rgba(255,255,255,0.18);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px;">${escapeHtml(data.initials)}</div>`
                : (data.image
                    ? `<img src="${escapeHtml(data.image)}" alt="" style="flex-shrink:0;width:40px;height:40px;border-radius:9999px;object-fit:cover;display:block;">`
                    : `<div style="flex-shrink:0;width:40px;height:40px;border-radius:9999px;background:#f0f4ff;color:#183ea4;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px;">${escapeHtml(data.initials)}</div>`);

            const editLink = !data.isRoot && canEditOrganogram && data.view_url
                ? `<a href="${escapeHtml(data.view_url)}" onclick="event.stopPropagation()" style="flex-shrink:0;color:#183ea4;font-size:12px;font-weight:600;text-decoration:none;">Edit</a>`
                : '';

            return `
                <div style="box-sizing:border-box;width:${width}px;height:${height}px;padding:12px;display:flex;align-items:center;gap:12px;background:${bg};border:${border};border-radius:12px;box-shadow:${shadow};overflow:hidden;">
                    ${avatar}
                    <div style="min-width:0;flex:1;">
                        <div style="font-size:14px;font-weight:600;color:${nameColor};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.25;">${escapeHtml(data.name)}</div>
                        <div style="font-size:12px;color:${titleColor};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.25;margin-top:2px;">${escapeHtml(data.title)}</div>
                    </div>
                    ${editLink}
                </div>
            `;
        }

        function ensureOrganogramChart() {
            if (organogramChart) return organogramChart;
            const OrgChartCtor = (typeof d3 !== 'undefined' && d3.OrgChart) || window.OrgChart;
            if (!OrgChartCtor) {
                setOrganogramStatus('Chart library failed to load.', 'error');
                return null;
            }

            const container = document.getElementById('organogramChart');
            organogramChart = new OrgChartCtor()
                .container(container)
                .svgHeight(Math.max(container?.clientHeight || 520, 480))
                .nodeId((d) => d.id)
                .parentNodeId((d) => d.parentId || null)
                .compact(false)
                .layout('top')
                .nodeWidth(() => 240)
                .nodeHeight(() => 88)
                .childrenMargin(() => 56)
                .siblingsMargin(() => 24)
                .neighbourMargin(() => 32)
                .compactMarginBetween(() => 24)
                .compactMarginPair(() => 40)
                .initialExpandLevel(99)
                .nodeContent(nodeContent)
                .onNodeClick((node) => {
                    const id = node && typeof node === 'object'
                        ? (node.data?.id ?? node.id)
                        : node;
                    handleNodeClick(id);
                });

            return organogramChart;
        }

        function renderOrganogram(fit = true) {
            const empty = document.getElementById('organogramEmpty');
            const chartEl = document.getElementById('organogramChart');
            if (!organogramEmployees.length) {
                empty?.classList.remove('hidden');
                chartEl?.classList.add('hidden');
                return;
            }
            empty?.classList.add('hidden');
            chartEl?.classList.remove('hidden');

            const chart = ensureOrganogramChart();
            if (!chart) return;

            const data = toChartData();
            data.forEach((d) => { d._expanded = true; });

            chart
                .svgHeight(Math.max(chartEl.clientHeight || 520, 480))
                .data(data)
                .render()
                .expandAll();

            if (fit) {
                requestAnimationFrame(() => {
                    try { chart.fit(); } catch (e) {}
                });
            }
        }

        function initOrganogram() {
            if (!organogramInitialized) {
                organogramSnapshot = cloneEmployees(organogramEmployees);
                organogramInitialized = true;
                document.getElementById('organogramFitBtn')?.addEventListener('click', () => {
                    try { organogramChart?.fit(); } catch (e) {}
                });
                document.getElementById('organogramExpandBtn')?.addEventListener('click', () => {
                    try {
                        const data = organogramChart?.data() || [];
                        data.forEach((d) => { d._expanded = true; });
                        organogramChart?.data(data).render().expandAll().fit();
                    } catch (e) {}
                });
                document.getElementById('organogramPromoteBtn')?.addEventListener('click', () => {
                    if (!organogramSelectedId) return;
                    setManager(organogramSelectedId, null);
                });
            }
            updatePromoteButton();
            updateOrganogramHint();
            // Wait a tick so the panel is visible and has dimensions before fit
            requestAnimationFrame(() => renderOrganogram(true));
        }
    </script>
@endsection
