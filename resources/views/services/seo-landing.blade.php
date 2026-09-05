<x-app-layout>
    @section('meta')
    @php
        $metaTitle = $serviceTitle . ' | KAYISE IT';
        $metaDescription = $serviceIntro;
        $metaKeywords = $seoPhrase . ', KAYISE IT services, technology training South Africa';
    @endphp
    @endsection

    <x-page-header
        :title="$serviceTitle"
        subtitle="KAYISE IT Services"
        :description="$serviceIntro"
        hero-id="service-seo-hero"
        background-image="images/banner/businessAnalyst.png"
        height="h-[65vh]">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold transition-all duration-300" style="background: #16A34A;">
                Talk To Our Team
            </a>
            <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white font-semibold ring-2 ring-white/30 hover:ring-white/60 transition-all duration-300 hover:bg-white/10">
                View All Services
            </a>
        </div>
    </x-page-header>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 md:p-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">How We Deliver This Service</h2>
                <p class="text-gray-700 leading-relaxed mb-6">{{ $serviceIntro }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    @foreach($servicePoints as $point)
                        <div class="rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-gray-800">
                            {{ $point }}
                        </div>
                    @endforeach
                </div>

                <div class="rounded-xl bg-gray-900 text-white p-6">
                    <h3 class="text-xl font-semibold mb-2">Looking for {{ $seoPhrase }}?</h3>
                    <p class="text-gray-200 text-sm mb-4">KAYISE IT works with schools, TVET colleges, businesses, and public institutions to deliver practical, high-impact training and technology services.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-5 py-2.5 rounded-full text-white font-semibold" style="background: #16A34A;">Request A Consultation</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
