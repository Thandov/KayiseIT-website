@extends('admin.dashboard.layout')

@section('page-title', 'Blogs')

@section('content')
    <div class="ki-page">
        <div class="ki-toolbar">
            <div class="ki-toolbar-start min-w-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
                    <p class="text-sm text-gray-600 mt-1">Stories on the website. Turn on carousel to also show a post on the homepage.</p>
                </div>
            </div>
            <div class="ki-toolbar-end">
                <a href="{{ route('dashboard.blogs.categories') }}" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                    Categories
                </a>
                <a href="{{ route('dashboard.blogs.addblog') }}" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600">
                    New post
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($blogs->isEmpty())
            <div class="ki-panel text-center py-12">
                <p class="text-base font-semibold text-gray-900">No posts yet</p>
                <p class="text-sm text-gray-500 mt-1">Write the first story, then optionally send it to the homepage carousel.</p>
                <a href="{{ route('dashboard.blogs.addblog') }}" class="inline-flex items-center mt-6 px-4 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600">
                    New post
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    @php
                        $cover = method_exists($blog, 'coverUrl') ? $blog->coverUrl() : ($blog->icon ? asset($blog->icon) : null);
                        $isSlide = method_exists($blog, 'isCarouselSlide') && $blog->isCarouselSlide();
                        $categoryName = optional($blog->category)->category_name;
                    @endphp
                    <article class="overflow-hidden flex flex-col bg-white border border-gray-200 rounded-xl">
                        <div class="relative aspect-video bg-slate-200">
                            @if($cover)
                                <img src="{{ $cover }}" alt="" class="absolute inset-0 h-full w-full object-cover">
                            @endif
                            <div class="absolute top-2 left-2 flex flex-wrap items-center gap-1">
                                <span class="rounded-full bg-white/95 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-gray-700">
                                    {{ $blog->created_at?->format('d M Y') }}
                                </span>
                                @if($isSlide)
                                    <span class="rounded-full bg-kb-100 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-white">
                                        Carousel
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-6 ki-stack-tight flex-1">
                            @if($categoryName)
                                <p class="text-xs font-semibold uppercase tracking-wide text-kb-500">{{ $categoryName }}</p>
                            @endif
                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">{{ $blog->title }}</h2>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $blog->subtitle }}</p>

                            <form action="{{ route('dashboard.blogs.carousel-slide', $blog->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="as_carousel_slide" value="{{ $isSlide ? '0' : '1' }}">
                                <button type="submit" class="inline-flex items-center gap-2 text-sm font-medium {{ $isSlide ? 'text-kb-600' : 'text-gray-600 hover:text-gray-900' }}">
                                    <span class="relative inline-flex h-5 w-9 shrink-0 rounded-full {{ $isSlide ? 'bg-kb-100' : 'bg-gray-300' }}">
                                        <span class="absolute top-0.5 {{ $isSlide ? 'left-4' : 'left-0.5' }} h-4 w-4 rounded-full bg-white shadow"></span>
                                    </span>
                                    {{ $isSlide ? 'On the homepage carousel' : 'Add to homepage carousel' }}
                                </button>
                            </form>
                        </div>
                        <div class="px-6 py-3 border-t border-gray-100 flex items-center justify-between gap-2">
                            <a href="{{ route('dashboard.blogs.viewblog_edit', $blog->id) }}" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.destroyblog', $blog->id) }}" method="get" onsubmit="return confirm('Delete this post? The homepage carousel slide will also be removed.');">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-semibold text-white bg-red-600 hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection
