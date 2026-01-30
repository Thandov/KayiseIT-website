<div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Blogs</h3>
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All our blogs.</p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="ml-auto">
                        <x-front-end-btn linking="{{route('categories')}}" color="blue" showme="" name="Categories" />
                        <x-front-end-btn linking="{{ route('dashboard.blogs.addblog') }}" color="blue" showme="add-blog-btn" name="Add Blog" />
                    </div>
                </div>
                <div class="md:grid md:grid-cols-4 gap-4">
                    @foreach ($blogs as $blog)
                    <div class="max-w-sm rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative">
                        <span class="absolute top-0 left-0 bg-gray-800 text-white px-2 py-1 rounded-tr-lg text-xs font-semibold">{{ date('d M Y', strtotime($blog->created_at)) }}</span>
                        <img class="w-full h-32 object-cover" src="{{ asset($blog->icon) }}" alt="Blog Image">
                        <div class="px-4 py-2">
                            <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">{{ $blog->category }}</span>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $blog->subtitle }}</p>
                        </div>
                        <div class="grid grid-cols-2 items-center justify-between">
                            <a href="/admin/blogs/viewblog_edit/{{$blog->id}}" class="bg-indigo-600 px-12 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                            <form action="{{ url('/blog/delete', $blog->id) }}" method="get" onsubmit="return confirm('Are you sure you want to delete this Blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 px-12 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>