@extends('admin.dashboard.layout')

@section('page-title', 'View slide')

@section('content')
    <div class="p-6">
        @php
            $template = $carousel->templateKey();
            $meta = $carousel->templateMeta();
            $pic = $carousel->image ?? '';
            if ($pic && ! str_starts_with($pic, 'http')) {
                $pic = asset(ltrim(preg_replace('#^\.\./#', '', $pic), '/'));
            }
        @endphp

        <div class="mb-6 flex items-start justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $carousel->title ?: 'Untitled slide' }}</h2>
                <p class="text-sm text-gray-600">{{ $meta['label'] }} · {{ $meta['tagline'] }}</p>
            </div>
            <a href="{{ route('admin.dashboard.carousel.edit', $carousel->id) }}"
               class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600">
                Edit slide
            </a>
        </div>

        <div class="rounded-xl overflow-hidden border border-gray-200 bg-slate-950 aspect-video relative mb-6">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $pic }}');"></div>
            <div class="absolute inset-0 {{ $template === 'classic' ? 'bg-black/60' : ($template === 'editorial' ? 'bg-gradient-to-t from-black/80 via-black/20 to-black/10' : 'bg-gradient-to-t from-black/50 via-transparent to-transparent') }}"></div>
            <div class="absolute inset-0 p-8 flex {{ $template === 'classic' ? 'items-center' : 'items-end' }}">
                <div class="max-w-xl">
                    @if($template !== 'campaign' && $carousel->title)
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-green-300 mb-2">{{ $carousel->title }}</p>
                    @endif
                    @if($carousel->middletxt)
                        <p class="text-white font-extrabold text-2xl leading-tight">{{ $carousel->middletxt }}</p>
                    @endif
                    @if($carousel->btmtxt)
                        <p class="text-gray-300 mt-2">{{ $carousel->btmtxt }}</p>
                    @endif
                    @if($carousel->destinationUrl())
                        <span class="mt-4 inline-flex rounded-full bg-green-500 px-4 py-2 text-sm font-bold text-green-950">{{ $carousel->destinationLabel() }}</span>
                    @endif
                </div>
            </div>
        </div>

        @if($carousel->destinationUrl())
            <p class="text-sm text-gray-600">Opens: <a class="text-kb-100 underline" href="{{ $carousel->destinationUrl() }}" target="_blank" rel="noopener">{{ $carousel->destinationUrl() }}</a></p>
        @endif
    </div>
@endsection
