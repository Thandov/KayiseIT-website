@php
    $slides = $slides ?? $carousel ?? new \App\Models\Carousel();
    $isEdit = filled($slides->id);
    $templates = $templates ?? \App\Support\SlideTemplates::all();
    $blogs = $blogs ?? collect();
    $selectedTemplate = old('template', $slides->template ?? \App\Support\SlideTemplates::CLASSIC);
    $selectedLink = old('link_type', $slides->link_type ?? 'services');
    $formAction = $isEdit
        ? route('admin.dashboard.carousel.update', $slides->id)
        : route('admin.dashboard.carousel.store');
    $currentImage = $slides->image ?? '';
    $previewSrc = $currentImage
        ? asset(ltrim(preg_replace('#^\.\./#', '', $currentImage), '/'))
        : '';
    $formDefaults = [
        'template' => $selectedTemplate,
        'linkType' => $selectedLink,
        'kicker' => old('head_title', $slides->title ?? ''),
        'headline' => old('middletxt', $slides->middletxt ?? ''),
        'support' => old('btmtxt', $slides->btmtxt ?? ''),
        'ctaLabel' => old('cta_label', $slides->cta_label ?? ''),
        'previewSrc' => $previewSrc,
    ];
@endphp

<style>
    [x-cloak] { display: none !important; }
    .slide-template-card { transition: border-color .15s ease, box-shadow .15s ease, transform .15s ease; }
    .slide-template-card:hover { transform: translateY(-1px); }
    .slide-mini {
        height: 92px;
        border-radius: 0.5rem;
        overflow: hidden;
        position: relative;
        background: #0b1220;
    }
    .slide-mini::after { content: ""; position: absolute; inset: 0; }
    .slide-mini-classic::after { background: rgba(5,7,12,.62); }
    .slide-mini-editorial::after { background: linear-gradient(to top, rgba(5,7,12,.85) 0%, rgba(5,7,12,.1) 70%); }
    .slide-mini-campaign::after { background: linear-gradient(to top, rgba(5,7,12,.45) 0%, transparent 48%); }
    .slide-mini-copy { position: relative; z-index: 1; height: 100%; padding: .5rem .6rem; color: #fff; }
</style>

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <p class="font-medium mb-1">Please fix the following:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('slideForm', () => ({
            template: @json($formDefaults['template']),
            linkType: @json($formDefaults['linkType']),
            kicker: @json($formDefaults['kicker']),
            headline: @json($formDefaults['headline']),
            support: @json($formDefaults['support']),
            ctaLabel: @json($formDefaults['ctaLabel']),
            previewSrc: @json($formDefaults['previewSrc']),
            onFile(event) {
                const file = event.target.files && event.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => { this.previewSrc = e.target.result; };
                reader.readAsDataURL(file);
            },
            templateLabel() {
                return { classic: 'Classic overlay', editorial: 'Editorial caption', campaign: 'Campaign visual' }[this.template] || this.template;
            },
            defaultCta() {
                if (this.linkType === 'blog') return 'Read the story';
                if (this.linkType === 'custom') return 'Learn more';
                return 'Explore services';
            }
        }));
    });
</script>

<form
    action="{{ $formAction }}"
    method="POST"
    enctype="multipart/form-data"
    x-data="slideForm"
    class="space-y-8"
>
    @csrf
    @if($isEdit)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $slides->id }}">
    @endif
    <input type="hidden" name="template" value="{{ $selectedTemplate }}" :value="template">

    <section>
        <div class="mb-4">
            <h3 class="text-base font-semibold text-gray-900">Choose a template</h3>
            <p class="mt-1 text-sm text-gray-500">Templates keep everyday slides consistent. Campaign lets the photograph be the design — nothing is forced into three overlay lines.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4" role="radiogroup" aria-label="Slide template">
            @foreach ($templates as $key => $meta)
                <button
                    type="button"
                    role="radio"
                    :aria-checked="template === '{{ $key }}'"
                    @click="template = '{{ $key }}'; if ('{{ $key }}' === 'campaign' && linkType === 'services') linkType = 'blog'"
                    class="slide-template-card text-left rounded-xl border-2 bg-white p-3 focus:outline-none focus:ring-2 focus:ring-kb-100 focus:ring-offset-2"
                    :class="template === '{{ $key }}' ? 'border-kb-100 shadow-md' : 'border-gray-200 hover:border-gray-300'"
                >
                    <div class="slide-mini slide-mini-{{ $key }} mb-3">
                        @if($key === 'classic')
                            <div class="slide-mini-copy flex flex-col justify-center">
                                <span class="text-[9px] font-bold uppercase tracking-[0.16em] text-green-300">Kicker</span>
                                <span class="text-[12px] font-extrabold leading-tight">Headline</span>
                                <span class="text-[9px] text-gray-300 mt-0.5">Supporting line</span>
                                <span class="mt-1 inline-flex w-fit rounded-full bg-green-500 px-2 py-0.5 text-[8px] font-bold text-green-950">Button</span>
                            </div>
                        @elseif($key === 'editorial')
                            <div class="slide-mini-copy flex flex-col justify-end">
                                <span class="text-[11px] font-bold leading-tight">Headline on the photo</span>
                                <span class="mt-1 inline-flex w-fit rounded-full bg-green-500 px-2 py-0.5 text-[8px] font-bold text-green-950">Read more</span>
                            </div>
                        @else
                            <div class="slide-mini-copy flex flex-col justify-end">
                                <span class="text-[9px] text-white/80">Uncovered photography</span>
                                <span class="mt-1 inline-flex w-fit rounded-full bg-green-500/95 px-2 py-0.5 text-[8px] font-bold text-green-950">Read the story</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $meta['label'] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $meta['tagline'] }}</p>
                        </div>
                        <span
                            class="mt-0.5 h-4 w-4 shrink-0 rounded-full border-2"
                            :class="template === '{{ $key }}' ? 'border-kb-100 bg-kb-100' : 'border-gray-300 bg-white'"
                        ></span>
                    </div>
                    <p class="mt-2 text-xs leading-relaxed text-gray-500">{{ $meta['use_when'] }}</p>
                </button>
            @endforeach
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <section class="rounded-xl border border-gray-200 bg-white p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Copy</h3>
                <p class="text-sm text-gray-500 mb-5" x-show="template === 'classic'">These three lines sit over a darkened photo, same structure as the current homepage hero.</p>
                <p class="text-sm text-gray-500 mb-5" x-show="template === 'editorial'" x-cloak>Keep this short. Only the caption bar is darkened — the rest of the photo stays visible.</p>
                <p class="text-sm text-gray-500 mb-5" x-show="template === 'campaign'" x-cloak>Headline and supporting line are optional. Leave them blank if the photo already speaks — for example a symposium stage graphic that should not be re-captioned.</p>

                <div class="space-y-4">
                    <div>
                        <label for="head_title" class="block text-sm font-medium text-gray-700">
                            <span x-show="template === 'campaign'" x-cloak>Slide name</span>
                            <span x-show="template !== 'campaign'">Kicker</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-0.5" x-show="template === 'campaign'" x-cloak>Shown in the dashboard and used as the image label. Not drawn over the photo unless you also add a headline.</p>
                        <input
                            type="text"
                            name="head_title"
                            id="head_title"
                            x-model="kicker"
                            value="{{ old('head_title', $slides->title ?? '') }}"
                            class="mt-1 focus:ring-kb-100 focus:border-kb-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('head_title') border-red-500 @enderror"
                            placeholder="e.g. 4IR Symposium recap"
                        >
                    </div>

                    <div>
                        <label for="middletxt" class="block text-sm font-medium text-gray-700">
                            Headline
                            <span class="text-red-500" x-show="template === 'classic'">*</span>
                            <span class="text-gray-400 font-normal" x-show="template !== 'classic'" x-cloak>(optional)</span>
                        </label>
                        <input
                            type="text"
                            name="middletxt"
                            id="middletxt"
                            x-model="headline"
                            value="{{ old('middletxt', $slides->middletxt ?? '') }}"
                            class="mt-1 focus:ring-kb-100 focus:border-kb-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('middletxt') border-red-500 @enderror"
                            placeholder="The line people read first"
                        >
                    </div>

                    <div>
                        <label for="btmtxt" class="block text-sm font-medium text-gray-700">
                            Supporting line
                            <span class="text-red-500" x-show="template === 'classic'">*</span>
                            <span class="text-gray-400 font-normal" x-show="template !== 'classic'" x-cloak>(optional)</span>
                        </label>
                        <input
                            type="text"
                            name="btmtxt"
                            id="btmtxt"
                            x-model="support"
                            value="{{ old('btmtxt', $slides->btmtxt ?? '') }}"
                            class="mt-1 focus:ring-kb-100 focus:border-kb-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('btmtxt') border-red-500 @enderror"
                            placeholder="A short follow-up sentence"
                        >
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Where this slide goes</h3>
                <p class="text-sm text-gray-500 mb-5">Classic slides can still open Services. Campaign slides should usually open a specific story — a blog, an event page, or any URL.</p>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-4">
                    @foreach ([
                        'none' => 'No link',
                        'services' => 'Services',
                        'blog' => 'Blog post',
                        'custom' => 'Custom URL',
                    ] as $value => $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="link_type" value="{{ $value }}" class="sr-only" x-model="linkType" @checked($selectedLink === $value)>
                            <span
                                class="flex items-center justify-center rounded-lg border px-3 py-2 text-sm font-medium"
                                :class="linkType === '{{ $value }}' ? 'border-kb-100 bg-kb-50 text-kb-700' : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300'"
                            >{{ $label }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="space-y-4">
                    <div x-show="linkType === 'blog'" x-cloak>
                        <label for="blog_id" class="block text-sm font-medium text-gray-700">Blog post</label>
                        @if($blogs->isEmpty())
                            <p class="mt-2 text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-md px-3 py-2">No blog posts yet. Publish the symposium recap first, then point this slide at it.</p>
                        @else
                            <select
                                name="blog_id"
                                id="blog_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('blog_id') border-red-500 @enderror"
                            >
                                <option value="">Select a post</option>
                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}" @selected(old('blog_id', $slides->blog_id ?? '') == $blog->id)>
                                        {{ $blog->title }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div x-show="linkType === 'custom'" x-cloak>
                        <label for="cta_url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input
                            type="url"
                            name="cta_url"
                            id="cta_url"
                            value="{{ old('cta_url', $slides->cta_url ?? '') }}"
                            placeholder="https://www.kayiseit.com/..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm @error('cta_url') border-red-500 @enderror"
                        >
                    </div>

                    <div x-show="linkType !== 'none'" x-cloak>
                        <label for="cta_label" class="block text-sm font-medium text-gray-700">Button label</label>
                        <input
                            type="text"
                            name="cta_label"
                            id="cta_label"
                            x-model="ctaLabel"
                            value="{{ old('cta_label', $slides->cta_label ?? '') }}"
                            placeholder="Read the story"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-kb-100 focus:ring-kb-100 sm:text-sm"
                        >
                        <p class="mt-1 text-xs text-gray-500">Leave blank to use a sensible default for the destination you chose.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <section class="rounded-xl border border-gray-200 bg-white p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-1">Slide image</h3>
                <p class="text-sm text-gray-500 mb-4">Landscape, at least 1920×1080. For campaign slides, crop so logos and faces are not cut off — there is no text overlay to hide a weak crop.</p>

                <label for="profile_picture_input" class="block cursor-pointer">
                    <div
                        class="relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 aspect-video"
                        :class="previewSrc ? 'border-solid border-gray-200' : ''"
                    >
                        <img
                            x-show="previewSrc"
                            :src="previewSrc"
                            alt="Slide preview"
                            class="absolute inset-0 h-full w-full object-cover"
                        >
                        <div x-show="!previewSrc" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 px-4 text-center">
                            <svg class="h-10 w-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16l5-5 4 4 6-7 3 3v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6z" />
                                <circle cx="8" cy="8" r="1.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-600">Click to upload</span>
                            <span class="text-xs mt-1">JPEG, PNG or WebP · up to 8MB</span>
                        </div>
                    </div>
                </label>
                <input id="profile_picture_input" type="file" name="profile_picture" accept="image/jpeg,image/png,image/gif,image/webp" class="sr-only" @change="onFile($event)">
            </section>

            <section class="rounded-xl border border-gray-200 bg-slate-950 overflow-hidden">
                <div class="px-4 py-3 border-b border-white/10 flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-white/70">Live preview</p>
                    <p class="text-xs text-white/40" x-text="templateLabel()"></p>
                </div>
                <div class="relative aspect-video bg-slate-900">
                    <div class="absolute inset-0 bg-cover bg-center" :style="previewSrc ? `background-image:url('${previewSrc}')` : ''"></div>
                    <div
                        class="absolute inset-0"
                        :class="{
                            'bg-black/60': template === 'classic',
                            'bg-gradient-to-t from-black/80 via-black/20 to-black/20': template === 'editorial',
                            'bg-gradient-to-t from-black/50 via-transparent to-transparent': template === 'campaign'
                        }"
                    ></div>
                    <div
                        class="absolute inset-0 p-5 flex"
                        :class="template === 'classic' ? 'items-center' : 'items-end'"
                    >
                        <div class="max-w-[85%]">
                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-green-300 mb-1" x-show="template !== 'campaign'" x-text="kicker || 'Kicker'"></p>
                            <p class="text-white font-extrabold leading-tight" :class="template === 'classic' ? 'text-xl' : 'text-base'" x-show="template !== 'campaign' || headline" x-text="headline || (template === 'classic' ? 'Headline' : '')"></p>
                            <p class="text-gray-300 text-xs mt-1 line-clamp-2" x-show="template === 'classic' || support" x-text="support || (template === 'classic' ? 'Supporting line' : '')"></p>
                            <span
                                x-show="linkType !== 'none'"
                                class="mt-3 inline-flex rounded-full bg-green-500 px-3 py-1 text-[11px] font-bold text-green-950"
                                x-text="ctaLabel || defaultCta()"
                            ></span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-white px-6 py-4">
        <a href="{{ route('admin.dashboard.carousel') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancel</a>
        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold text-white bg-kb-100 hover:bg-kb-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-500">
            {{ $isEdit ? 'Save slide' : 'Create slide' }}
        </button>
    </div>
</form>
