@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Career Mapping')

@section('content')
    <div class="p-6">
        @include('admin.dashboard.careermapping._tabs', ['active' => 'occupations'])
        @include('admin.dashboard.careermapping_dashboard')
    </div>
@endsection









