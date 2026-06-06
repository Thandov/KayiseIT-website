@php
    if (is_string($post)) {
        $post = json_decode(htmlspecialchars_decode($post)) ?? new \stdClass;
    }
    if (! is_object($post)) {
        $post = new \stdClass;
    }
@endphp

<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    <div class="grid md:grid-cols-12 gap-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-9">
            <div class="m-3">
                <textarea name="content" id="task-textarea" class="form-control">{{ old('content', $post->content ?? '') }}</textarea>
            </div>
        </div>
        <div class="md:col-span-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-3 py-4 md:grid md:grid-row-3 gap-4 space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" value="{{ old('title', $post->title ?? '') }}" name="title" id="title" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('title') border-red-500 @enderror">
                    @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700">Sub Title</label>
                    <input type="text" value="{{ old('subtitle', $post->subtitle ?? '') }}" name="subtitle" id="subtitle" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('subtitle') border-red-500 @enderror">
                    @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">SEO (optional)</p>
                    <p class="text-xs text-gray-500 mb-3">Overrides the default page title and search snippet. Leave blank to use the post title and subtitle.</p>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta title</label>
                    <input type="text" value="{{ old('meta_title', $post->meta_title ?? '') }}" name="meta_title" id="meta_title" maxlength="255" placeholder="~50–60 characters" class="mt-1 mb-3 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('meta_title') border-red-500 @enderror">
                    @error('meta_title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta description</label>
                    <textarea name="meta_description" id="meta_description" rows="4" maxlength="2000" placeholder="~150–160 characters for Google" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('meta_description') border-red-500 @enderror">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                    @error('meta_description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <x-img-upload image="{{ $post->icon ?? '' }}" classing="bigTall" />
                <select name="subtitle2" id="subtitle2" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select a category</option>
                    @php
                    $postCategories = App\Models\PostCategories::all();
                    @endphp
                    @foreach($postCategories as $category)
                    <option value="{{ $category->id }}" @if((string) old('subtitle2', $post->category_no ?? '') === (string) $category->id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <x-front-end-btn linking="{{ $buttonlinking }}" color="{{ $buttoncolor }}" showme="{{ $buttonshowme }}" name="{{ $buttonname }}" />
            </div>
        </div>
    </div>
</form>
