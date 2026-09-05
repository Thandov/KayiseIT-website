@extends('admin.dashboard.layout')

@section('page-title', $person->full_name)

@section('content')
    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
        @endif

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('dashboard.people') }}" class="text-kb-600 hover:text-kb-800">&larr; Back to People</a>
            <div class="space-x-3">
                @if($person->isEnquiry())
                    <a href="{{ route('dashboard.people.edit', $person) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">Edit</a>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ $person->full_name }}</h2>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $person->isApplication() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $person->record_type_label }}
                    </span>
                    @if($person->isApplication())
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $person->status === 'accepted' ? 'bg-green-100 text-green-800' : ($person->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $person->status_label ?? 'Pending' }}
                        </span>
                    @endif
                </div>
            </div>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->id_number }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Cellphone</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->cellphone ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Program</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->program?->name ?? '—' }}</dd>
                </div>

                @if($person->isEnquiry())
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->country }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Province</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->province ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Location</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($person->location_name)
                                {{ $person->location_name }} ({{ $person->location_type_label }})
                            @else
                                —
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Source</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($person->source) }}</dd>
                    </div>
                @else
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Application ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->app_id ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Age</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->age ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Application Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->app_type ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Field</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->field ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Program Partner</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->program_partner ?? '—' }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->address ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">High School</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->high_school ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Year of Completion</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->year_of_completion ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Qualification</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->qualification ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Institution</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $person->institution ?? '—' }}</dd>
                    </div>
                @endif

                @if(!empty($person->custom_fields))
                    <div class="md:col-span-2 border-t border-gray-100 pt-4 mt-2">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Additional responses</dt>
                        <dd class="mt-1 space-y-2">
                            @foreach($person->custom_fields as $key => $value)
                                @php $label = \App\Support\ProgramFormFields::definition($key)['label'] ?? ucwords(str_replace('_', ' ', $key)); @endphp
                                <div>
                                    <span class="text-xs font-semibold text-gray-500">{{ $label }}</span>
                                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $value }}</p>
                                </div>
                            @endforeach
                        </dd>
                    </div>
                @endif

                <div>
                    <dt class="text-sm font-medium text-gray-500">Registered</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $person->created_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        @if($person->isApplication())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Supporting Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach([
                        'cv' => ['label' => 'Curriculum Vitae', 'field' => 'cv_path'],
                        'id_copy' => ['label' => 'ID Copy', 'field' => 'id_copy_path'],
                        'qualification_copy' => ['label' => 'Qualification', 'field' => 'qualification_copy_path'],
                        'proof_of_payment' => ['label' => 'Proof of Payment', 'field' => 'proof_of_payment_path'],
                    ] as $type => $doc)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-2">{{ $doc['label'] }}</h4>
                            @if($person->{$doc['field']})
                                <a href="{{ route('dashboard.people.download', [$person, $type]) }}"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                    Download
                                </a>
                            @else
                                <span class="text-gray-500 text-sm">Not uploaded</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            @if($person->admin_message)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Admin Response</h3>
                    <p class="text-sm text-gray-700">{{ $person->admin_message }}</p>
                    @if($person->responded_at)
                        <p class="text-xs text-gray-500 mt-2">Responded {{ $person->responded_at->format('M d, Y H:i') }}</p>
                    @endif
                </div>
            @endif

            @if($person->status === 'pending')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <form action="{{ route('dashboard.people.accept', $person) }}" method="POST" class="border border-green-200 rounded-lg p-4 bg-green-50">
                        @csrf
                        <h3 class="font-semibold text-green-900 mb-3">Accept Application</h3>
                        <textarea name="admin_message" rows="4" required placeholder="Message to send to applicant..."
                                  class="w-full rounded-md border-gray-300 shadow-sm mb-3"></textarea>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">Accept &amp; Send Email</button>
                    </form>

                    <form action="{{ route('dashboard.people.reject', $person) }}" method="POST" class="border border-red-200 rounded-lg p-4 bg-red-50">
                        @csrf
                        <h3 class="font-semibold text-red-900 mb-3">Reject Application</h3>
                        <textarea name="admin_message" rows="4" required placeholder="Message to send to applicant..."
                                  class="w-full rounded-md border-gray-300 shadow-sm mb-3"></textarea>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">Reject &amp; Send Email</button>
                    </form>
                </div>
            @endif
        @endif
    </div>
@endsection
