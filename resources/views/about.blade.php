<x-app-layout
  title="About KAYISE IT | ICT, software and youth skills"
  description="Learn how KAYISE IT combines enterprise ICT delivery with skills development, internships, and community-focused technology programmes across South Africa."
  keywords="KAYISE IT, about, ICT company South Africa, software development, youth skills, internships"
>
  <!-- Hero Section -->
  <x-page-hero 
      title="About Us" 
      hero-id="about-hero-new"
      background-image="images/KayiseIT-Team.jpg" />

  <!-- About-us -->
  <section id="about-us">
    @include('_about')
  </section>
  <!-- Vision and Mission -->
  <section class="py-20 bg-slate-100" id="vision-mission">
    <div class="container mx-auto px-4 max-w-7xl">
      <x-titlestyle smheading="Our Culture" bgheading="Our Fundamental Business" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
      <div class="flex items-center bg-white rounded-lg p-6 h-auto min-h-64">
        <div>
          <h3 class="card-title text-2xl font-bold text-center smalltxt mb-3">Vision</h3>
          <p class="card-text text-center text-base">To be South Africa's leading technology company that achieves exceptional profitability while creating transformative opportunities for youth through business excellence and social impact.</p>
        </div>
      </div>
      <div class="flex items-center bg-white rounded-lg p-6 h-auto min-h-64">
        <div>
          <h3 class="card-title text-2xl font-bold text-center smalltxt mb-3">Mission</h3>
          <p class="card-text text-center text-base">To drive profitable business growth through world-class IT solutions while developing South African youth into skilled ICT professionals through comprehensive training and internship programs.</p>
        </div>
      </div>
      </div>
    
      <!-- Core Values Section -->
      <div class="mt-16">
        <h3 class="text-3xl font-bold text-center mb-12 smalltxt">Our Core Values</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg p-6 shadow-sm">
          <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
          </div>
          <h4 class="text-xl font-bold text-center mb-2">Profitability</h4>
          <p class="text-center text-sm text-gray-600">We maintain rigorous financial discipline, delivering measurable ROI and sustainable growth for our clients and stakeholders.</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm">
          <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
          <h4 class="text-xl font-bold text-center mb-2">Youth Development</h4>
          <p class="text-center text-sm text-gray-600">We invest in the future by providing comprehensive training, mentorship, and career pathways for young South Africans.</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm">
          <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <h4 class="text-xl font-bold text-center mb-2">Integrated Excellence</h4>
          <p class="text-center text-sm text-gray-600">We believe profit and purpose are not mutually exclusive—our success enables greater impact, and our impact strengthens our success.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Visual Gallery Section -->
  <section class="py-20 bg-white" id="visual-gallery">
    <div class="container mx-auto px-4 max-w-7xl">
      <x-titlestyle smheading="Our Story" bgheading="In Action" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
      
      <div class="mt-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Image 1 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/318110873_557073029762347_5509873214173641249_n.jpg') }}" 
            alt="KAYISE IT Team" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 2 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/319183456_563484435787873_8326613098780373042_n.jpg') }}" 
            alt="KAYISE IT Training" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 3 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 md:col-span-2">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/330785452_686402603275943_7224705160606685331_n.jpg') }}" 
            alt="KAYISE IT Workshop" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 4 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 md:col-span-2">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/340140852_1458720341623964_8727235806007319528_n.jpg') }}" 
            alt="KAYISE IT Event" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 5 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/340851034_3727464414140331_5502527995688493162_n.jpg') }}" 
            alt="KAYISE IT Team Building" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 6 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/internship-2023-2024/340932408_1710467926038309_8682288468363773360_n.jpg') }}" 
            alt="KAYISE IT Learning" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 7 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/tvet-placement-2022-2023/306366474_482669353869382_332993973053090666_n.jpg') }}" 
            alt="KAYISE IT Placement" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Image 8 -->
        <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
          <img 
            src="{{ asset('images/gallery/tvet-placement-2022-2023/315542916_539853984817585_1301454589993731756_n.jpg') }}" 
            alt="KAYISE IT Success" 
            class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <section class="py-20 bg-gradient-to-b from-slate-50 to-white" id="our-partners">
    <div class="container mx-auto px-4 max-w-7xl">
      <x-titlestyle smheading="Our Partners" bgheading="Building Strong Partnerships" alignment="text-center" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
      
      <p class="text-center text-lg text-gray-600 max-w-3xl mx-auto mt-6 mb-12">
        We're proud to collaborate with leading organizations across education, skills development, and technology sectors. These strategic partnerships enable us to deliver exceptional training programs and cutting-edge IT solutions.
      </p>

      <!-- Partners Grid -->
      @php
        $dbPartners = \App\Models\Partner::active()->ordered()->get();
      @endphp

      @if($dbPartners->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
          @foreach($dbPartners as $dbPartner)
            @php
              $pLogoUrl = $dbPartner->logo_path;
              if ($pLogoUrl && str_starts_with($pLogoUrl, 'partners/')) {
                  $pLogoUrl = 'images/partners/' . basename($pLogoUrl);
              }
            @endphp
            <div class="relative bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col items-center">
              @if($dbPartner->mou_signed)
                <span class="absolute top-3 right-3 inline-flex items-center gap-1 bg-green-600 text-white text-[10px] font-bold px-2 py-1 rounded-full leading-none shadow">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  MOU Signed
                </span>
              @endif
              @if($pLogoUrl)
              <div class="mb-4 h-24 flex items-center justify-center">
                <img
                  class="h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                  src="{{ asset($pLogoUrl) }}"
                  alt="{{ $dbPartner->name }}"
                  loading="lazy"
                >
              </div>
              @endif
              <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">{{ $dbPartner->name }}</h4>
              @if($dbPartner->description)
                <p class="text-sm text-gray-600 text-center">{{ $dbPartner->description }}</p>
              @endif
              @if($dbPartner->mou_signed && $dbPartner->mou_date)
                <p class="mt-2 text-xs text-green-700">MOU since {{ $dbPartner->mou_date->format('M Y') }}</p>
              @endif
            </div>
          @endforeach
        </div>
      @else
        {{-- Fallback static grid when no partners in DB --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
          <!-- MICT SETA -->
          <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col items-center">
            <div class="mb-4 h-24 flex items-center justify-center">
              <img
                class="h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                src="{{ asset('images/partners/mict.png') }}"
                alt="MICT SETA"
                loading="lazy"
              >
            </div>
            <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">MICT SETA</h4>
            <p class="text-sm text-gray-600 text-center">Media, Information and Communication Technologies Sector Education and Training Authority</p>
          </div>

          <!-- Ehlanzeni TVET College -->
          <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col items-center">
            <div class="mb-4 h-24 flex items-center justify-center">
              <img
                class="h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                src="{{ asset('images/partners/Ehlanzeni.png') }}"
                alt="Ehlanzeni TVET College"
                loading="lazy"
              >
            </div>
            <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">Ehlanzeni TVET College</h4>
            <p class="text-sm text-gray-600 text-center">Technical and Vocational Education and Training institution supporting skills development</p>
          </div>

          <!-- Tarsus on Demand -->
          <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col items-center">
            <div class="mb-4 h-24 flex items-center justify-center">
              <img
                class="h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                src="{{ asset('images/partners/tarsus.png') }}"
                alt="Tarsus on Demand"
                loading="lazy"
              >
            </div>
            <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">Tarsus on Demand</h4>
            <p class="text-sm text-gray-600 text-center">Leading technology distribution and solutions provider</p>
          </div>

          <!-- SCG South Africa -->
          <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col items-center">
            <div class="mb-4 h-24 flex items-center justify-center">
              <img
                class="h-20 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300"
                src="{{ asset('images/partners/scg.png') }}"
                alt="SCG South Africa"
                loading="lazy"
              >
            </div>
            <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">SCG South Africa</h4>
            <p class="text-sm text-gray-600 text-center">Strategic technology and business solutions partner</p>
          </div>
        </div>
      @endif

      <!-- Partnership Benefits -->
      <div class="mt-12 bg-white rounded-xl p-8 shadow-lg border border-gray-100">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-800">How Our Partnerships Drive Impact</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            <h4 class="font-semibold text-gray-800 mb-2">Skills Development</h4>
            <p class="text-sm text-gray-600">Collaborating with educational institutions to create pathways for young professionals</p>
          </div>
          <div class="text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <h4 class="font-semibold text-gray-800 mb-2">Industry Access</h4>
            <p class="text-sm text-gray-600">Connecting our trainees with real-world opportunities and industry expertise</p>
          </div>
          <div class="text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h4 class="font-semibold text-gray-800 mb-2">Innovation</h4>
            <p class="text-sm text-gray-600">Leveraging cutting-edge technology and best practices from industry leaders</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
