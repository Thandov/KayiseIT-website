<!-- partials.carousels.blade.php -->
@foreach ($carousels as $carousel)
@php
    $template = method_exists($carousel, 'templateKey') ? $carousel->templateKey() : 'classic';
    $templateLabel = method_exists($carousel, 'templateMeta') ? $carousel->templateMeta()['label'] : 'Classic overlay';
    $pic = $carousel->image ?? '';
    if ($pic && ! str_starts_with($pic, 'http')) {
        $pic = asset(ltrim(preg_replace('#^\.\./#', '', $pic), '/'));
    }
@endphp
<div class="relative group overflow-hidden rounded-xl shadow-sm border border-gray-200 bg-slate-900" style="background-image: url('{{ $pic }}'); height: 250px; background-position: center; background-size:cover">
    <div class="absolute inset-0 {{ $template === 'campaign' ? 'bg-gradient-to-t from-black/70 via-black/10 to-transparent' : 'bg-black/50' }}"></div>

    <span class="absolute top-2 left-2 z-50 flex flex-wrap items-center gap-1">
        <span class="rounded-full bg-white/95 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-gray-700">
            {{ $templateLabel }}
        </span>
        @if(! empty($carousel->from_blog))
            <span class="rounded-full bg-kb-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-white">
                From blog
            </span>
        @endif
    </span>

    <div class="absolute top-2 right-2 z-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        <div class="flex space-x-1">
            <a href="{{ route('admin.dashboard.carousel.show', $carousel->id) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="View">
                <i class="fas fa-eye text-xs"></i>
            </a>
            <a href="{{ route('admin.dashboard.carousel.edit', $carousel->id) }}"
               class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
               title="Edit">
                <i class="fas fa-edit text-xs"></i>
            </a>
            <form action="{{ route('admin.dashboard.carousel.destroy', $carousel->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg transition-colors duration-200"
                        title="Delete"
                        onclick="return confirm('Are you sure you want to delete this slide?')">
                    <i class="fas fa-trash text-xs"></i>
                </button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.dashboard.carousel.edit', $carousel->id) }}">
        <div class="rounded-lg h-full flex flex-col justify-end items-start absolute p-4 z-40 inset-0">
            <p class="text-white text-base font-semibold leading-tight">{{ $carousel->middletxt ?: ($carousel->title ?? '') }}</p>
            @if($carousel->btmtxt && $template !== 'campaign')
                <p class="text-white/80 text-sm mt-1 line-clamp-2">{{ $carousel->btmtxt }}</p>
            @endif
        </div>
    </a>
</div>
@endforeach
