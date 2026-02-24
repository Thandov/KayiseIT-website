<x-app-layout title="Student Portal">
    <div class="min-h-screen bg-slate-50 pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Welcome back, {{ Auth::user()->name }}!
                </h1>
                <p class="mt-2 text-gray-600">
                    Your student portal for KAYISE IT training programs and resources.
                </p>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('profile.edit') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">My Profile</h3>
                            <p class="text-sm text-gray-500">Update your information</p>
                        </div>
                    </div>
                </a>

                @if(Route::has('internship_application'))
                <a href="{{ route('internship_application') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Internship</h3>
                            <p class="text-sm text-gray-500">{{ $internshipApplication ? 'View application' : 'Apply now' }}</p>
                        </div>
                    </div>
                </a>
                @endif

                <a href="{{ route('announcements') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Announcements</h3>
                            <p class="text-sm text-gray-500">Latest updates</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('blogs') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Blog & Resources</h3>
                            <p class="text-sm text-gray-500">Articles & guides</p>
                        </div>
                    </div>
                </a>

                @if(Route::has('certification.form'))
                <a href="{{ route('certification.form') }}" class="block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 010-4.438 3.42 3.42 0 001.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900">Request Certificate</h3>
                            <p class="text-sm text-gray-500">Download your training certificate</p>
                        </div>
                    </div>
                </a>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Announcements --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Announcements</h2>
                    </div>
                    <div class="p-6">
                        @if($announcements->count() > 0)
                            <ul class="space-y-4">
                                @foreach($announcements as $announcement)
                                <li>
                                    <a href="{{ route('announcements') }}" class="block group">
                                        <h4 class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $announcement->title ?? 'Announcement' }}</h4>
                                        <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($announcement->message ?? $announcement->description ?? ''), 100) }}</p>
                                        <span class="inline-block mt-2 text-xs text-blue-600 font-medium">View all →</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No announcements at the moment. Check back later!</p>
                        @endif
                    </div>
                </div>

                {{-- Recent Blogs --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-900">Latest from the Blog</h2>
                    </div>
                    <div class="p-6">
                        @if($recentBlogs->count() > 0)
                            <ul class="space-y-4">
                                @foreach($recentBlogs as $blog)
                                <li>
                                    <a href="{{ route('blogs.displayblog', $blog->id) }}" class="block group">
                                        <h4 class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors">{{ $blog->title ?? 'Blog Post' }}</h4>
                                        <span class="inline-block mt-2 text-xs text-blue-600 font-medium">Read more →</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No blog posts yet. Stay tuned!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
    @endpush
</x-app-layout>
