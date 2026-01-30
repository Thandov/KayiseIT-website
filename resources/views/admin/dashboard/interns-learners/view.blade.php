@extends('admin.dashboard.layout')

@section('page-title', 'View Intern/Learner')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.interns-learners') }}" class="text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Interns & Learners
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $internLearner->full_name }}</h2>
                    <p class="text-gray-600 mt-1">{{ $internLearner->email }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('dashboard.interns-learners.edit', $internLearner->id) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->full_name }}</dd>
                        </div>
                        @if($internLearner->id_number)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">ID Number</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->id_number }}</dd>
                        </div>
                        @endif
                        @if($internLearner->date_of_birth)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->date_of_birth->format('Y-m-d') }}</dd>
                        </div>
                        @endif
                        @if($internLearner->gender)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Gender</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->gender }}</dd>
                        </div>
                        @endif
                        @if($internLearner->phone)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->phone }}</dd>
                        </div>
                        @endif
                        @if($internLearner->address)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->address }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Program & Status -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Program & Status</h3>
                    <dl class="space-y-3">
                        @if($internLearner->program)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Program</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->program->name }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                @if($internLearner->status === 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($internLearner->status === 'completed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Terminated</span>
                                @endif
                            </dd>
                        </div>
                        @if($internLearner->start_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->start_date->format('Y-m-d') }}</dd>
                        </div>
                        @endif
                        @if($internLearner->end_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">End Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->end_date->format('Y-m-d') }}</dd>
                        </div>
                        @endif
                        @if($internLearner->internshipApplication)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Linked Application</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internLearner->internshipApplication->app_id }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                @if($internLearner->notes)
                <div class="md:col-span-2 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Notes</h3>
                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $internLearner->notes }}</p>
                </div>
                @endif

                @if($internLearner->mictBeneficiary)
                <div class="md:col-span-2 bg-blue-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">MICT SETA Beneficiary Information</h3>
                    <p class="text-sm text-gray-600">This intern/learner has MICT SETA beneficiary data associated.</p>
                    <a href="#" class="text-kb-600 hover:text-kb-800 text-sm mt-2 inline-block">View MICT Beneficiary Details</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
