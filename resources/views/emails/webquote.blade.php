<x-mail::message>
# PuPuPuPu It Works Dawg

@if($pages == 1)
        it works dawg {{ $type }}
        @endif
        @if($pages == 2)
            Website Type: {{ $type }}
        @endif

Number Of Pages: {{ $pages }} = R{{ $pages_price }}

Hosting: {{ $hosting }} = R{{ $hosting_price }}

Maintenance: {{ $maintenance }} = R{{ $maintenance_price }}

Total = R{{ $total }}

<x-mail::button :url="'http://127.0.0.1:8000/'">
visit our website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
