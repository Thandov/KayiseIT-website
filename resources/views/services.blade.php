<x-app-layout
  title="ICT training, drones, web and IT services | KAYISE IT"
  description="Explore KAYISE IT services: drone building courses, TVET ICT training, 4IR skills, cyber security awareness, Microsoft Office productivity, website development, and IT consulting for institutions and businesses."
  keywords="drone building course South Africa, 4IR skills training, ICT training TVET, cyber security training, Microsoft Office training, website development South Africa, IT consulting"
>
  <!-- Hero Section -->
  <x-page-hero 
      title="Training and Technology Services" 
      subtitle="Practical Skills, Real Digital Impact"
      description="From drone building course programs in South Africa to ICT training for TVET colleges, KAYISE IT delivers practical training and digital services that help institutions and businesses grow."
      hero-id="services-hero"
      background-image="images/banner/businessAnalyst.png"
      height="h-screen">
      
      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
              Schedule Consultation
          </a>
          <a href="#featured-services" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold ring-2 ring-white/30 hover:ring-white/60 transition-all duration-300 hover:bg-white/10">
              Explore Services
          </a>
      </div>
  </x-page-hero>

  <!-- Professional Stats Counter -->
  <section class="py-16 bg-gray-900">
      <div class="container mx-auto px-4 max-w-7xl">
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
              <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm text-center">
                  <div class="text-4xl font-bold text-white mb-2">200+</div>
                  <div class="font-semibold mb-1 text-gray-200">Projects Delivered</div>
                  <div class="text-sm" style="color:#22C55E;">Successful Implementations</div>
              </div>
              <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm text-center">
                  <div class="text-4xl font-bold text-white mb-2">10+</div>
                  <div class="font-semibold mb-1 text-gray-200">Years Experience</div>
                  <div class="text-sm" style="color:#22C55E;">Industry Leadership</div>
              </div>
              <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm text-center">
                  <div class="text-4xl font-bold text-white mb-2">99%</div>
                  <div class="font-semibold mb-1 text-gray-200">Client Satisfaction</div>
                  <div class="text-sm" style="color:#22C55E;">Quality Assurance</div>
              </div>
              <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm text-center">
                  <div class="text-4xl font-bold text-white mb-2">24/7</div>
                  <div class="font-semibold mb-1 text-gray-200">Support Available</div>
                  <div class="text-sm" style="color:#22C55E;">Business Continuity</div>
              </div>
          </div>
      </div>
  </section>

  <!-- SPECIALIZED SERVICES: Core Service Offerings -->
  <section class="py-20 bg-gray-50" id="featured-services">
    <div class="container mx-auto px-4 max-w-7xl">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Our Services</span>
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Skills Training and Digital Services</h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">We provide industry-relevant training and technology support for schools, TVET colleges, government programs, and private organizations across South Africa.</p>
      </div>

      <!-- Service Categories Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Drone Building Training Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M3 10l7-7 7 7-7 7-7-7z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Drone Building Training</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Our drone building course South Africa programs teach learners how to assemble, test, and understand drones using practical STEM methods.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• STEM-focused practical sessions</li>
            <li>• Electronics and component basics</li>
            <li>• School and TVET-ready delivery</li>
            <li>• Instructor-led training support</li>
          </ul>
          <a href="{{ route('services.seo.drone-building') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- ICT Skills Training Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M4 4h12v12H4z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">ICT Skills Training</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            We provide ICT skills training for TVET colleges and schools, helping students and staff build digital confidence and job-ready competencies.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Computer literacy and digital tools</li>
            <li>• Practical classroom and lab sessions</li>
            <li>• Curriculum support for institutions</li>
            <li>• Assessment and progress reporting</li>
          </ul>
          <a href="{{ route('services.seo.ict-training') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- 4IR Technology Training Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M10 2l2.5 5L18 8l-4 3.8L15 18l-5-3-5 3 1-6.2L2 8l5.5-1z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">4IR Technology Training</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Our 4IR skills training equips learners and teams with practical understanding of emerging technologies and digital transformation practices.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Industry 4.0 fundamentals</li>
            <li>• Innovation and digital readiness</li>
            <li>• Workforce upskilling programs</li>
            <li>• Public and private sector training</li>
          </ul>
          <a href="{{ route('services.seo.4ir-training') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- Cyber Security Training Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M10 2l6 3v5c0 4.5-2.7 6.8-6 8-3.3-1.2-6-3.5-6-8V5l6-3z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Cyber Security Training</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            We train teams to identify cyber risks, protect data, and apply safe digital practices in schools, offices, and training institutions.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Cyber safety awareness</li>
            <li>• Password and data protection</li>
            <li>• Phishing and threat prevention</li>
            <li>• Practical security protocols</li>
          </ul>
          <a href="{{ route('services.seo.cyber-security-training') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- Microsoft Office Productivity Training Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M4 3h12v14H4zM8 7h4M8 10h4M8 13h4"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Microsoft Office Productivity Training</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Improve workplace productivity with practical Microsoft Office training in Word, Excel, PowerPoint, and Outlook.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Beginner to advanced modules</li>
            <li>• Reporting and document workflows</li>
            <li>• Data handling and spreadsheets</li>
            <li>• Productivity best practices</li>
          </ul>
          <a href="{{ route('services.seo.ms-office-training') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- Website Development Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M2 4h16v12H2zM7 8l-2 2 2 2M13 8l2 2-2 2"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Website Development</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            We build professional websites that are fast, mobile-friendly, and optimized for search visibility and lead generation.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Business and institutional websites</li>
            <li>• SEO-ready page structure</li>
            <li>• Content and conversion optimization</li>
            <li>• Ongoing website support</li>
          </ul>
          <a href="{{ route('services.seo.website-development') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- IT Consulting Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M10 3v14M3 10h14"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">IT Consulting</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Our IT consulting service helps organizations choose the right technologies, improve operations, and plan sustainable digital growth.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Technology planning and advisory</li>
            <li>• ICT implementation support</li>
            <li>• School and TVET digital strategy</li>
            <li>• Business process improvement</li>
          </ul>
          <a href="{{ route('services.seo.it-consulting') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>
      </div>

      <!-- Service Selection Outcome -->
      <div class="bg-kb-50 rounded-2xl p-8 mb-16">
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
          <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="text-center">
              <h3 class="text-xl font-semibold mb-2">Free Consultation</h3>
              <p class="text-gray-600 text-sm">Schedule a no-obligation discussion</p>
            </div>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="text-center">
              <h3 class="text-xl font-semibold mb-2">Custom Proposal</h3>
              <p class="text-gray-600 text-sm">Tailored solutions for your needs</p>
            </div>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="text-center">
              <h3 class="text-xl font-semibold mb-2">Implementation</h3>
              <p class="text-gray-600 text-sm">Professional project execution</p>
            </div>
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