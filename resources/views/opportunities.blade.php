<x-app-layout>
    @push('styles')
    @vite(['resources/css/dashboard.css'])
    @endpush
    <!-- Hero Section -->
    <div class="vacancies bg-gray-900" style="background-image: url('{{ asset('images/banner/developerProgrammer.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="black-overlay d-flex justify-content-start align-items-center">
            <div class="mx-auto max-w-2xl py-32">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-white ring-1 ring-white/2 hover:ring-white">
                        Register for our next Internship opportunities
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">We are looking for the Best of the Best</h1>
                    <p class="mt-6 text-lg leading-8 text-white">Join us in seizing an extraordinary chance to excel. We invite those with unmatched passion and skill to embark on a journey where innovation meets opportunity. Every task is an adventure, every challenge a chance to shine. Let your brilliance guide you in a realm where excellence is just the beginning.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <div class="px-4">
                            @if(Auth::check())
                            <x-front-end-btn linking="{{ route('internship_application') }}" color="blue" showme="" name="Apply" />
                            @else
                            <x-front-end-btn linking="{{ route('registerintern') }}" color="blue" showme="" name="Apply" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Internship Programs Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Available Internship Programs</h2>
                <p class="mt-4 text-lg text-gray-600">Discover exciting opportunities to kickstart your career</p>
            </div>
            <?php 
            
            ?>

            @if($internshipPrograms->count() > 0)
                <div class="available-applications">
                <h1 class="text-center">Coming Soon....</h1>
                    @foreach($internshipPrograms as $program)
                    
                    <!-- <div class="application-card">
                        <h4 class="application-title">{{ $program->name }}</h4>
                        <p class="application-description">{{ Str::limit($program->description, 150) }}</p>
                        
                        <div class="application-details">
                            <div class="application-detail">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $program->duration }}
                            </div>
                            <div class="application-detail">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ $program->number_needed }} positions
                            </div>
                            <div class="application-detail">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Deadline: {{ $program->recruitment_end_date->format('M d, Y') }}
                            </div>
                            @if($program->has_stipend)
                            <div class="application-detail">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                {{ $program->stipend_currency }} {{ number_format($program->stipend_amount, 0) }}
                            </div>
                            @endif
                        </div>
                        
                        <p class="application-requirements">
                            <strong>Requirements:</strong> 
                            @if($program->has_accreditation) Accredited Program. @endif
                            @if($program->youth_beneficiaries) Youth focused opportunity. @endif
                            {{ Str::limit($program->description, 100) }}
                        </p>
                        
                        <div class="mt-4">
                            @if(Auth::check())
                            <a href="{{ route('internship_application') }}" class="btn-primary w-full text-center">
                                Apply Now
                            </a>
                            @else
                            <a href="{{ route('registerintern') }}" class="btn-primary w-full text-center">
                                Register & Apply
                            </a>
                            @endif
                        </div>
                    </div> -->
                    
                    @endforeach
                </div>
            @else
                <!-- No Programs Available -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No internship programs available</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for new opportunities.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>