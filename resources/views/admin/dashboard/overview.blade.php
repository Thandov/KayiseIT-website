@extends('admin.dashboard.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Dashboard</h1>

    {{-- Sales per month — color by progress (good/bad) --}}
    <section class="mb-8">
        <h2 class="text-lg font-medium text-gray-800 mb-3">Sales per month</h2>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Leads --}}
        <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <h2 class="text-lg font-medium text-gray-800 px-4 py-3 border-b border-gray-100">Leads</h2>
            <div class="overflow-x-auto max-h-80 overflow-y-auto">
                @if($leads->isEmpty())
                    <p class="p-4 text-gray-500 text-sm">No leads yet.</p>
                @else
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Name</th>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Subject</th>
                                <th class="text-left py-2 px-4 font-medium text-gray-600">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            <tr class="border-t border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $lead->name ?? '—' }}</td>
                                <td class="py-2 px-4">{{ Str::limit($lead->subject ?? '—', 30) }}</td>
                                <td class="py-2 px-4 text-gray-500">{{ $lead->created_at ? $lead->created_at->format('d M Y') : '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>

        {{-- Staff stats --}}
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
    </div>
</div>
@endsection
