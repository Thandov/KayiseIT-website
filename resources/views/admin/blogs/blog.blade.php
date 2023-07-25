<!-- blog.blade.php -->

<x-app-layout>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Blog Posts</div>
                    <div class="card-body">
                        <ul>
                            @foreach($blogs as $blog)
                                <li>
                                    <h3>{{ $blog->title }}</h3>
                                    <p>{{ $blog->subtitle }}</p>
                                    <p>{{ $blog->content }}</p>
                                    @if($blog->icon)
                                        <img src="{{ asset('images/' . $blog->icon) }}" alt="Blog Icon" width="100">
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
