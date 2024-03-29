<x-app-layout title="Staff Dashboard">

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="/admin/admin_dashboard" class="ml-1 text-sm font-medium inline-flex">
                                    <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Dashboard</a>
                            </li>

                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">The A Team</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <i class="fas fa-cogs text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">The Team</h3>
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">All our members.</p>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="ml-auto">
                            <x-front-end-btn linking="{{ route('admin.staff.newstaff') }}" color="blue" showme="add-service-btn" name="Add Member" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-4 gap-4">
                        @foreach ($employees as $employee)
                        <x-team-card linking="/admin/staff/viewstaff/{{$employee->user_id}}" name="{{$employee->first_name}}" surname="{{$employee->last_name}}" position="Employee" image="{{$employee->profile_picture}}" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>