<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Application Details</h1>
                <div class="flex items-center gap-2">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'accepted' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                        $badgeClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $badgeClass }}">
                        {{ ucfirst($application->status ?? 'pending') }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div><strong>Name:</strong> {{ $application->name ?? 'N/A' }}</div>
                <div><strong>Email:</strong> {{ $application->email ?? 'N/A' }}</div>
                <div><strong>ID Number:</strong> {{ $application->id_no ?? 'N/A' }}</div>
                <div><strong>Age:</strong> {{ $application->age ?? 'N/A' }}</div>
                <div><strong>Application Type:</strong> {{ $application->app_type ?? 'N/A' }}</div>
                <div><strong>Programme:</strong> {{ $application->internshipProgram->name ?? 'N/A' }}</div>
                <div><strong>Field:</strong> {{ $application->field ?? 'N/A' }}</div>
                <div><strong>Program Partner:</strong> {{ $application->program_partner ?? 'N/A' }}</div>
                <div><strong>Applied On:</strong> {{ $application->created_at->format('M d, Y H:i') ?? 'N/A' }}</div>
                <div class="md:col-span-2"><strong>Address:</strong> {{ $application->address ?? 'N/A' }}</div>
            </div>

            <hr class="my-6">

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Supporting Documents</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- CV Download --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ __('Curriculum Vitae') }}</h3>
                        @if($application->cv_path)
                            <a href="{{ route('download.internship.docs', ['id' => $application->id, 'type' => 'cv']) }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-download mr-1"></i> {{ __('Download') }}
                            </a>
                        @else
                            <span class="text-gray-500 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>

                    {{-- ID Copy Download --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ __('ID Copy') }}</h3>
                        @if($application->id_copy_path)
                            <a href="{{ route('download.internship.docs', ['id' => $application->id, 'type' => 'id_copy']) }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-download mr-1"></i> {{ __('Download') }}
                            </a>
                        @else
                            <span class="text-gray-500 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>

                    {{-- Qualification Copy Download --}}
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ __('Qualification') }}</h3>
                        @if($application->qualification_copy_path)
                            <a href="{{ route('download.internship.docs', ['id' => $application->id, 'type' => 'qualification_copy']) }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                <i class="fas fa-download mr-1"></i> {{ __('Download') }}
                            </a>
                        @else
                            <span class="text-gray-500 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Display Admin Response if already responded --}}
            @if($application->responded_at)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Admin Response') }}</h3>
                    <p class="text-sm text-gray-600 mb-3">
                        <strong>{{ __('Responded on:') }}</strong> {{ $application->responded_at->format('M d, Y H:i') }}
                    </p>
                    <div class="bg-white border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-gray-800">{{ $application->admin_message }}</p>
                    </div>
                </div>
            @endif

            {{-- Accept/Reject Forms (only show if status is pending) --}}
            @if($application->status === 'pending')
                <hr class="my-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Application Action') }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Accept Form --}}
                    <form action="{{ route('dashboard.applications.accept', $application->id) }}" method="POST" class="border border-green-200 rounded-lg p-4 bg-green-50">
                        @csrf
                        <h3 class="text-lg font-semibold text-green-900 mb-3">{{ __('Accept Application') }}</h3>
                        <div class="mb-4">
                            <label for="accept_message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Message to Applicant') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea name="admin_message" id="accept_message" rows="4" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                      placeholder="{{ __('Enter an acceptance message...') }}"
                                      required></textarea>
                            @error('admin_message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            {{ __('Accept & Send Email') }}
                        </button>
                    </form>

                    {{-- Reject Form --}}
                    <form action="{{ route('dashboard.applications.reject', $application->id) }}" method="POST" class="border border-red-200 rounded-lg p-4 bg-red-50">
                        @csrf
                        <h3 class="text-lg font-semibold text-red-900 mb-3">{{ __('Reject Application') }}</h3>
                        <div class="mb-4">
                            <label for="reject_message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Message to Applicant') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea name="admin_message" id="reject_message" rows="4" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                      placeholder="{{ __('Enter a rejection message...') }}"
                                      required></textarea>
                            @error('admin_message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            {{ __('Reject & Send Email') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                    <p class="text-gray-700">
                        {{ __('This application has already been') }}: <strong>{{ ucfirst($application->status) }}</strong>
                    </p>
                </div>
            @endif
        </div>

        {{-- Back Link --}}
        <div class="mb-4">
            <a href="{{ route('dashboard.applications') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i> {{ __('Back to Applications') }}
            </a>
        </div>
    </div>
</x-app-layout>