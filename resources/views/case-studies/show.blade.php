<x-app-layout>
    <section class="bg-white">
        <div class="container mx-auto px-4 max-w-7xl py-8">
            <nav class="ki-case-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('case-studies.index') }}">Case studies</a>
                <span aria-hidden="true">/</span>
                <span>{{ $caseStudy->title }}</span>
            </nav>
        </div>
    </section>

    <article class="bg-white pb-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <header class="max-w-3xl mb-8">
                <span class="ki-kicker ki-kicker-left">Case study</span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $caseStudy->publicHeadline() }}</h1>
                <p class="text-gray-600">
                    {{ collect([$caseStudy->client_name, $caseStudy->sector, $caseStudy->year, $caseStudy->duration])->filter()->join(' · ') }}
                </p>
            </header>

            @if(count($caseStudy->snapshotStats()) > 0)
                <dl class="ki-stat-bar mb-8">
                    @foreach($caseStudy->snapshotStats() as $stat)
                        <div>
                            <dt>{{ $stat['label'] }}</dt>
                            <dd>{{ $stat['value'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            @endif

            <div class="ki-case-layout">
                <div>
                    @if($caseStudy->imageUrl())
                        <img src="{{ $caseStudy->imageUrl() }}" alt="{{ $caseStudy->publicHeadline() }}" class="ki-case-hero-image mb-8">
                    @endif

                    <section class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">The challenge</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $caseStudy->problem }}</p>
                    </section>

                    <section class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">The approach</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $caseStudy->solution }}</p>
                    </section>

                    <section class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">The results</h2>
                        @if($caseStudy->results)
                            <p class="text-gray-700 leading-relaxed mb-4 whitespace-pre-line">{{ $caseStudy->results }}</p>
                        @endif
                        @if(count($caseStudy->resultItems()) > 0)
                            <ul class="ki-card-list">
                                @foreach($caseStudy->resultItems() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </section>

                    @if($caseStudy->quote)
                        <blockquote class="ki-case-quote mb-8">
                            <p>{{ $caseStudy->quote }}</p>
                            @if($caseStudy->quote_name || $caseStudy->quote_role)
                                <footer>
                                    @if($caseStudy->quote_name)<cite>{{ $caseStudy->quote_name }}</cite>@endif
                                    @if($caseStudy->quote_role)<span>{{ $caseStudy->quote_role }}</span>@endif
                                </footer>
                            @endif
                        </blockquote>
                    @endif

                    @if($caseStudy->has_gallery && $caseStudy->galleryImages->count() > 0)
                        <section class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Gallery</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($caseStudy->galleryImages as $image)
                                    <img src="{{ $image->url() }}" alt="{{ $caseStudy->title }} gallery" class="w-full h-40 object-cover border border-[#d5dde8]">
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="ki-case-aside">
                    <div class="ki-case-aside-card">
                        @if($caseStudy->client_name)
                            <p class="ki-media-date mb-2">Client</p>
                            <p class="font-semibold text-gray-900 mb-4">{{ $caseStudy->client_name }}</p>
                        @endif
                        @if($caseStudy->sector)
                            <p class="ki-media-date mb-2">Sector</p>
                            <p class="font-semibold text-gray-900 mb-4">{{ $caseStudy->sector }}</p>
                        @endif
                        @if($caseStudy->duration)
                            <p class="ki-media-date mb-2">Duration</p>
                            <p class="font-semibold text-gray-900 mb-4">{{ $caseStudy->duration }}</p>
                        @endif
                        @if($caseStudy->hyperlink)
                            <a href="{{ $caseStudy->hyperlink }}" class="ki-card-link mb-6" target="_blank" rel="noopener noreferrer">Visit project</a>
                        @endif
                        <a href="{{ route('contact', ['ref' => $caseStudy->slug]) }}" class="ki-btn ki-btn-block">Talk about a similar project</a>
                    </div>
                </aside>
            </div>

            @if($related->count() > 0)
                <section class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Related case studies</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($related as $relatedStudy)
                            <x-case-study-card :case-study="$relatedStudy" />
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="ki-case-cta mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Have a similar challenge?</h2>
                <p class="text-gray-600 mb-6 max-w-2xl">Tell us about the system, intake, or website you need built. Mention this case study so we start from the same context.</p>
                <a href="{{ route('contact', ['ref' => $caseStudy->slug]) }}" class="ki-btn">Talk about a similar project</a>
            </div>
        </div>
    </article>
</x-app-layout>
