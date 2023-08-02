<x-app-layout>
    <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-4 gap-4">
            @foreach($blogs as $blog)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative">
                <span class="absolute top-0 left-0 bg-gray-800 text-white px-2 py-1 rounded-tr-lg text-xs font-semibold">{{ date('d M Y', strtotime($blog->created_at)) }}</span>
                <img class="w-full h-32 object-cover" src="{{ asset($blog->icon) }}" alt="Blog Image">
                <div class="px-4 py-2">
                    <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">{{ $blog->category }}</span>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-2">{{ $blog->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $blog->subtitle }}</p>
                </div>
                <div class="grid grid-cols-2 items-center justify-between">
                    <a href="/blogs/viewblog/{{$blog->id}}" class="bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>