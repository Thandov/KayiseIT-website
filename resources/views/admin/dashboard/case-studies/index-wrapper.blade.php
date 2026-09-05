@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Case Studies')

@section('content')
    <div class="p-6">
        @include('admin.dashboard.case-studies.index')
    </div>
@endsection

