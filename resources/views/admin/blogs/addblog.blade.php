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
                        <!--                         <a href="/admin/staff/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Staff
                        </a> -->
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">Blogs</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>


        <form name="businessdash" id="businessdash" action="{{ route('admin.blogs.storeblog-form') }}" method="post" enctype="multipart/form-data" class="px-3 py-3">
            @csrf
            <div class="grid md:grid-cols-12 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-9">
                    <div class="m-3 row">
                        <label for="logo" class="col-sm-3 form-label fw-bold text-md-end">Icon:</label>
                        <div class="col-sm-9">
                            <input name="icon" class="form-control" type="file" id="logo">
                        </div>
                    </div>
                    <div class="m-3 row">
                        <label for="title" class="col-sm-3 form-label fw-bold text-md-end">Title:</label>
                        <div class="col-sm-9">
                            <input type="title" name="title" id="title" class="form-control" />
                        </div>
                    </div>
                    <div class="m-3 row">
                        <label for="subtitle" class="col-sm-3 form-label fw-bold text-md-end">Sub Title:</label>
                        <div class="col-sm-9">
                            <input type="title" name="subtitle" id="subtitle" class="form-control" />
                        </div>
                    </div>
                    <div class="m-3 row">
                        <label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="content" id="task-textarea" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-4">
                        <select name="subtitle2" id="subtitle2" class="form-control">
                            <option value="">Select a category</option>
                            @foreach($postCategories as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                            @endforeach
                        </select>
                        <x-img-upload image="" classing="bigTall" />
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