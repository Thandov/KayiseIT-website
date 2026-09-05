@php
    use App\Support\CaseStudyTypes;

    $caseStudy = $caseStudy ?? null;
    $results = old('results_list', $caseStudy->results_list ?? [['text' => '']]);
    if (! is_array($results) || count($results) === 0) {
        $results = [['text' => '']];
    }
    $selectedType = old('type', $caseStudy->type ?? CaseStudyTypes::WEBSITE);
    if (! in_array($selectedType, CaseStudyTypes::keys(), true)) {
        $selectedType = CaseStudyTypes::WEBSITE;
    }
    $meta = old('type_meta', $caseStudy->type_meta ?? []);
    if (! is_array($meta)) {
        $meta = [];
    }
    $types = CaseStudyTypes::all();
    $scopeSelected = (array) ($meta['scope'] ?? []);
@endphp

<div
    class="space-y-6"
    x-data="{
        type: @js($selectedType),
        types: @js(collect($types)->map(fn ($t) => ['label' => $t['label'], 'help' => $t['help'], 'cover_hint' => $t['cover_hint'], 'requires_url' => $t['requires_url']])->all()),
        get current() { return this.types[this.type] || this.types.website; }
    }"
>
    {{-- TYPE SELECTOR --}}
    <div class="rounded-lg border border-gray-200 bg-slate-50 p-4">
        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
            Case study type <span class="text-red-500">*</span>
        </label>
        <select
            name="type"
            id="type"
            x-model="type"
            required
            class="w-full md:max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white"
        >
            @foreach(CaseStudyTypes::options() as $key => $label)
                <option value="{{ $key }}" @selected($selectedType === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <p class="mt-2 text-sm text-gray-600" x-text="current.help"></p>
        @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- SHARED: identity --}}
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Shared details</h3>

        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ old('title', $caseStudy->title ?? '') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <p class="mt-1 text-sm text-gray-500">Internal name. The public page can use a different outcome headline below.</p>
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="headline" class="block text-sm font-medium text-gray-700 mb-2">Outcome headline (public)</label>
            <input type="text" name="headline" id="headline" value="{{ old('headline', $caseStudy->headline ?? '') }}"
                   placeholder="How a municipal skills programme cut processing from 12 days to 5"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            @error('headline')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $caseStudy->slug ?? '') }}"
                   placeholder="generated-from-title"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <p class="mt-1 text-sm text-gray-500">Public URL: /case-studies/your-slug. Leave blank to generate from the title.</p>
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">Client name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $caseStudy->client_name ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('client_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                <input type="text" name="year" id="year" value="{{ old('year', $caseStudy->year ?? '') }}" placeholder="2024"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $caseStudy->duration ?? '') }}" placeholder="8 weeks"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
        </div>
    </div>

    {{-- TYPE-SPECIFIC --}}
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-1">Type requirements</h3>
        <p class="text-sm text-gray-500 mb-4">Fields below change with the type you selected.</p>

        {{-- Shared URL for website / software --}}
        <div x-show="type === 'website' || type === 'software'" x-cloak class="mb-4">
            <label for="hyperlink" class="block text-sm font-medium text-gray-700 mb-2">
                <span x-text="type === 'website' ? 'Live website URL' : 'Public / product URL (optional)'"></span>
                <span class="text-red-500" x-show="type === 'website'">*</span>
            </label>
            <input type="url" name="hyperlink" id="hyperlink" value="{{ old('hyperlink', $caseStudy->hyperlink ?? '') }}"
                   placeholder="https://example.com"
                   :required="type === 'website'"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
            @error('hyperlink')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- WEBSITE --}}
        <div x-show="type === 'website'" x-cloak class="space-y-4 rounded-lg border border-blue-100 bg-blue-50/40 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="meta_tech_stack" class="block text-sm font-medium text-gray-700 mb-2">Tech stack</label>
                    <input type="text" name="type_meta[tech_stack]" id="meta_tech_stack" value="{{ $meta['tech_stack'] ?? '' }}"
                           placeholder="Laravel, Tailwind, MySQL"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_before_url" class="block text-sm font-medium text-gray-700 mb-2">Before URL (optional)</label>
                    <input type="url" name="type_meta[before_url]" id="meta_before_url" value="{{ $meta['before_url'] ?? '' }}"
                           placeholder="https://old-site.example.com"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
            </div>
            <label class="inline-flex items-center gap-2 text-sm text-gray-800">
                <input type="checkbox" name="capture_screenshot" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                       {{ old('capture_screenshot') ? 'checked' : '' }}>
                Capture cover screenshot from the live URL on save
            </label>
            <p class="text-xs text-gray-500">Uses the live URL above. Skip this if you upload a cover manually.</p>
        </div>

        {{-- SOFTWARE --}}
        <div x-show="type === 'software'" x-cloak class="space-y-4 rounded-lg border border-indigo-100 bg-indigo-50/40 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="meta_product_name" class="block text-sm font-medium text-gray-700 mb-2">Product name</label>
                    <input type="text" name="type_meta[product_name]" id="meta_product_name" value="{{ $meta['product_name'] ?? '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_platform" class="block text-sm font-medium text-gray-700 mb-2">Platform</label>
                    <select name="type_meta[platform]" id="meta_platform" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option value="">Select…</option>
                        @foreach(CaseStudyTypes::softwarePlatforms() as $key => $label)
                            <option value="{{ $key }}" @selected(($meta['platform'] ?? '') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label for="meta_demo_url" class="block text-sm font-medium text-gray-700 mb-2">Demo URL (optional)</label>
                <input type="url" name="type_meta[demo_url]" id="meta_demo_url" value="{{ $meta['demo_url'] ?? '' }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
            </div>
        </div>

        {{-- TRAINING --}}
        <div x-show="type === 'training'" x-cloak class="space-y-4 rounded-lg border border-emerald-100 bg-emerald-50/40 p-4">
            <div>
                <label for="meta_partners" class="block text-sm font-medium text-gray-700 mb-2">Partners</label>
                <input type="text" name="type_meta[partners]" id="meta_partners" value="{{ $meta['partners'] ?? '' }}"
                       placeholder="Unisa Enterprise, NYDA"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="meta_cohort_size" class="block text-sm font-medium text-gray-700 mb-2">Cohort size</label>
                    <input type="text" name="type_meta[cohort_size]" id="meta_cohort_size" value="{{ $meta['cohort_size'] ?? '' }}"
                           placeholder="300"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_completion_rate" class="block text-sm font-medium text-gray-700 mb-2">Completion rate</label>
                    <input type="text" name="type_meta[completion_rate]" id="meta_completion_rate" value="{{ $meta['completion_rate'] ?? '' }}"
                           placeholder="92%"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_employment_rate" class="block text-sm font-medium text-gray-700 mb-2">Employment / further study</label>
                    <input type="text" name="type_meta[employment_rate]" id="meta_employment_rate" value="{{ $meta['employment_rate'] ?? '' }}"
                           placeholder="75%"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
            </div>
            <div>
                <label for="meta_programme_dates" class="block text-sm font-medium text-gray-700 mb-2">Programme dates</label>
                <input type="text" name="type_meta[programme_dates]" id="meta_programme_dates" value="{{ $meta['programme_dates'] ?? '' }}"
                       placeholder="Jan–Jun 2023"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
            </div>
        </div>

        {{-- INFRASTRUCTURE --}}
        <div x-show="type === 'infrastructure'" x-cloak class="space-y-4 rounded-lg border border-amber-100 bg-amber-50/40 p-4">
            <div>
                <label for="meta_location" class="block text-sm font-medium text-gray-700 mb-2">Site / location</label>
                <input type="text" name="type_meta[location]" id="meta_location" value="{{ $meta['location'] ?? '' }}"
                       placeholder="Nelspruit office"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <p class="block text-sm font-medium text-gray-700 mb-2">Scope delivered</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    @foreach(CaseStudyTypes::infrastructureScopeOptions() as $key => $label)
                        <label class="inline-flex items-center gap-2 text-sm text-gray-800 bg-white border border-gray-200 rounded-lg px-3 py-2">
                            <input type="checkbox" name="type_meta[scope][]" value="{{ $key }}"
                                   class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                                   @checked(in_array($key, $scopeSelected, true))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- REPAIR --}}
        <div x-show="type === 'repair'" x-cloak class="space-y-4 rounded-lg border border-rose-100 bg-rose-50/40 p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="meta_device_type" class="block text-sm font-medium text-gray-700 mb-2">Device</label>
                    <select name="type_meta[device_type]" id="meta_device_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option value="">Select…</option>
                        @foreach(CaseStudyTypes::repairDevices() as $key => $label)
                            <option value="{{ $key }}" @selected(($meta['device_type'] ?? '') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="meta_fault_category" class="block text-sm font-medium text-gray-700 mb-2">Fault</label>
                    <select name="type_meta[fault_category]" id="meta_fault_category" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option value="">Select…</option>
                        @foreach(CaseStudyTypes::repairFaults() as $key => $label)
                            <option value="{{ $key }}" @selected(($meta['fault_category'] ?? '') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="meta_turnaround" class="block text-sm font-medium text-gray-700 mb-2">Turnaround</label>
                    <input type="text" name="type_meta[turnaround]" id="meta_turnaround" value="{{ $meta['turnaround'] ?? '' }}"
                           placeholder="Same day / 48 hours"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
            </div>
            <p class="text-xs text-gray-500">Use Extra photos for before/after shots.</p>
        </div>

        {{-- SUPPORT --}}
        <div x-show="type === 'support'" x-cloak class="space-y-4 rounded-lg border border-slate-200 bg-slate-50 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="meta_sla_tier" class="block text-sm font-medium text-gray-700 mb-2">SLA tier</label>
                    <input type="text" name="type_meta[sla_tier]" id="meta_sla_tier" value="{{ $meta['sla_tier'] ?? '' }}"
                           placeholder="Business / Priority"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_contract_duration" class="block text-sm font-medium text-gray-700 mb-2">Contract duration</label>
                    <input type="text" name="type_meta[contract_duration]" id="meta_contract_duration" value="{{ $meta['contract_duration'] ?? '' }}"
                           placeholder="12 months"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_tickets_before" class="block text-sm font-medium text-gray-700 mb-2">Tickets before (monthly)</label>
                    <input type="text" name="type_meta[tickets_before]" id="meta_tickets_before" value="{{ $meta['tickets_before'] ?? '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
                <div>
                    <label for="meta_tickets_after" class="block text-sm font-medium text-gray-700 mb-2">Tickets after (monthly)</label>
                    <input type="text" name="type_meta[tickets_after]" id="meta_tickets_after" value="{{ $meta['tickets_after'] ?? '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                </div>
            </div>
            <div>
                <label for="meta_response_time" class="block text-sm font-medium text-gray-700 mb-2">Typical response time</label>
                <input type="text" name="type_meta[response_time]" id="meta_response_time" value="{{ $meta['response_time'] ?? '' }}"
                       placeholder="Under 2 hours"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
            </div>
        </div>
    </div>

    {{-- SHARED: cover + gallery --}}
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Photos</h3>
        <p class="text-sm text-gray-500 mb-3" x-text="current.cover_hint"></p>

        @if($caseStudy && $caseStudy->image)
            <div class="mb-3">
                <img src="{{ $caseStudy->imageUrl() }}" alt="Cover" class="w-full max-w-lg h-56 object-cover border border-gray-200">
                <label class="mt-2 inline-flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remove_cover" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                    Remove cover photo
                </label>
            </div>
        @endif

        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Cover photo</label>
        <input type="file" name="image" id="image"
               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/heic,image/heif"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
        <div id="cover-preview" class="mt-3 hidden">
            <img alt="Cover preview" class="w-full max-w-lg h-56 object-cover border border-gray-200">
        </div>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Extra photos</label>
            @if($caseStudy && $caseStudy->galleryImages && $caseStudy->galleryImages->count() > 0)
                <div class="mb-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($caseStudy->galleryImages as $galleryImage)
                        <label class="relative block">
                            <img src="{{ $galleryImage->url() }}" alt="Gallery image" class="w-full h-32 object-cover border border-gray-200">
                            <span class="mt-2 flex items-center gap-2 text-xs text-red-700">
                                <input type="checkbox" name="delete_gallery_images[]" value="{{ $galleryImage->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                Remove
                            </span>
                        </label>
                    @endforeach
                </div>
            @endif
            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/heic,image/heif"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <div id="gallery-preview" class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-3"></div>
            @error('gallery_images.*')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- SHARED: story --}}
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Story</h3>

        <div class="mb-6">
            <label for="problem" class="block text-sm font-medium text-gray-700 mb-2">
                The challenge <span class="text-red-500">*</span>
            </label>
            <textarea name="problem" id="problem" rows="4" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('problem', $caseStudy->problem ?? '') }}</textarea>
            @error('problem')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="solution" class="block text-sm font-medium text-gray-700 mb-2">
                Approach <span class="text-red-500">*</span>
            </label>
            <textarea name="solution" id="solution" rows="4" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('solution', $caseStudy->solution ?? '') }}</textarea>
            @error('solution')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="results" class="block text-sm font-medium text-gray-700 mb-2">Results summary</label>
            <textarea name="results" id="results" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('results', $caseStudy->results ?? '') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Snapshot metrics</label>
            <div id="results-list-container">
                @foreach($results as $index => $result)
                    <div class="result-item mb-3">
                        <div class="flex items-center gap-2">
                            <input type="text"
                                   name="results_list[{{ $index }}][text]"
                                   value="{{ \App\Models\CaseStudy::plainMetric(is_array($result) ? ($result['text'] ?? '') : $result) }}"
                                   placeholder="e.g. Processing time 12 days → 5 days"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <button type="button" onclick="this.closest('.result-item').remove()" class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addResultItem()" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm">
                <i class="fas fa-plus mr-2"></i>Add metric
            </button>
        </div>

        <div class="mb-6">
            <label for="quote" class="block text-sm font-medium text-gray-700 mb-2">Named quote</label>
            <textarea name="quote" id="quote" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('quote', $caseStudy->quote ?? '') }}</textarea>
        </div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="quote_name" class="block text-sm font-medium text-gray-700 mb-2">Quote name</label>
                <input type="text" name="quote_name" id="quote_name" value="{{ old('quote_name', $caseStudy->quote_name ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <label for="quote_role" class="block text-sm font-medium text-gray-700 mb-2">Quote title / organisation</label>
                <input type="text" name="quote_role" id="quote_role" value="{{ old('quote_role', $caseStudy->quote_role ?? '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
        </div>
    </div>

    {{-- SHARED: publishing --}}
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 mb-4">Publishing</h3>
        <div class="mb-6 grid grid-cols-2 gap-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $caseStudy->is_featured ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                <span class="ml-2 text-sm text-gray-700">Featured on homepage</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $caseStudy->is_active ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                <span class="ml-2 text-sm text-gray-700">Published on website</span>
            </label>
        </div>
        <div class="mb-2">
            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display order</label>
            <input type="number" name="order" id="order" value="{{ old('order', $caseStudy->order ?? 0) }}"
                   class="w-full md:max-w-xs px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>
    </div>
</div>

<script>
    let resultItemCount = {{ count($results) }};
    function addResultItem() {
        const container = document.getElementById('results-list-container');
        const newItem = document.createElement('div');
        newItem.className = 'result-item mb-3';
        newItem.innerHTML = `
            <div class="flex items-center gap-2">
                <input type="text"
                       name="results_list[${resultItemCount}][text]"
                       placeholder="e.g. Processing time 12 days → 5 days"
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <button type="button" onclick="this.closest('.result-item').remove()" class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        resultItemCount++;
    }
    const coverInput = document.getElementById('image');
    if (coverInput) {
        coverInput.addEventListener('change', function () {
            const preview = document.getElementById('cover-preview');
            const img = preview.querySelector('img');
            if (this.files && this.files[0]) {
                img.src = URL.createObjectURL(this.files[0]);
                preview.classList.remove('hidden');
            }
        });
    }
    const galleryInput = document.getElementById('gallery_images');
    if (galleryInput) {
        galleryInput.addEventListener('change', function () {
            const holder = document.getElementById('gallery-preview');
            holder.innerHTML = '';
            Array.from(this.files || []).forEach(function (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;
                img.className = 'w-full h-32 object-cover border border-gray-200';
                holder.appendChild(img);
            });
        });
    }
</script>
<style>[x-cloak]{display:none!important}</style>
