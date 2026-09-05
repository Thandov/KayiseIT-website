@extends('admin.dashboard.layout')

@section('page-title', 'View Program')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('dashboard.programs') }}" class="text-kb-600 hover:text-kb-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Programs
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $program->name }}</h2>
                    <span class="mt-2 inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                        @if($program->program_type === 'Internship') bg-blue-100 text-blue-800
                        @elseif($program->program_type === 'TVET Placement') bg-green-100 text-green-800
                        @else bg-purple-100 text-purple-800
                        @endif">
                        {{ $program->program_type }}
                    </span>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('dashboard.programs.edit', $program->id) }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Program Details</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $program->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Duration</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $program->duration }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Number Needed</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $program->number_needed }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Recruitment Period</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $program->recruitment_start_date->format('M d, Y') }} - {{ $program->recruitment_end_date->format('M d, Y') }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                @if($program->is_active)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @endif
                            </dd>
                        </div>
                        @if($program->partner)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Partner</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $program->partner->name }}
                                @if($program->partner->partner_type)
                                <span class="ml-2 text-xs text-gray-500">({{ $program->partner->partner_type }})</span>
                                @endif
                            </dd>
                        </div>
                        @if($program->isMictPartner())
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data Source</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">MICT Beneficiaries Table</span>
                                <p class="text-xs text-gray-500 mt-1">This program uses the MICT beneficiaries table for data management.</p>
                            </dd>
                        </div>
                        @endif
                        @endif
                    </dl>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h3>
                    <dl class="space-y-3">
                        @if($program->has_stipend)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Stipend</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $program->stipend_currency }} {{ number_format($program->stipend_amount, 2) }}
                            </dd>
                        </div>
                        @endif
                        @if($program->has_accreditation)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Accreditation</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $program->accreditation_details ?? 'Yes' }}</dd>
                        </div>
                        @endif
                        @if($program->youth_beneficiaries)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Youth Beneficiaries</dt>
                            <dd class="mt-1 text-sm text-gray-900">Yes</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <div class="md:col-span-2 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Requirements</h3>
                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $program->requirements }}</p>
                </div>

                <div class="md:col-span-2 bg-indigo-50 rounded-lg p-4 border border-indigo-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Applicant form fields</h3>
                    @php
                        $formFields = collect($program->getFormFieldKeys())->map(function ($key) {
                            $def = \App\Support\ProgramFormFields::definition($key);
                            return $def['label'] ?? $key;
                        });
                    @endphp
                    @if($formFields->isEmpty())
                        <p class="text-sm text-gray-600">No custom applicant fields configured yet.</p>
                    @else
                        <div class="flex flex-wrap gap-2">
                            @foreach($formFields as $label)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-white text-indigo-800 border border-indigo-200">{{ $label }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
