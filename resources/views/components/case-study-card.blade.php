@props([
    'caseStudy',
    'index' => null,
    'openModal' => false,
])

@php
    $href = route('case-studies.index', ['study' => $caseStudy->slug]);
    $image = $caseStudy->coverImageUrl();
    $label = $caseStudy->client_name ?: $caseStudy->title;
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->class(['ki-case-image-card']) }}
    @if($openModal)
        @click.prevent="$dispatch('open-case-study', { slug: '{{ $caseStudy->slug }}' })"
    @endif
>
    <div class="ki-case-image-card-media">
        <img src="{{ $image }}" alt="{{ $label }}" loading="lazy">
        <div class="ki-case-image-card-scrim" aria-hidden="true"></div>
        <span class="ki-case-image-card-badge">{{ $caseStudy->typeBadge() }}</span>
        @if($caseStudy->year)
            <span class="ki-case-image-card-year">{{ $caseStudy->year }}</span>
        @endif
    </div>
    <div class="ki-case-image-card-body">
        <h3 class="ki-case-image-card-title">{{ $label }}</h3>
        @if($caseStudy->primaryResult())
            <p class="ki-case-image-card-result">{{ $caseStudy->primaryResult() }}</p>
        @endif
        <span class="ki-case-image-card-cta">View</span>
    </div>
</a>
