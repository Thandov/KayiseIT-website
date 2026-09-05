@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'View Case Study')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $caseStudy->publicHeadline() }}</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ collect([$caseStudy->client_name, $caseStudy->sector, $caseStudy->year, $caseStudy->duration])->filter()->join(' · ') }}
                    </p>
                </div>
                <div class="ki-table-actions">
                    @if($caseStudy->slug && $caseStudy->is_active)
                    <a href="{{ route('case-studies.show', $caseStudy->slug) }}" target="_blank" rel="noopener"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        View on site
                    </a>
                    @endif
                    <a href="{{ route('dashboard.case-studies.edit', $caseStudy->id) }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Add photos / edit
                    </a>
                    <a href="{{ route('dashboard.case-studies.index') }}"
                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Back
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-8">
                @if($caseStudy->imageUrl())
                    <img src="{{ $caseStudy->imageUrl() }}" alt="{{ $caseStudy->title }}" class="w-full max-h-80 object-cover border border-gray-200">
                @else
                    <div class="border border-dashed border-gray-300 px-6 py-10 text-sm text-gray-500">
                        No cover photo yet.
                        <a href="{{ route('dashboard.case-studies.edit', $caseStudy->id) }}" class="text-indigo-600 hover:underline">Add one</a>
                    </div>
                @endif

                <div class="flex flex-wrap gap-2">
                    @if($caseStudy->is_active)
                        <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800">Published</span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800">Draft</span>
                    @endif
                    @if($caseStudy->is_featured)
                        <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800">Homepage</span>
                    @endif
                </div>

                <section>
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500 mb-2">What was going on</h3>
                    <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $caseStudy->problem }}</p>
                </section>

                <section>
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500 mb-2">What we did</h3>
                    <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $caseStudy->solution }}</p>
                </section>

                <section>
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500 mb-2">What changed</h3>
                    @if($caseStudy->results)
                        <p class="text-gray-800 leading-relaxed mb-4 whitespace-pre-line">{{ $caseStudy->results }}</p>
                    @endif
                    @if(count($caseStudy->resultItems()) > 0)
                        <ul class="space-y-2">
                            @foreach($caseStudy->resultItems() as $item)
                                <li class="text-gray-800">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </section>

                @if($caseStudy->quote)
                    <blockquote class="border-l-4 border-gray-300 pl-4 text-gray-800">
                        <p>{{ $caseStudy->quote }}</p>
                        @if($caseStudy->quote_name || $caseStudy->quote_role)
                            <p class="mt-2 text-sm text-gray-500">{{ collect([$caseStudy->quote_name, $caseStudy->quote_role])->filter()->join(', ') }}</p>
                        @endif
                    </blockquote>
                @endif

                <section>
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500 mb-3">Photos</h3>
                    @if($caseStudy->galleryImages->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($caseStudy->galleryImages as $image)
                                <img src="{{ $image->url() }}" alt="" class="w-full h-40 object-cover border border-gray-200">
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No extra photos yet. Use Edit to add screenshots or site photos.</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
