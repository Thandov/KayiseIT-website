@php
    $isCarouselSlide = $errors->any()
        ? (bool) old('as_carousel_slide')
        : (bool) ($isCarouselSlide ?? false);
@endphp
<div class="rounded-md border border-gray-200 bg-gray-50 p-3">
    <label class="flex items-start gap-2 cursor-pointer">
        <input type="checkbox"
               name="as_carousel_slide"
               id="as_carousel_slide"
               value="1"
               @checked($isCarouselSlide)
               class="mt-0.5 rounded border-gray-300 text-kb-100 focus:ring-kb-500">
        <span>
            <span class="block text-sm font-medium text-gray-900">Use as carousel slide</span>
            <span class="block text-xs text-gray-500 mt-1">Show this post on the homepage carousel. Deleting the post also removes the slide.</span>
        </span>
    </label>
</div>
