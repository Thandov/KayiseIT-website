<x-app-layout>
    <x-page-header
        title="Case studies"
        subtitle="Completed work"
        description="Stories of problems we finished, with the numbers clients can take into a meeting."
        hero-id="case-studies-hero"
        background-image="images/KayiseIT-Team.jpg"
        height="h-96" />

    <section
        class="bg-white py-16"
        x-data="caseStudyModal(@js($modalStudies ?? []), @js($openStudy))"
        @open-case-study.window="openBySlug($event.detail.slug)"
        @keydown.escape.window="close()"
        @keydown.left.window="if (open) prev()"
        @keydown.right.window="if (open) next()"
    >
        <div class="container mx-auto px-4 max-w-7xl">
            @if($featured)
                <a
                    href="{{ route('case-studies.index', ['study' => $featured->slug]) }}"
                    class="ki-case-featured-image"
                    @click.prevent="openBySlug('{{ $featured->slug }}')"
                >
                    <img src="{{ $featured->coverImageUrl() }}" alt="{{ $featured->client_name ?: $featured->publicHeadline() }}">
                    <div class="ki-case-featured-image-body">
                        <span class="ki-kicker ki-kicker-left">Featured</span>
                        <p class="ki-media-date mb-2">
                            {{ collect([$featured->client_name, $featured->sector, $featured->year])->filter()->join(' · ') }}
                        </p>
                        <h2>{{ $featured->client_name ?: $featured->publicHeadline() }}</h2>
                        @if($featured->primaryResult())
                            <p class="ki-case-featured-image-result">{{ $featured->primaryResult() }}</p>
                        @endif
                        <span class="ki-case-image-card-cta">View case study</span>
                    </div>
                </a>
            @endif

            @if($caseStudies->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 {{ $featured ? 'mt-12' : '' }}">
                    @foreach($caseStudies as $index => $caseStudy)
                        <x-case-study-card
                            :case-study="$caseStudy"
                            :open-modal="true"
                            :index="str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)" />
                    @endforeach
                </div>
            @elseif(! $featured)
                <div class="text-center py-16">
                    <p class="text-gray-600 mb-6">Case studies will appear here once they are published from the dashboard.</p>
                    <a href="{{ route('contact') }}" class="ki-btn">Talk about a project</a>
                </div>
            @endif
        </div>

        {{-- Case study modal slider --}}
        <div
            x-show="open"
            x-cloak
            class="ki-case-modal"
            role="dialog"
            aria-modal="true"
            :aria-label="current ? (current.client || current.headline) : 'Case study'"
            @click.self="close()"
        >
            <div class="ki-case-modal-panel" x-show="current" x-transition>
                <button type="button" class="ki-case-modal-close" @click="close()" aria-label="Close">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <template x-if="current">
                    <div class="ki-case-modal-layout">
                        <div class="ki-case-modal-media">
                            <img :src="current.image" :alt="current.client || current.headline">
                        </div>
                        <div class="ki-case-modal-body">
                            <p class="ki-media-date" x-text="[current.sector, current.year, current.duration].filter(Boolean).join(' · ')"></p>
                            <h2 class="ki-case-modal-title" x-text="current.headline"></h2>
                            <p class="ki-case-modal-client" x-show="current.client" x-text="current.client"></p>

                            <div class="ki-case-modal-section" x-show="current.problem">
                                <h3>Challenge</h3>
                                <p x-text="current.problem"></p>
                            </div>
                            <div class="ki-case-modal-section" x-show="current.solution">
                                <h3>Approach</h3>
                                <p x-text="current.solution"></p>
                            </div>
                            <div class="ki-case-modal-section" x-show="current.resultItems && current.resultItems.length">
                                <h3>Results</h3>
                                <ul class="ki-card-list">
                                    <template x-for="(item, i) in current.resultItems" :key="i">
                                        <li x-text="item"></li>
                                    </template>
                                </ul>
                            </div>
                            <blockquote class="ki-case-quote" x-show="current.quote">
                                <p x-text="current.quote"></p>
                                <footer x-show="current.quoteName || current.quoteRole">
                                    <cite x-text="current.quoteName || ''"></cite>
                                    <span x-text="current.quoteRole || ''"></span>
                                </footer>
                            </blockquote>

                            <div class="ki-case-modal-actions">
                                <a :href="current.contactUrl" class="ki-btn">Talk about a similar project</a>
                                <a :href="current.showUrl" class="ki-btn ki-btn-ghost">Open full page</a>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="ki-case-modal-nav" x-show="studies.length > 1">
                    <button type="button" class="ki-case-modal-nav-btn" @click="prev()" aria-label="Previous case study">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span>Previous</span>
                    </button>
                    <p class="ki-case-modal-count">
                        <span x-text="index + 1"></span> / <span x-text="studies.length"></span>
                    </p>
                    <button type="button" class="ki-case-modal-nav-btn" @click="next()" aria-label="Next case study">
                        <span>Next</span>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.caseStudyModal = function caseStudyModal(studies, initialSlug) {
            return {
                studies: studies || [],
                open: false,
                index: 0,
                get current() {
                    return this.studies[this.index] || null;
                },
                init() {
                    if (initialSlug) {
                        this.openBySlug(initialSlug);
                    }
                },
                openBySlug(slug) {
                    const i = this.studies.findIndex((s) => s.slug === slug);
                    if (i < 0) return;
                    this.index = i;
                    this.open = true;
                    document.body.style.overflow = 'hidden';
                    this.syncUrl();
                },
                close() {
                    this.open = false;
                    document.body.style.overflow = '';
                    const url = new URL(window.location.href);
                    url.searchParams.delete('study');
                    window.history.replaceState({}, '', url.pathname + url.search + url.hash);
                },
                next() {
                    if (!this.studies.length) return;
                    this.index = (this.index + 1) % this.studies.length;
                    this.syncUrl();
                },
                prev() {
                    if (!this.studies.length) return;
                    this.index = (this.index - 1 + this.studies.length) % this.studies.length;
                    this.syncUrl();
                },
                syncUrl() {
                    if (!this.current) return;
                    const url = new URL(window.location.href);
                    url.searchParams.set('study', this.current.slug);
                    window.history.replaceState({}, '', url.pathname + '?' + url.searchParams.toString());
                },
            };
        };
    </script>
</x-app-layout>
