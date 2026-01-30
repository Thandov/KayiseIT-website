@extends('admin.dashboard.layout')

@section('page-title', 'Invoices')

@section('content')
    <div class="p-6">
        @include('admin.invoices')
    </div>
@endsection
