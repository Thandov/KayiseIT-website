@extends('admin.dashboard.layout')

@section('page-title', 'Blogs')

@section('content')
    <div class="p-6">
        @include('admin.blogs')
    </div>
@endsection
