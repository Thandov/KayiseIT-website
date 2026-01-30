<x-app-layout>
  <!-- Meta tags -->
  @section('meta')
  @php
  $metaTitle = "Professional IT Services - Software Development & Technology Consulting";
  $metaDescription = "Specialized software development, web applications, and IT consulting services for enterprise clients. Custom solutions delivered with proven methodologies and professional expertise.";
  $metaKeywords = "Professional IT Services, Software Development, Enterprise Solutions, Technology Consulting, Business Automation, Digital Transformation, IT Infrastructure, South Africa";
  @endphp
  @endsection
  
  <!-- Hero Section -->
  <x-page-hero 
      title="Professional IT Services" 
      subtitle="Comprehensive Technology Solutions"
      description="Specialized software development, technology consulting, and digital transformation services designed to accelerate business growth and operational efficiency."
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
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Specialized IT Solutions</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Enterprise-grade technology services designed to accelerate your digital transformation</p>
      </div>

      <!-- Service Categories Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Software Development Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Software Development</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Enterprise-grade custom software solutions built on modern frameworks for scalability, security, and performance.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Custom Business Applications</li>
            <li>• API Development & Integration</li>
            <li>• Database Design & Optimization</li>
            <li>• Legacy System Modernization</li>
          </ul>
          <a href="{{ url('services/software-development') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- Web Development Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.265.633l-4-12a1 1 0 011.265-.633L8 10l4.316-10.949z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Web Development</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Professional web applications and platforms that enhance user experience and drive business engagement.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Responsive Web Applications</li>
            <li>• E-Commerce Platforms</li>
            <li>• Content Management Systems</li>
            <li>• Progressive Web Apps (PWAs)</li>
          </ul>
          <a href="{{ url('services/web-development') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>

        <!-- IT Consulting Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 group">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(34, 197, 94, 0.10);">
            <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">IT Consulting</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Strategic technology consulting to optimize IT infrastructure and business processes for maximum efficiency.
          </p>
          <ul class="text-sm text-gray-500 space-y-2 mb-6">
            <li>• Technology Strategy Development</li>
            <li>• Process Optimization</li>
            <li>• Digital Transformation</li>
            <li>• Infrastructure Planning</li>
          </ul>
          <a href="{{ url('services/it-consulting') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">Learn More</a>
        </div>
      </div>

      <!-- Service Selection Outcome -->
      <div class="bg-kb-50 rounded-2xl p-8 mb-16">
        <div class="text-center">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Transform Your Business?</h3>
          <p class="text-lg text-gray-600 mb-6 max-w-3xl mx-auto">
            Partner with our certified professionals to accelerate digital transformation and achieve measurable ROI improvements.
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