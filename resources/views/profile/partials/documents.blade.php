<div class="space-y-6">
    @if(isset($applications) && $applications->count() > 0)
        <p class="text-sm text-gray-600">
            These are the supporting documents you have uploaded for your internship and related programme applications.
        </p>

        @foreach($applications as $application)
            <div class="border border-green-100 rounded-xl p-4 bg-white hover:border-green-300 transition-colors">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">
                            {{ $application->field ?? 'Programme application' }}
                        </h3>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $application->app_type ?? 'Application' }} &middot;
                            {{ $application->program_partner ?? 'Kayise IT' }}
                        </p>
                    </div>
                    <span class="inline-flex items-center rounded-full border border-green-200 px-2 py-0.5 text-[11px] font-medium text-green-700 bg-green-50">
                        {{ ucfirst($application->status ?? 'pending') }}
                    </span>
                </div>

                <dl class="mt-4 grid gap-3 text-sm text-gray-700 sm:grid-cols-3">
                    <div>
                        <dt class="font-medium text-gray-900 mb-1">CV / Resume</dt>
                        <dd>
                            @if(!empty($application->cv_path))
                                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank" class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 underline underline-offset-2">
                                    View file
                                </a>
                            @else
                                <span class="text-gray-400">Not uploaded</span>
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-900 mb-1">ID copy</dt>
                        <dd>
                            @if(!empty($application->id_copy_path))
                                <a href="{{ asset('storage/' . $application->id_copy_path) }}" target="_blank" class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 underline underline-offset-2">
                                    View file
                                </a>
                            @else
                                <span class="text-gray-400">Not uploaded</span>
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-900 mb-1">Qualification</dt>
                        <dd>
                            @if(!empty($application->qualification_copy_path))
                                <a href="{{ asset('storage/' . $application->qualification_copy_path) }}" target="_blank" class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 underline underline-offset-2">
                                    View file
                                </a>
                            @else
                                <span class="text-gray-400">Not uploaded</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        @endforeach
    @else
        <div class="border border-dashed border-gray-200 rounded-xl p-6 bg-gray-50 text-center">
            <h3 class="text-sm font-semibold text-gray-900">No programme registrations yet</h3>
            <p class="mt-2 text-sm text-gray-600">
                Once you apply for an internship, TVET placement, or short programme, your supporting documents will appear here.
            </p>
        </div>
    @endif
</div>

