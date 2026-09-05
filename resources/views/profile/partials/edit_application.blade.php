<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Application &mdash; {{ $application->app_id }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Back to profile
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-800">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($application->status !== 'pending')
            <div class="mb-6 rounded-lg bg-yellow-50 border border-yellow-200 p-4 text-sm text-yellow-800">
                This application has been <strong>{{ $application->status }}</strong>. You can still update your details, but the decision has already been made.
            </div>
        @endif

        <form method="POST" action="{{ route('user.applications.update', $application->id) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- ── Personal Details ── --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Personal Details</h3>
                <p class="text-sm text-gray-500 mb-5">Your basic information attached to this application.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Full name</label>
                        <input type="text" value="{{ $application->name }}" disabled
                               class="w-full px-3 py-2 border border-gray-200 rounded-md bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                        <p class="text-xs text-gray-400 mt-1">Linked to your account — update it in Settings.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Email</label>
                        <input type="text" value="{{ $application->email }}" disabled
                               class="w-full px-3 py-2 border border-gray-200 rounded-md bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                    </div>

                    <div>
                        <label for="age" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Age <span class="text-red-500">*</span></label>
                        <input type="number" id="age" name="age" min="1" max="120"
                               value="{{ old('age', $application->age) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="address" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Physical Address</label>
                        <input type="text" id="address" name="address"
                               value="{{ old('address', $application->address) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            {{-- ── Application Type ── --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Application Type</h3>
                <p class="text-sm text-gray-500 mb-5">What you are applying for and your field of interest.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="app_type" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Application Type <span class="text-red-500">*</span></label>
                        <select id="app_type" name="app_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach(['Internship','Junior Position','Senior Position','Contract','Freelance','Short Programme'] as $type)
                                <option value="{{ $type }}" {{ old('app_type', $application->app_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="field" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Field of Study <span class="text-red-500">*</span></label>
                        <select id="field" name="field" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach(['Software and Web Development','Coding & Robotics','Computer Literacy','Robotics','Business Analysis','Desktop Technicial','Graphic Designs','Marketing','Administration'] as $f)
                                <option value="{{ $f }}" {{ old('field', $application->field) === $f ? 'selected' : '' }}>{{ $f }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- ── Education ── --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Education</h3>
                <p class="text-sm text-gray-500 mb-5">High school and tertiary education details.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                    <div class="sm:col-span-2">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">High School</h4>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="high_school" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">School Name</label>
                        <input type="text" id="high_school" name="high_school"
                               value="{{ old('high_school', $application->high_school) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="year_of_completion" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Year of Completion</label>
                        <input type="text" id="year_of_completion" name="year_of_completion" maxlength="4"
                               value="{{ old('year_of_completion', $application->year_of_completion) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Tertiary</h4>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="qualification" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Qualification Obtained</label>
                        <input type="text" id="qualification" name="qualification"
                               value="{{ old('qualification', $application->qualification) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="institution" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Institution</label>
                        <input type="text" id="institution" name="institution"
                               value="{{ old('institution', $application->institution) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="year_obtained" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Year of Completion</label>
                        <input type="text" id="year_obtained" name="year_obtained" maxlength="4"
                               value="{{ old('year_obtained', $application->year_obtained) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            {{-- ── Documents ── --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Supporting Documents</h3>
                <p class="text-sm text-gray-500 mb-5">Upload a new PDF to replace the current file. Leave blank to keep the existing document.</p>

                @foreach([
                    ['name' => 'cv',                 'label' => 'CV',                  'path' => $application->cv_path],
                    ['name' => 'id_copy',             'label' => 'ID Copy',             'path' => $application->id_copy_path],
                    ['name' => 'qualification_copy', 'label' => 'Qualification Copy',  'path' => $application->qualification_copy_path],
                ] as $doc)
                <div class="mb-5">
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">{{ $doc['label'] }}</label>
                    @if($doc['path'])
                        <p class="text-xs text-green-700 mb-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            File on record: <span class="font-mono">{{ basename($doc['path']) }}</span>
                        </p>
                    @else
                        <p class="text-xs text-red-600 mb-1">No file uploaded yet.</p>
                    @endif
                    <input type="file" name="{{ $doc['name'] }}" accept=".pdf"
                           class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                @endforeach
            </div>

            {{-- ── Actions ── --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('profile.edit') }}"
                   class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
