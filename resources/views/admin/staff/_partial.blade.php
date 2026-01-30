@if (!empty($employees))
@foreach ($employees as $employee)
<x-team-card linking="/dashboard/staff/{{$employee->first_name}}" name="{{$employee->first_name}}" surname="{{$employee->last_name}}" position="Employee" image="{{$employee->profile_picture}}" />
@endforeach
@endif