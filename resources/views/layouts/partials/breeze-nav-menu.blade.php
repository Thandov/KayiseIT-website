@php
    $responsive = $responsive ?? false;
@endphp

@foreach ($menuItems as $item)
    @if (($item['type'] ?? 'link') === 'dropdown' && ! empty($item['children']))
        @if ($responsive)
            <div class="px-4 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                {{ $item['label'] }}
            </div>
            @foreach ($item['children'] as $child)
                <a
                    href="{{ $child['href'] }}"
                    @if($child['openInNewTab'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                    class="kayise-nav-link-mobile {{ ($activeRoutes[$child['activeKey'] ?? ''] ?? false) ? 'is-active' : '' }}"
                >
                    {{ $child['label'] }}
                </a>
            @endforeach
        @else
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button
                        type="button"
                        class="kayise-nav-trigger {{ ($activeRoutes[$item['activeKey'] ?? ''] ?? false) ? 'is-active' : '' }}"
                    >
                        <span>{{ $item['label'] }}</span>
                        <svg class="ms-1 h-4 w-4 shrink-0 opacity-80" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    @foreach ($item['children'] as $child)
                        <x-dropdown-link
                            :href="$child['href']"
                            :target="$child['openInNewTab'] ?? false ? '_blank' : false"
                            :rel="($child['openInNewTab'] ?? false) ? 'noopener noreferrer' : false"
                        >
                            {{ $child['label'] }}
                        </x-dropdown-link>
                    @endforeach
                </x-slot>
            </x-dropdown>
        @endif
    @elseif (($item['type'] ?? 'link') === 'certification')
        @if ($responsive)
            <a
                href="{{ $item['href'] }}"
                @if(!empty($item['title'])) title="{{ $item['title'] }}" @endif
                class="navbar-cert-urgent mx-4 {{ ($activeRoutes[$item['activeKey'] ?? ''] ?? false) ? 'ring-2 ring-white/80' : '' }}"
            >
                <span>{{ $item['label'] }}</span>
                @if (!empty($item['badge']))
                    <span class="navbar-cert-badge">{{ $item['badge'] }}</span>
                @endif
            </a>
        @else
            <a
                href="{{ $item['href'] }}"
                @if(!empty($item['title'])) title="{{ $item['title'] }}" @endif
                class="navbar-cert-urgent shrink-0 {{ ($activeRoutes[$item['activeKey'] ?? ''] ?? false) ? 'ring-2 ring-white/80' : '' }}"
            >
                <span>{{ $item['label'] }}</span>
                @if (!empty($item['badge']))
                    <span class="navbar-cert-badge">{{ $item['badge'] }}</span>
                @endif
            </a>
        @endif
    @else
        @if ($responsive)
            <a
                href="{{ $item['href'] }}"
                @if($item['openInNewTab'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                class="kayise-nav-link-mobile {{ ($activeRoutes[$item['activeKey'] ?? ''] ?? false) ? 'is-active' : '' }}"
            >
                {{ $item['label'] }}
            </a>
        @else
            <a
                href="{{ $item['href'] }}"
                @if($item['openInNewTab'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                class="kayise-nav-link {{ ($activeRoutes[$item['activeKey'] ?? ''] ?? false) ? 'is-active' : '' }}"
            >
                {{ $item['label'] }}
            </a>
        @endif
    @endif
@endforeach
