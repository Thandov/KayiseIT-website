<!-- blog.blade.php -->

<x-app-layout>
    <div class="flex justify-center py-8 px-2 bg-gray-50 min-h-screen">
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-lg overflow-hidden">
            @if($blog->icon ?? '')
                <div class="w-full h-64 md:h-80 overflow-hidden flex items-center justify-center bg-gray-100">
                    <img src="{{ asset($blog->icon) ?? '' }}" alt="Blog Icon" class="object-cover w-full h-full" style="max-width: 100%; max-height: 100%;">
                </div>
            @endif
            <div class="p-8">
                <p class="text-center text-xs font-bold uppercase tracking-[0.18em] text-green-700 mb-3">Recap</p>
                <h1 class="text-center mb-4 font-extrabold text-3xl md:text-4xl text-green-600">{{ $blog->title ?? '' }}</h1>
                @if(filled($blog->subtitle ?? null))
                    <p class="text-center text-lg text-gray-600 leading-relaxed mb-8 max-w-2xl mx-auto">{{ $blog->subtitle }}</p>
                @endif
                <div class="prose max-w-none prose-green prose-lg mx-auto">
                    {!! $blog->content ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>