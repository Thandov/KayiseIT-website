@extends('admin.dashboard.layout')

@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 mt-0">Dashboard Overview</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    @include('admin.dashboard.sales._salestats')
                </div>
                <div>
                    @include('admin.dashboard.clients._clientspanel')
                </div>
            </div>
        </div>
    </div>
@endsection
