@extends('admin.dashboard.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="ki-page max-w-6xl mx-auto">
    <div class="ki-toolbar">
        <div class="ki-toolbar-start min-w-0">
            <h1 class="text-2xl font-semibold text-gray-900">
                @if(!empty($isStaffView) && $employee)
                    Hi {{ $employee->first_name }}, your dashboard
                @else
                    Dashboard
                @endif
            </h1>
            @if(!empty($isStaffView))
                <p class="text-sm text-gray-500">Your sales for the financial year. Peers only see totals on the leaderboard — never commission.</p>
            @endif
        </div>
        @if(!empty($isStaffView) || !empty($isAdmin))
            <div class="ki-toolbar-end">
                <a href="{{ route('admin.dashboard.staff', ['tab' => 'leaderboard']) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-200 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2 transition ease-in-out duration-150">
                    Sales leaderboard
                </a>
            </div>
        @endif
    </div>

    @if(!empty($isStaffView))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="ki-panel">
                <p class="text-sm font-medium text-gray-500">Sales this month</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">R {{ number_format($mySalesThisMonth ?? 0, 0) }}</p>
            </div>
            <div class="ki-panel">
                <p class="text-sm font-medium text-gray-500">Your FY total</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">R {{ number_format($mySalesFyTotal ?? 0, 0) }}</p>
            </div>
            <div class="ki-panel">
                <p class="text-sm font-medium text-gray-500">Your rank</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $myRank ? '#'.$myRank : '—' }}</p>
                <p class="text-xs text-gray-500 mt-1">Your commission this FY: R {{ number_format($myCommissionFy ?? 0, 0) }} (only you see this)</p>
            </div>
        </div>
    @endif

    {{-- Sales per month — color by progress (good/bad) --}}
    <section class="ki-stack">
        <div>
            <h2 class="text-lg font-medium text-gray-800">
                @if(!empty($isStaffView))
                    Your sales per month
                @else
                    Sales per month
                @endif
            </h2>
            <p class="text-sm text-gray-500">Financial year: {{ $financialYearLabel }}</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($salesByMonth as $row)
            @php
                $bg = 'bg-gray-100';
                $border = 'border-gray-200';
                if ($row['trend'] === 'up') {
                    $bg = 'bg-green-50';
                    $border = 'border-green-200';
                } elseif ($row['trend'] === 'down') {
                    $bg = 'bg-red-50';
                    $border = 'border-red-200';
                }
            @endphp
            <div class="{{ $bg }} border {{ $border }} rounded-lg p-3">
                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">{{ $row['label'] }}</div>
                <div class="text-lg font-semibold text-gray-900 mt-0.5">R {{ number_format($row['total'], 0) }}</div>
                @if($row['trend'] === 'up')
                    <span class="text-xs text-green-600 font-medium">↑</span>
                @elseif($row['trend'] === 'down')
                    <span class="text-xs text-red-600 font-medium">↓</span>
                @endif
            </div>
            @endforeach
        </div>
    </section>

    @if(!empty($canClients) || !empty($isAdmin))
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @if(!empty($canClients))
        <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                <h2 class="text-lg font-medium text-gray-800 m-0">Recent leads</h2>
                <a href="{{ route('dashboard.clients', ['status' => 'lead']) }}" class="text-sm font-medium text-kb-100 hover:text-kb-200">All clients →</a>
            </div>
            <div class="overflow-x-auto max-h-80 overflow-y-auto">
                @if($inquiries->isEmpty())
                    <p class="p-4 text-gray-500 text-sm">No leads yet.</p>
                @else
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Name</th>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Inquiry</th>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $inquiry)
                            <tr class="border-t border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-4">
                                    <a href="{{ route('dashboard.clients.viewclient', $inquiry->id) }}" class="text-kb-100 hover:text-kb-200">{{ $inquiry->displayName() }}</a>
                                </td>
                                <td class="py-2 px-4">{{ \Illuminate\Support\Str::limit($inquiry->inquiry_subject ?? '—', 30) }}</td>
                                <td class="py-2 px-4 text-gray-500">{{ $inquiry->updated_at ? $inquiry->updated_at->format('d M Y') : '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
        @endif

        @if(empty($isStaffView))
        <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <h2 class="text-lg font-medium text-gray-800 px-4 py-3 border-b border-gray-100">Staff stats</h2>
            <div class="p-4 space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">Total staff</span>
                    <span class="text-2xl font-semibold text-gray-900">{{ $staffTotal }}</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <span class="text-gray-700">New this month</span>
                    <span class="text-2xl font-semibold text-gray-900">{{ $staffNewThisMonth }}</span>
                </div>
                <a href="{{ route('admin.dashboard.staff') }}" class="inline-flex items-center text-sm font-medium text-kb-100 hover:text-kb-200">
                    View staff →
                </a>
            </div>
        </section>
        @endif
    </div>
    @endif
</div>
@endsection
