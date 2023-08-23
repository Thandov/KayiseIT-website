<!-- blog.blade.php -->

<x-app-layout>
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h1 style="color: #64bc5c" class="text-center mb-3 font-bold text-5xl md:text-5xl">{{ $blog->title ?? ''}}</h1>
                    <h6 style="color: #070707" class="text-center mb-5 font-italic text-2xl md:text-2xl">{{ $blog->subtitle ?? ''}}</h6>
                    <h4 class="text-center mb-8">Author: Mary Jane Doe/ Created at: 27 August 2023</h4>
                    @if($blog->icon)
                        <img src="{{ asset( $blog->icon) }}" alt="Blog Icon" class="card-img-top" style="max-width: 100%; max-height: 500px;">
                    @endif
                    <div class="row">
                      
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">{!! $blog->content ?? '' !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-12">
                            <h6 style="color: #0a0a0a" class="text-center mb-5 font-italic text-2xl md:text-2xl">Related Articles</h6>
                            <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
                                @foreach($blogs as $relatedBlog)
                                <div class="max-w-sm rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative mb-3">
                                  <span class="absolute top-0 left-0 bg-gray-800 text-white px-2 py-1 rounded-tr-lg text-xs font-semibold">{{ date('d M Y', strtotime( $relatedBlog->created_at)) }}</span>
                                                <img class="w-full h-32 object-cover" src="{{ asset( $relatedBlog->icon) }}" alt="Blog Image">
                                                <div class="px-4 py-2">
                                                    <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">{{ $relatedBlog->category }}</span>
                                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-2">{{ $relatedBlog->title }}</h3>
                                                    <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $relatedBlog->subtitle }}</p>
                                                </div>
                                                <div class="grid grid-cols-2 items-center justify-between">
                                                    <a href="/viewblog/{{ $relatedBlog->id}}" class="bg-white-600 px-3 py-2 text-sm font-semibold text-primary shadow-sm hover:bg-grey-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-grey-600">Read More
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                      </div>             
            </div>
        </div>
    </div>

   
</x-app-layout>


