@php
    $blog = $blog ?? null;
    $isEdit = filled(optional($blog)->id);
    $postCategories = $postCategories ?? collect();
    $isCarouselSlide = $errors->any()
        ? (bool) old('as_carousel_slide')
        : (bool) ($isCarouselSlide ?? false);
    $coverUrl = old('icon') ? asset(old('icon')) : ($blog && method_exists($blog, 'coverUrl') ? $blog->coverUrl() : null);
    $formAction = $formAction ?? ($isEdit
        ? route('dashboard.blogs.viewblog_edit.update_blog', $blog->id)
        : route('dashboard.blogs.storeblog-form'));
    $submitLabel = $submitLabel ?? ($isEdit ? 'Save post' : 'Publish post');
@endphp

<script>
    (function () {
        const register = () => {
            if (window.__kayiseBlogForm || !window.Alpine || typeof Alpine.data !== 'function') {
                return;
            }
            window.__kayiseBlogForm = true;
            Alpine.data('blogForm', (initial = {}) => ({
                asSlide: !!initial.asSlide,
                preview: initial.preview || null,
                onFile(event) {
                    const file = event.target.files && event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (e) => { this.preview = e.target.result; };
                    reader.readAsDataURL(file);
                }
            }));
        };
        document.addEventListener('alpine:init', register);
        register();
    })();
</script>

<style>
    .blog-editor .ck-editor__editable_inline { min-height: 22rem; }
    .blog-cover { aspect-ratio: 16 / 9; }
</style>

<form
    action="{{ $formAction }}"
    method="POST"
    enctype="multipart/form-data"
    x-data='blogForm(@json(["asSlide" => (bool) $isCarouselSlide, "preview" => $coverUrl]))'
    class="ki-stack"
>
    @csrf

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-medium mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 ki-stack">
            <section class="ki-panel ki-stack-tight">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-900">
                        Headline <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">The name of the post on the website and in the dashboard.</p>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $blog->title ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="e.g. 4IR Research Chair Symposium + Expo 2026"
                        class="ki-input mt-2 @error('title') border-red-500 @enderror"
                    >
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-900">
                        Standfirst <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">One supporting line under the headline. Also used on the carousel slide.</p>
                    <input
                        type="text"
                        name="subtitle"
                        id="subtitle"
                        value="{{ old('subtitle', $blog->subtitle ?? '') }}"
                        required
                        maxlength="255"
                        placeholder="A short line that tells people why this story matters"
                        class="ki-input mt-2 @error('subtitle') border-red-500 @enderror"
                    >
                </div>
            </section>

            <section class="ki-panel">
                <label for="blog-content" class="block text-sm font-medium text-gray-900">
                    Body <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-gray-500 mt-1 mb-3">Write the story. You can add headings, links, and images in the editor.</p>
                <div class="blog-editor">
                    <textarea name="content" id="blog-content" class="@error('content') border-red-500 @enderror">{{ old('content', $blog->content ?? '') }}</textarea>
                </div>
            </section>
        </div>

        <div class="lg:col-span-4 ki-stack">
            <section class="ki-panel ki-stack-tight">
                <div>
                    <p class="text-sm font-medium text-gray-900">
                        Cover image
                        @if(! $isEdit)
                            <span class="text-red-500">*</span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Landscape, at least 1600×900. This is also the carousel photograph if you enable the slide below.</p>
                </div>

                <label for="profile_picture_input" class="block cursor-pointer">
                    <div
                        class="blog-cover relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50"
                        :class="preview ? 'border-solid border-gray-200' : ''"
                    >
                        <img
                            x-show="preview"
                            :src="preview"
                            alt="Cover preview"
                            class="absolute inset-0 h-full w-full object-cover"
                        >
                        <div x-show="!preview" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 px-4 text-center">
                            <svg class="h-8 w-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16l5-5 4 4 6-7 3 3v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6z" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Click to upload</span>
                            <span class="text-xs mt-1">JPEG, PNG or WebP · up to 8MB</span>
                        </div>
                    </div>
                </label>
                <input
                    id="profile_picture_input"
                    type="file"
                    name="profile_picture"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                    class="sr-only"
                    @change="onFile($event)"
                    @if(! $isEdit) required @endif
                >
                @error('profile_picture')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </section>

            <section class="ki-panel ki-stack-tight">
                <div>
                    <label for="category_no" class="block text-sm font-medium text-gray-900">Category</label>
                    <p class="text-xs text-gray-500 mt-1">Optional. Helps readers browse related posts.</p>
                </div>
                <select name="category_no" id="category_no" class="ki-select">
                    <option value="">No category</option>
                    @foreach ($postCategories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_no', $blog->category_no ?? '') === (string) $category->id)>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </section>

            <section
                class="ki-panel"
                :class="asSlide ? 'border-kb-100 bg-kb-50' : ''"
            >
                <input type="hidden" name="as_carousel_slide" value="{{ $isCarouselSlide ? 1 : 0 }}" :value="asSlide ? 1 : 0">
                <button
                    type="button"
                    role="switch"
                    :aria-checked="asSlide.toString()"
                    @click="asSlide = !asSlide"
                    class="w-full text-left flex items-start gap-3"
                >
                    <span
                        class="mt-0.5 relative inline-flex h-6 w-11 shrink-0 rounded-full transition-colors"
                        :class="asSlide ? 'bg-kb-100' : 'bg-gray-300'"
                    >
                        <span
                            class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform"
                            :class="asSlide ? 'translate-x-5' : 'translate-x-0'"
                        ></span>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-sm font-semibold text-gray-900">Homepage carousel</span>
                        <span class="block text-xs text-gray-600 mt-1">Turn this on to use the cover as a campaign slide. The slide opens this post. Deleting the post also removes the slide.</span>
                    </span>
                </button>

                <div x-show="asSlide" x-cloak class="mt-4 overflow-hidden rounded-lg bg-slate-950 aspect-video relative">
                    <div class="absolute inset-0 bg-cover bg-center" :style="preview ? `background-image:url('${preview}')` : ''"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-white/70">Carousel preview</p>
                        <p class="text-white text-sm font-bold leading-tight mt-1 line-clamp-2">{{ old('title', $blog->title ?? 'Headline') }}</p>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-gray-200 bg-white px-6 py-4">
        <a href="{{ route('dashboard.blogs') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancel</a>
        <button
            type="submit"
            class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-500"
        >
            {{ $submitLabel }}
        </button>
    </div>
</form>
