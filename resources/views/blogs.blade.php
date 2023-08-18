<x-app-layout>
    <x-breadcrumb></x-breadcrumb>

    
    <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        <!-- Display the most recently added blog -->
        <h1 style="color: #64bc5c" class="mb-6 font-bold text-4xl md:text-4xl">Latest Post</h1>
        @if($blogs->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="max-w-md rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative mb-4">
                <img class="w-full h-400 object-cover" src="{{ asset($blogs->first()->icon) }}" alt="Blog Image">
            </div>
            <div class="max-w-md rounded-lg overflow-hidden  bg-gray dark:bg-gray-800 relative mb-4">
                <!-- Content for the second card -->
                <div class="px-4 py-2">
                    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mt-2">{{ $blogs->first()->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $blogs->first()->subtitle }}</p>
                    <div class="grid grid-cols-2 items-center justify-between mt-4">
                        <a href="/viewblog/{{$blogs->first()->id}}" class="bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <h3 style="color: #090a09" class="mb-8 font-bold text-3xl md:text-3xl">Trending </h3>
        <div class="md:grid md:grid-cols-4 gap-4">
            @foreach($blogs->skip(1) as $relatedBlog)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative">
                <span class="absolute top-0 left-0 bg-gray-800 text-white px-2 py-1 rounded-tr-lg text-xs font-semibold">{{ date('d M Y', strtotime($relatedBlog->created_at)) }}</span>
                <img class="w-full h-32 object-cover" src="{{ asset($relatedBlog->icon) }}" alt="Blog Image">
                <div class="px-4 py-2">
                    <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">{{ $relatedBlog->category }}</span>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-2">{{ $relatedBlog->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $relatedBlog->subtitle }}</p>
                </div>
                <div class="grid grid-cols-2 items-center justify-between">
                    <a href="/viewblog/{{$relatedBlog->id}}" class="bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">View More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
