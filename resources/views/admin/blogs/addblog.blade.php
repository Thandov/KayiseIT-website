@extends('admin.dashboard.layout')

@section('page-title', 'New post')

@section('content')
    <div class="ki-page">
        <div class="ki-toolbar">
            <div class="ki-toolbar-start min-w-0">
                <div>
                    <a href="{{ route('dashboard.blogs') }}" class="text-sm font-medium text-kb-500 hover:text-kb-600">← Posts</a>
                    <h1 class="text-2xl font-bold text-gray-900 mt-1">New post</h1>
                    <p class="text-sm text-gray-600 mt-1">Write the story, add a cover, then choose whether it should also appear on the homepage carousel.</p>
                </div>
            </div>
        </div>

        @include('admin.dashboard.blogs._form', [
            'blog' => $blog ?? null,
            'postCategories' => $postCategories ?? collect(),
            'isCarouselSlide' => $isCarouselSlide ?? false,
            'formAction' => route('dashboard.blogs.storeblog-form'),
            'submitLabel' => 'Publish post',
        ])
    </div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#blog-content'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .then((editor) => {
            const form = document.querySelector('#blog-content')?.closest('form');
            if (form) {
                form.addEventListener('submit', () => editor.updateSourceElement());
            }
        })
        .catch((error) => console.error(error));
</script>
@endpush
