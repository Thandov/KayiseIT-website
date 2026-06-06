@php
    $pageTitle = ($blog->meta_title ?: ($blog->title ?? 'Blog')).' | KAYISE IT';
    if (! empty($blog->meta_description)) {
        $pageDesc = $blog->meta_description;
    } else {
        $pageDesc = \Illuminate\Support\Str::limit(trim(strip_tags($blog->subtitle ?? '')), 140);
        $pageDesc = $pageDesc !== '' ? $pageDesc.' Read on KAYISE IT.' : 'Read this article on KAYISE IT.';
    }
    $ogImage = ! empty($blog->icon) && $blog->icon !== 'null' ? $blog->icon : null;
@endphp
<x-app-layout
    :title="$pageTitle"
    :description="$pageDesc"
    keywords="KAYISE IT blog, ICT, technology South Africa"
    :og-image="$ogImage"
>
    <div class="flex justify-center py-8 px-2 bg-gray-50 min-h-screen">
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-lg overflow-hidden">
            @if($blog->icon ?? '')
                <div class="w-full h-64 md:h-80 overflow-hidden flex items-center justify-center bg-gray-100">
                    <img src="{{ asset($blog->icon) ?? '' }}" alt="" class="object-cover w-full h-full" style="max-width: 100%; max-height: 100%;">
                </div>
            @endif
            <div class="p-8">
                <h1 class="text-center mb-6 font-extrabold text-3xl md:text-4xl text-green-600">{{ $blog->title ?? '' }}</h1>
                <div class="prose max-w-none prose-green prose-lg mx-auto">
                    {!! $blog->content ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
