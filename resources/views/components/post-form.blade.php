@php
$decodedString = htmlspecialchars_decode($post);
//Convert the regular string to an array using json_decode
$post = json_decode($decodedString);
@endphp


<form method="post" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    <div class="grid md:grid-cols-12 gap-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-9">
            <div class="m-3">
                <textarea name="content" id="task-textarea" value="{{ $post->content }}" class="form-control">{{ $post->content }}</textarea>
            </div>
        </div>
        <div class="md:col-span-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-4 md:grid md:grid-row-3 gap-4">
                <div class="">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" value="{{ $post->title ?? '' }}" name="title" id="title" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                    @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="subtitle" class="block text-sm font-medium text-gray-700">Sub Title</label>
                    <input type="text" value="{{ $post->subtitle }}" name="subtitle" id="subtitle" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('subtitle') border-red-500 @enderror" value="{{ old('subtitle') }}">
                    @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <x-img-upload image="{{$post->icon ?? ''}}" classing="bigTall" />
                <select name="subtitle2" id="subtitle2" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select a category</option>
                    @php
                    $postCategories = App\Models\PostCategories::all();
                    @endphp
                    @foreach($postCategories as $category)
                    <option value="{{ $category->id }}" @if(!empty($post->category_no) && $post->category_no == $category->id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <x-front-end-btn linking="{{$buttonlinking}}" color="{{$buttoncolor}}" showme="{{$buttonshowme}}" name="{{$buttonname}}" />
            </div>
        </div>
    </div>
</form>