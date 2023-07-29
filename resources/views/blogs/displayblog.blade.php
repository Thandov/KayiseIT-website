<!-- blog.blade.php -->

<x-app-layout>
    <div class="p-0 m-0">
        @if($blog->icon)
        <div class="header">
            <div class="himg"><img src="{{ asset($blog->icon) }}" alt="Blog Icon" class="card-img-top" style="max-width: 830px; max-height: 400px;"></div>
            <div class="hcont">Text</div>
        </div>
        @endif
        <div class="contbody">
            <h2 style="color: #64bc5c" class="text-center mb-5 font-bold text-5xl md:text-5xl">{{ $blog->title }}</h2>
            <p class="card-text">{!! $blog->content !!}</p>
        </div>
    </div>
</x-app-layout>