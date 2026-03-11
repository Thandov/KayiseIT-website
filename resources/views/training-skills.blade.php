<x-app-layout>
    @section('meta')
    @php
        $metaTitle = 'Training & Skills Courses for Schools and TVET Colleges | KAYISE IT';
        $metaDescription = 'Explore KAYISE IT training courses in ICT skills, drone building, Microsoft Office, computer productivity, cyber security, and entrepreneurship for schools and TVET colleges in South Africa.';
        $metaKeywords = 'Training and Skills, ICT Skills Training, Build a Drone Course, Microsoft Office Training, Computer Productivity, Cyber Security Training, Entrepreneurship Training, TVET colleges South Africa';
    @endphp
    @endsection

    <x-page-hero
        title="Training & Skills"
        subtitle="Future-Ready Learning Programs"
        description="Practical, industry-relevant training designed for schools, TVET colleges, and institutions across South Africa."
        hero-id="training-skills-hero"
        background-image="images/banner/businessAnalyst.png"
        height="h-[70vh]">

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#courses" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-xl" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                Explore Courses
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold ring-2 ring-white/30 hover:ring-white/60 transition-all duration-300 hover:bg-white/10">
                Partner With Us
            </a>
        </div>
    </x-page-hero>

    <section id="courses" class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="color:#22C55E;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.10);">Training Programs</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Skills Training Courses for Schools and TVET Colleges</h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Our programs combine classroom learning with practical activities to help learners build confidence, digital competence, and career-ready skills.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16v12H4z"></path>
                            <path d="M8 20h8"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">ICT Skills Training</h2>
                    <p class="text-gray-600 leading-relaxed">A practical course that develops computer literacy, internet skills, and digital communication. Ideal for learners who need strong technology foundations for study and work readiness.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">Digital Foundations</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l8 8-8 8-8-8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Build a Drone Course</h2>
                    <p class="text-gray-600 leading-relaxed">Learners assemble and test drones while understanding core STEM concepts, including electronics and systems thinking. This course promotes hands-on problem-solving and innovation.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">STEM + Hands-On</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4z"></path>
                            <path d="M8 8h8M8 12h8M8 16h5"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Microsoft Office Training</h2>
                    <p class="text-gray-600 leading-relaxed">Structured training in Word, Excel, PowerPoint, and Outlook to improve academic and workplace performance. Learners gain practical document, data, and presentation skills.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">Office Productivity</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 12h10M4 18h7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Computer Productivity</h2>
                    <p class="text-gray-600 leading-relaxed">Focuses on digital efficiency, file management, collaboration tools, and workflow habits that help learners and staff work smarter and complete tasks faster.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">Workflow Skills</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l8 4v6c0 5-3.4 8.6-8 10-4.6-1.4-8-5-8-10V6z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Cyber Security Training</h2>
                    <p class="text-gray-600 leading-relaxed">Builds awareness of digital threats and teaches practical online safety, password protection, and data security practices for classrooms, offices, and institutions.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">Cyber Awareness</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                        <svg class="w-6 h-6" style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 3v18M3 12h18"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Entrepreneurship Training</h2>
                    <p class="text-gray-600 leading-relaxed">Introduces learners to business thinking, opportunity identification, and practical startup skills. Supports youth empowerment and enterprise development in local communities.</p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">Business Readiness</p>
                </article>
            </div>
        </div>
    </section>

    <section class="py-16 text-white" style="background: radial-gradient(circle at top right, #1f2937 0%, #0f172a 55%, #020617 100%);">
        <div class="container mx-auto px-4 max-w-5xl text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-4" style="color:#86efac;border:1px solid #22C55E;background-color: rgba(34, 197, 94, 0.14);">Partnership Invitation</span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Partner With KAYISE IT to Equip the Next Generation</h2>
            <p class="text-gray-200 text-lg mb-8">Schools and TVET colleges are invited to partner with KAYISE IT to deliver practical, future-ready training programs that improve learner outcomes and employability.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-7 py-3 rounded-full text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5" style="background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);">
                Start a Training Partnership
            </a>
        </div>
    </section>
</x-app-layout>
