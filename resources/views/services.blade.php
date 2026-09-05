<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
  @php
  $metaTitle = "Drone Building, ICT & 4IR Skills Training in South Africa | KAYISE IT Services";
  $metaDescription = "KAYISE IT offers drone building training, ICT skills training, 4IR technology training, cyber security training, Microsoft Office productivity training, website development, and IT consulting for schools, TVET colleges, and businesses.";
  $metaKeywords = "drone building course South Africa, 4IR skills training, ICT training for TVET colleges, cyber security training South Africa, Microsoft Office training, website development services, IT consulting South Africa";
  @endphp
  @endsection
  
  <!-- Hero Section -->
  <x-page-header
      title="Training and Technology Services"
      subtitle="Practical Skills, Real Digital Impact"
      description="From drone building course programs in South Africa to ICT training for TVET colleges, KAYISE IT delivers practical training and digital services that help institutions and businesses grow."
      hero-id="services-hero"
      background-image="images/banner/businessAnalyst.png"
      height="h-screen">
      
      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{ route('contact') }}" class="ki-btn ki-btn-on-dark">Schedule a consultation</a>
          <a href="#featured-services" class="ki-btn ki-btn-on-dark ki-btn-ghost">Explore services</a>
      </div>
  </x-page-header>

  <!-- Professional Stats Counter -->
  <section class="py-16 bg-gray-900">
      <div class="container mx-auto px-4 max-w-7xl">
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-10">
              <div class="ki-stat">
                  <div class="ki-stat-value">200+</div>
                  <div class="ki-stat-label">Projects delivered</div>
              </div>
              <div class="ki-stat">
                  <div class="ki-stat-value">10+</div>
                  <div class="ki-stat-label">Years in Mpumalanga</div>
              </div>
              <div class="ki-stat">
                  <div class="ki-stat-value">99%</div>
                  <div class="ki-stat-label">Client satisfaction</div>
              </div>
              <div class="ki-stat">
                  <div class="ki-stat-value">24/7</div>
                  <div class="ki-stat-label">Support when systems break</div>
              </div>
          </div>
      </div>
  </section>

  <!-- SPECIALIZED SERVICES: Core Service Offerings -->
  <section class="py-20 bg-gray-50" id="featured-services">
    <div class="container mx-auto px-4 max-w-7xl">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="ki-kicker">Training and digital work</span>
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Skills training and digital services</h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">Hands-on programmes for schools, TVET colleges, government programmes, and private organisations across South Africa.</p>
      </div>

      @php
        $featuredServices = [
          [
            'index' => '01',
            'title' => 'Drone Building Training',
            'href' => route('services.seo.drone-building'),
            'body' => 'Learners assemble, test, and understand drones with practical STEM methods suited to schools and TVET colleges.',
            'items' => ['STEM-focused practical sessions', 'Electronics and component basics', 'School and TVET-ready delivery', 'Instructor-led training support'],
          ],
          [
            'index' => '02',
            'title' => 'ICT Skills Training',
            'href' => route('services.seo.ict-training'),
            'body' => 'Computer literacy and digital tools for students and staff who need job-ready confidence in a lab or classroom.',
            'items' => ['Computer literacy and digital tools', 'Practical classroom and lab sessions', 'Curriculum support for institutions', 'Assessment and progress reporting'],
          ],
          [
            'index' => '03',
            'title' => '4IR Technology Training',
            'href' => route('services.seo.4ir-training'),
            'body' => 'Practical grounding in emerging technologies for learners and workplace teams preparing for Industry 4.0 work.',
            'items' => ['Industry 4.0 fundamentals', 'Innovation and digital readiness', 'Workforce upskilling programmes', 'Public and private sector training'],
          ],
          [
            'index' => '04',
            'title' => 'Cyber Security Training',
            'href' => route('services.seo.cyber-security-training'),
            'body' => 'Awareness and practical habits that help schools, offices, and training sites protect data and spot common threats.',
            'items' => ['Cyber safety awareness', 'Password and data protection', 'Phishing and threat prevention', 'Practical security protocols'],
          ],
          [
            'index' => '05',
            'title' => 'Microsoft Office Productivity Training',
            'href' => route('services.seo.ms-office-training'),
            'body' => 'Word, Excel, PowerPoint, and Outlook modules from beginner through workplace reporting workflows.',
            'items' => ['Beginner to advanced modules', 'Reporting and document workflows', 'Data handling and spreadsheets', 'Productivity best practices'],
          ],
          [
            'index' => '06',
            'title' => 'Website Development',
            'href' => route('services.seo.website-development'),
            'body' => 'Business and institutional websites that are fast, mobile-friendly, and structured for search and enquiries.',
            'items' => ['Business and institutional websites', 'SEO-ready page structure', 'Content and conversion support', 'Ongoing website support'],
          ],
          [
            'index' => '07',
            'title' => 'IT Consulting',
            'href' => route('services.seo.it-consulting'),
            'body' => 'Advice on technology choices, ICT rollout, and digital planning for schools, TVETs, and businesses.',
            'items' => ['Technology planning and advisory', 'ICT implementation support', 'School and TVET digital strategy', 'Business process improvement'],
          ],
        ];
      @endphp
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        @foreach($featuredServices as $featuredService)
          <x-ki-feature-card
              :index="$featuredService['index']"
              :title="$featuredService['title']"
              :items="$featuredService['items']"
              :href="$featuredService['href']"
              link-text="Read about this service">
            {{ $featuredService['body'] }}
          </x-ki-feature-card>
        @endforeach
      </div>

      <!-- Service Selection Outcome -->
      <div class="border border-[#d5dde8] bg-white p-8 mb-16">
        <div class="text-center">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Training or Technology Support?</h3>
          <p class="text-lg text-gray-600 mb-6 max-w-3xl mx-auto">
            Speak to KAYISE IT about drone building training, 4IR skills training, cyber security awareness, Microsoft Office productivity, website development, and IT consulting.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-front-end-btn linking="contact" color="blue" showme="" name="Schedule Consultation" />
            <x-front-end-btn linking="#cta-section" color="white" showme="" name="View Portfolio" />
          </div>
        </div>
      </div>

      <!-- Dynamic Services List -->
      @include('services._services')
    </div>
  </section>

  <!-- ENTERPRISE VALUE SECTION -->
  <section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
          <h2 class="text-4xl font-bold mb-6">Why Choose KAYISE IT for Your Technology Needs?</h2>
          <p class="text-xl text-gray-300 mb-8 leading-relaxed">
            Our specialized approach combines cutting-edge technology with proven business methodologies to deliver measurable results and competitive advantage.
          </p>
          
          <div class="space-y-6">
            <div class="flex items-start">
              <div class="w-8 h-8 bg-kb-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold mb-2">Enterprise-Grade Solutions</h3>
                <p class="text-gray-400">Scalable architectures designed for enterprise demands and regulatory compliance.</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="w-8 h-8 bg-kb-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold mb-2">Proven Development Methodologies</h3>
                <p class="text-gray-400">Agile frameworks and industry best practices ensuring quality and reliability.</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="w-8 h-8 bg-kb-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold mb-2">24/7 Professional Support</h3>
                <p class="text-gray-400">Round-the-clock technical support ensuring uninterrupted business operations.</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Value Proposition Card -->
        <div class="bg-gray-800 p-8 rounded-2xl border border-gray-700">
          <h3 class="text-2xl font-bold mb-6">Calculate Your Technology ROI</h3>
          <div class="space-y-4">
            <div class="flex justify-between border-b border-gray-700 pb-2">
              <span>Development Efficiency</span>
              <span class="text-kg-400">+75% Delivery Speed</span>
            </div>
            <div class="flex justify-between border-b border-gray-700 pb-2">
              <span>System Reliability</span>
              <span class="text-kg-400">99.8% Uptime</span>
            </div>
            <div class="flex justify-between border-b border-gray-700 pb-2">
              <span>Cost Optimization</span>
              <span class="text-kg-400">-40% IT Expenses</span>
            </div>
          </div>
          <div class="mt-6">
            <x-front-end-btn linking="contact" color="white" showme="" name="Discuss ROI Analysis" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CALL-TO-ACTION SECTION -->
  <section class="py-20" style="background-color: #f0f4ff;" id="cta-section">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Ready to Accelerate Your Digital Transformation?</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
          Schedule a consultation with our technology experts and discover how we can enhance your business operations with innovative IT solutions.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
          <div class="ki-card">
            <span class="ki-card-index">01</span>
            <h3 class="ki-card-title">Consultation</h3>
            <p class="ki-card-body">A conversation about the training or system you need — no obligation.</p>
          </div>
          <div class="ki-card">
            <span class="ki-card-index">02</span>
            <h3 class="ki-card-title">Proposal</h3>
            <p class="ki-card-body">A written plan with scope, timelines, and cost for your institution or business.</p>
          </div>
          <div class="ki-card">
            <span class="ki-card-index">03</span>
            <h3 class="ki-card-title">Delivery</h3>
            <p class="ki-card-body">On-site or scheduled delivery with support after go-live.</p>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <x-front-end-btn linking="contact" color="blue" showme="" name="Start Your Consultation" />
          <x-front-end-btn linking="about" color="white" showme="" name="Learn About Our Process" />
        </div>
      </div>
    </div>
  </section>

  <!-- CLIENT PORTFOLIO -->
  <section id="our-clients">
    <x-clients></x-clients>
  </section>
</x-app-layout>