<x-app-layout>
@if(!$existingApplication)
        <div class="bg-slate-100">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Are you the person we are looking for?</a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Lets begin your application</h1>
                </div>
            </div>
        </div>
        <div class="max-w-3xl mx-auto my-4 sm:px-6 lg:px-8">
            @if(isset($selectedProgram) && $selectedProgram)
                <div class="mb-4 rounded-lg border border-blue-200 bg-blue-50 p-4 text-sm text-blue-900">
                    You are applying for: <strong>{{ $selectedProgram->name }}</strong>
                </div>

                <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
                    @csrf
                    <input type="hidden" name="internship_program_id" value="{{ $selectedProgram->id }}">
                    <input type="hidden" name="selected_program_id" value="{{ $selectedProgram->id }}">

                    @php
                        $prefill = [
                            'name' => auth()->user()->name,
                            'surname' => auth()->user()->surname,
                            'email' => auth()->user()->email,
                            'phone' => auth()->user()->phone,
                            'cellphone' => auth()->user()->phone,
                            'id_number' => auth()->user()->id_number,
                            'age' => auth()->user()->age,
                            'address' => auth()->user()->address,
                            'province' => auth()->user()->province,
                            'high_school' => auth()->user()->high_school,
                            'year_of_completion' => auth()->user()->year_of_completion,
                            'qualification' => auth()->user()->qualification,
                            'year_obtained' => auth()->user()->year_obtained,
                            'institution' => auth()->user()->institution,
                        ];
                    @endphp

                    <x-program-form-fields
                        :groupedFields="$selectedProgram->getGroupedFormFields()"
                        :values="array_merge($prefill, old())"
                        inputClass="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm"
                        labelClass="block text-sm font-bold text-gray-700 mb-2"
                    />

                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="rounded-lg bg-green-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-green-700">
                            Submit application
                        </button>
                    </div>
                </form>
            @else
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 text-center">
                    <p class="text-amber-900 font-medium mb-2">Select a programme to apply</p>
                    <p class="text-sm text-amber-800 mb-4">Choose an open programme from our opportunities page to load the correct application form.</p>
                    <a href="{{ route('opportunities') }}" class="inline-flex items-center px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700">
                        View opportunities
                    </a>
                </div>
            @endif
        </div>
    @else
        <div class="bg-slate-100">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Awesome!</a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">We already have your application for this programme</h1>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
