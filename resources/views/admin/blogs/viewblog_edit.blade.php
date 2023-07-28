<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/dashboard" class="ml-1 text-sm font-medium inline-flex">
                                <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard</a>
                        </li>
                        <a href="/admin/blogs/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Blogs
                        </a>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">{{ $blog->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>


        <form method="post" action="{{ route('admin.blogs.viewblog_edit.update_blog', ['id' => $blog->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-12 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-9">
                    <div class="m-3 row">
                        <label for="title" class="col-sm-3 form-label fw-bold text-md-end">Title:</label>
                        <div class="col-sm-9">
                            <input type="title" name="title" id="title" class="form-control" value="{{ $blog->title }}" />
                        </div>
                    </div>
                    <div class="m-3 row">
                        <label for="subtitle" class="col-sm-3 form-label fw-bold text-md-end">Sub Title:</label>
                        <div class="col-sm-9">
                            <input type="title" name="subtitle" id="subtitle" class="form-control" value="{{ $blog->subtitle }}" />
                        </div>
                    </div>
                    <div class="m-3 row">
                        <label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label>
                        <div class="col-sm-9">
                            <textarea name="content" id="task-textarea" value="{{ $blog->contet }}" class="form-control">{{ $blog->content }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-4 md:grid md:grid-row-3 gap-4">
                        <x-img-upload image="{{$blog->icon}}" classing="bigTall" />
                        <select name="subtitle2" id="subtitle2" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select a category</option>
                            @php
                            $postCategories = App\Models\PostCategories::all();
                            @endphp
                            @foreach($postCategories as $category)
                            <option value="{{ $category->id }}" @if($blog->category_no == $category->id) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>


                        <x-front-end-btn linking="services" color="submit" showme="" name="Post" />

                    </div>
                </div>
            </div>
        </form>
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
</script>