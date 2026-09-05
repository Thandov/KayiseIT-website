@props([
    'index' => null,
    'title',
    'href' => null,
    'linkText' => 'View details',
    'items' => [],
])

<article {{ $attributes->merge(['class' => 'ki-card']) }}>
    @if($index)
        <span class="ki-card-index">{{ $index }}</span>
    @endif
    <h3 class="ki-card-title">{{ $title }}</h3>
    @if(!$slot->isEmpty())
        <div class="ki-card-body">{{ $slot }}</div>
    @endif
    @if(!empty($items))
        <ul class="ki-card-list">
            @foreach($items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    @endif
    {{ $footer ?? '' }}
    @if($href)
        <a href="{{ $href }}" class="ki-card-link">{{ $linkText }}</a>
    @endif
</article>
