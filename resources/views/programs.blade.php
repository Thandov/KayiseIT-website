@php
    $hasEnquiry = $enquiryPrograms->isNotEmpty();
    $hasRunning = $runningPrograms->isNotEmpty();
    $hasAny = $hasEnquiry || $hasRunning;
    $featured = $enquiryPrograms->first() ?? $runningPrograms->first();
@endphp

<x-app-layout
    title="Programmes | KAYISE IT"
    description="Browse and register for KAYISE IT skills development, internship, and training programmes across South Africa."
    keywords="KAYISE IT programmes, skills development, internship, TVET South Africa"
>

<x-page-hero
    title="Programmes"
    subtitle="Skills & learning pathways"
    :description="$featured
        ? \Illuminate\Support\Str::limit(strip_tags($featured->description), 200)
        : 'Explore internship, TVET, and skills development programmes with KAYISE IT.'"
    hero-id="programs-hero"
    background-image="images/banner/developerProgrammer.png"
    height="h-[65vh]">

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        @if($hasEnquiry)
            <a href="#register"
               class="inline-flex items-center justify-center px-7 py-3 rounded-full text-white font-semibold shadow-lg hover:-translate-y-0.5 transition-all"
               style="background: linear-gradient(135deg, #0ea5e9 0%, #22c55e 100%);">
                Register
            </a>
        @endif
        @if($hasAny)
            <a href="#programmes"
               class="inline-flex items-center justify-center px-7 py-3 rounded-full text-white font-semibold ring-2 ring-white/40 hover:bg-white/10 transition-all">
                View programmes
            </a>
        @endif
    </div>
</x-page-hero>

@if(session('success'))
    <div class="bg-green-600 text-white">
        <div class="max-w-4xl mx-auto px-4 py-4 text-center text-sm sm:text-base font-medium">
            {{ session('success') }}
        </div>
    </div>
@endif

<section id="programmes" class="py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($hasAny)
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Available programmes</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Select a programme below and register, or apply where applications are open.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($enquiryPrograms as $program)
                    @include('programs._card', ['program' => $program, 'mode' => 'enquire'])
                @endforeach
                @foreach($runningPrograms as $program)
                    @include('programs._card', ['program' => $program, 'mode' => 'running'])
                @endforeach
            </div>
        @else
            <div class="max-w-xl mx-auto text-center rounded-2xl border border-dashed border-gray-300 bg-white p-12">
                <p class="text-xl font-semibold text-gray-900 mb-2">Programmes coming soon</p>
                <p class="text-gray-600 mb-6">Please check back later or get in touch with our team.</p>
                <a href="{{ route('contact') }}" class="inline-flex px-6 py-2.5 rounded-full text-sm font-semibold text-white bg-gray-900 hover:bg-gray-800">
                    Contact us
                </a>
            </div>
        @endif
    </div>
</section>

@if($hasEnquiry)
<section id="register" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Register</h2>
            <p class="text-gray-600">Complete the form below to register for your chosen programme.</p>
        </div>

        @if($errors->any())
            <div class="mb-8 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-800">
                <p class="font-semibold mb-2">Please fix the following:</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <form method="POST" action="{{ route('programs.register') }}" class="p-6 sm:p-10 space-y-8">
                @csrf

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Personal details</h3>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                        <div>
                            <label for="surname" class="block text-sm font-medium text-gray-700 mb-1.5">Surname *</label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                        <div>
                            <label for="id_number" class="block text-sm font-medium text-gray-700 mb-1.5">ID number *</label>
                            <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="cellphone" class="block text-sm font-medium text-gray-700 mb-1.5">Cellphone *</label>
                            <input type="tel" id="cellphone" name="cellphone" value="{{ old('cellphone') }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Location</h3>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1.5">Country *</label>
                            <select id="country" name="country" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                                @foreach(['South Africa', 'Botswana', 'Lesotho', 'Mozambique', 'Namibia', 'Zimbabwe', 'Other'] as $country)
                                    <option value="{{ $country }}" {{ old('country', 'South Africa') === $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-1.5">Province *</label>
                            <select id="province" name="province" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                                <option value="">Select province</option>
                                @foreach(['Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo','Mpumalanga','North West','Northern Cape','Western Cape'] as $prov)
                                    <option value="{{ $prov }}" {{ old('province') === $prov ? 'selected' : '' }}>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="location_type" class="block text-sm font-medium text-gray-700 mb-1.5">Area type *</label>
                            <select id="location_type" name="location_type" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                                <option value="">Town or township?</option>
                                <option value="town" {{ old('location_type') === 'town' ? 'selected' : '' }}>Town</option>
                                <option value="township" {{ old('location_type') === 'township' ? 'selected' : '' }}>Township</option>
                            </select>
                        </div>
                        <div>
                            <label for="location_name" class="block text-sm font-medium text-gray-700 mb-1.5">Town / township name *</label>
                            <input type="text" id="location_name" name="location_name" value="{{ old('location_name') }}" required
                                   placeholder="e.g. Polokwane or Seshego"
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Programme</h3>
                    <label for="internship_program_id" class="block text-sm font-medium text-gray-700 mb-1.5">Programme *</label>
                    <select id="internship_program_id" name="internship_program_id" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        <option value="">Select programme</option>
                        @foreach($enquiryPrograms as $program)
                            <option value="{{ $program->id }}" {{ (string) old('internship_program_id') === (string) $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center px-10 py-3.5 rounded-full text-white font-semibold shadow-lg hover:-translate-y-0.5 transition-all"
                            style="background: linear-gradient(135deg, #0ea5e9 0%, #22c55e 100%);">
                        Submit registration
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endif

</x-app-layout>
