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
                @forelse ($courses as $course)
                    <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background-color: rgba(34, 197, 94, 0.12);">
                            <x-academy-course-icon :icon-key="$course->icon_key" />
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-3">{{ $course->title }}</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
                        <p class="mt-4 text-xs font-semibold uppercase tracking-wide" style="color:#16A34A;">{{ $course->category }}</p>
                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-10 text-center text-gray-600">
                        <p class="text-lg font-medium text-gray-800 mb-2">No courses to display yet</p>
                        <p class="text-sm">Add courses in the dashboard under <strong>Academy</strong>, or run <code class="text-xs bg-white px-1 py-0.5 rounded border">php artisan db:seed --class=AcademyCoursesSeeder</code>.</p>
                    </div>
                @endforelse
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
