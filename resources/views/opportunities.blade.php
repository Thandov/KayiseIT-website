<x-app-layout>

@push('styles')
@vite(['resources/css/dashboard.css'])
@endpush

<!-- Hero Section -->
<x-page-header
    title="We are looking for the Best of the Best"
    subtitle="Register for our next Internship opportunities"
    description="Join us in seizing an extraordinary chance to excel. We invite those with unmatched passion and skill to embark on a journey where innovation meets opportunity."
    hero-id="opportunities-hero"
    background-image="images/banner/developerProgrammer.png"
    height="h-[70vh]">

    <div class="flex items-center justify-center gap-x-6">
        @if(Auth::check())
            <x-front-end-btn linking="{{ route('internship_application') }}" color="blue" showme="" name="Apply" />
        @else
            <x-front-end-btn linking="{{ route('registerintern') }}" color="blue" showme="" name="Apply" />
        @endif
    </div>
</x-page-header>

<!-- Available Internship Programs -->

<div class="py-16 bg-gray-50">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="text-center mb-12">

<h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
Available Internship Programs
</h2>

<p class="mt-4 text-lg text-gray-600">
Discover exciting opportunities to kickstart your career
</p>

</div>

@if($internshipPrograms->count() > 0)

<div class="available-applications grid md:grid-cols-2 lg:grid-cols-3 gap-8">

@foreach($internshipPrograms as $program)

<div class="application-card bg-white p-6 rounded-lg shadow-md">

<h4 class="application-title text-xl font-semibold mb-2">
{{ $program->name }}
</h4>

<p class="application-description text-gray-600 mb-4">
{{ \Illuminate\Support\Str::limit($program->description,150) }}
</p>

<div class="application-details space-y-2 text-sm text-gray-500">

<div>
<strong>Duration:</strong> {{ $program->duration }}
</div>

<div>
<strong>Positions:</strong> {{ $program->number_needed }}
</div>

<div>
<strong>Deadline:</strong>
{{ $program->recruitment_end_date->format('M d, Y') }}
</div>

@if($program->has_stipend)

<div>
<strong>Stipend:</strong>
{{ $program->stipend_currency }}
{{ number_format($program->stipend_amount,0) }}
</div>
@endif

</div>

<div class="mt-6">

@if(Auth::check())

<a href="{{ route('internship_application', ['program' => $program->id]) }}"
class="btn-primary w-full text-center block bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
Apply Now </a>

@else

<a href="{{ route('registerintern') }}"
class="btn-primary w-full text-center block bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
Register & Apply </a>

@endif

</div>

</div>

@endforeach

</div>

@else

<div class="text-center py-12">

<h3 class="mt-2 text-sm font-medium text-gray-900">
No internship programs available
</h3>

<p class="mt-1 text-sm text-gray-500">
Check back later for new opportunities.
</p>

</div>

@endif

</div>

</div>

</x-app-layout>
