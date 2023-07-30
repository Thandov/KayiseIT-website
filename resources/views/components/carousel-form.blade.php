@php
$decodedString = htmlspecialchars_decode($slides);

// Convert the regular string to an array using json_decode
$slides = json_decode($decodedString);
@endphp
<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$slides->id}}">
    <!-- Form goes here -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-3">
                <div class="grid grid-row-3 gap-4 px-4 sm:px-6">
                    <div class="col">
                        <label for="head_title" class="block text-sm font-medium text-gray-700">Main Text</label>
                        <input type="text" value="{{$slides->title ?? ''}}" name="head_title" id="head_title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('middletxt') border-red-500 @enderror" value="{{ old('head_title') }}">
                        @error('head_title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="middletxt" class="block text-sm font-medium text-gray-700">Middle Text</label>
                        <input type="text" value="{{$slides->middletxt ?? ''}}" name="middletxt" id="middletxt" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('middletxt') border-red-500 @enderror" value="{{ old('middletxt') }}">
                        @error('middletxt')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="btmtxt" class="block text-sm font-medium text-gray-700">Bottom Text</label>
                        <input type="text" value="{{$slides->btmtxt ?? ''}}" name="btmtxt" id="btmtxt" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('btmtxt') border-red-500 @enderror" value="{{ old('btmtxt') }}">
                        @error('btmtxt')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-2">
                <x-img-upload image="{{$slides->image}}" classing="bigTallest" />
            </div>

        </div>
    </div>
    <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200 md:col-span-3">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
        </div>
    </div>
    <!-- Form ends here -->