<x-app-layout title="carousel Dashboard">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
            <div class="p-6 bg-white border-b border-gray-200">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/admin/admin_dashboard" class="ml-1 text-sm font-medium inline-flex">
                                <svg class="mr-2 w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard</a>
                        </li>
                        <a href="/admin/carousel/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Carousel
                        </a>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">New Slide</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.carousel.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form goes here -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-3">
                    <div class="grid grid-row-3 gap-4 px-4 sm:px-6">
                        <div class="col">
                            <label for="head_title" class="block text-sm font-medium text-gray-700">Main Text</label>
                            <input type="text" name="head_title" id="head_title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('middletxt') border-red-500 @enderror" value="{{ old('head_title') }}">
                            @error('head_title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="middletxt" class="block text-sm font-medium text-gray-700">Middle Text</label>
                            <input type="text" name="middletxt" id="middletxt" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('middletxt') border-red-500 @enderror" value="{{ old('middletxt') }}">
                            @error('middletxt')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="btmtxt" class="block text-sm font-medium text-gray-700">Middle Text</label>
                            <input type="text" name="btmtxt" id="btmtxt" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('btmtxt') border-red-500 @enderror" value="{{ old('btmtxt') }}">
                            @error('btmtxt')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-2">
                    <x-img-upload image="" classing="bigTall" />
                </div>

            </div>
        </div>
        <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-3">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </div>
        <!-- Form ends here -->
</x-app-layout>