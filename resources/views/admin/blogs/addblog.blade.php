<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('breadcrumb')
        <h6 class=" mb-3 font-bold text-5xl md:text-2xl">Add New Post</h6>
        @include('../admin/blogs/_blog-form', ['route' => 'dashboard.blogs.storeblog-form'])
    </div>

</x-app-layout>

<script>
    ClassicEditor
        .create(document.querySelector('#task-textarea'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#task-textarea2'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>