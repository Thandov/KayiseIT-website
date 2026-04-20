@props(['iconKey' => 'monitor'])
@php
    $key = in_array($iconKey, \App\Models\AcademyCourse::ICON_KEYS, true) ? $iconKey : 'monitor';
@endphp
<svg {{ $attributes->merge(['class' => 'w-6 h-6']) }} style="color:#16A34A;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    @switch($key)
        @case('monitor')
            <path d="M4 4h16v12H4z"></path>
            <path d="M8 20h8"></path>
            @break
        @case('drone_hex')
            <path d="M12 2l8 8-8 8-8-8z"></path>
            @break
        @case('document')
            <path d="M4 4h16v16H4z"></path>
            <path d="M8 8h8M8 12h8M8 16h5"></path>
            @break
        @case('bars')
            <path d="M4 6h16M4 12h10M4 18h7"></path>
            @break
        @case('shield')
            <path d="M12 2l8 4v6c0 5-3.4 8.6-8 10-4.6-1.4-8-5-8-10V6z"></path>
            @break
        @case('plus')
            <path d="M12 3v18M3 12h18"></path>
            @break
        @default
            <path d="M4 4h16v12H4z"></path>
            <path d="M8 20h8"></path>
    @endswitch
</svg>
