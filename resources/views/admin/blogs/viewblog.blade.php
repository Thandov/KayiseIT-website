<!-- blog.blade.php -->

<x-app-layout>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    @if($blog->icon ?? '')
                    <img src="{{ asset('images/' . $blog->icon) }}" alt="Blog Icon" class="card-img-top" style="max-width: 830px; max-height: 400px;">
                    @endif
                    <div class="card-body">
                        <h2 style="color: #64bc5c" class="text-center mb-5 font-bold text-5xl md:text-5xl">{{ $blog->title ?? ''}}</h2>
                        <p class="card-text">{!! $blog->content ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>