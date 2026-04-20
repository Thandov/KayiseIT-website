@php
    $t = isset($tiersByKey) ? $tiersByKey : collect();
    $small = $t->get(\App\Models\ServiceTier::TIER_SMALL);
    $medium = $t->get(\App\Models\ServiceTier::TIER_MEDIUM);
    $enterprise = $t->get(\App\Models\ServiceTier::TIER_ENTERPRISE);
    $smallPage = $small?->page;
    $mediumPage = $medium?->page;
    $entPage = $enterprise?->page;
    $mediumPackages = optional($medium)->packages ?? collect();
    if ($mediumPackages->isEmpty()) {
        $mediumPackages = collect([(object) ['name' => '', 'price' => '', 'description' => '', 'features' => collect()]]);
    }
    $mediumAddons = optional($medium)->addons ?? collect();
    if ($mediumAddons->isEmpty()) {
        $mediumAddons = collect([(object) ['name' => '', 'price' => '', 'pricing_type' => 'fixed', 'unit_label' => '', 'min_qty' => '', 'max_qty' => '']]);
    }
@endphp
<div id="service-info">
    <form action="{{ isset($service) && optional($service)->id ? route('dashboard.editservice') : route('storeservice') }}" method="post" class="space-y-8">
        @csrf
        @if(isset($service) && optional($service)->id)
            @method('POST')
        @endif
        <input type="hidden" name="id" value="{{ optional($service)->service_id ?? '' }}">

        <div class="space-y-4">
            <h3 class="text-sm font-semibold text-gray-900">Basics</h3>
            <div class="space-y-2">
                <label for="service-name" class="block text-xs font-medium text-gray-500">Name</label>
                <input type="text" id="service-name" name="name" required
                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-kb-500 focus:ring-1 focus:ring-kb-500"
                       value="{{ old('name', optional($service)->name ?? '') }}">
            </div>
            <div class="space-y-2">
                <label for="service-description" class="block text-xs font-medium text-gray-500">Description</label>
                <textarea id="service-description" name="description" rows="3"
                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-kb-500 focus:ring-1 focus:ring-kb-500"
                          placeholder="What this service includes.">{{ old('description', optional($service)->description ?? '') }}</textarea>
            </div>
            @if(optional($service)->id)
                <p class="text-xs text-gray-500">Legacy sync: <code>service_type</code> / <code>price</code> are derived from tiers for older integrations.</p>
            @endif
        </div>

        {{-- Small --}}
        <div class="rounded-xl border border-gray-200 p-4 space-y-4 bg-white">
            <h3 class="text-sm font-semibold text-gray-900">Small business — fixed price</h3>
            <input type="hidden" name="tier_small[pricing_mode]" value="fixed">
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Tier label</label>
                    <input type="text" name="tier_small[label]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.label', $small?->label) }}" placeholder="e.g. Small business">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Price (ZAR)</label>
                    <input type="number" step="0.01" name="tier_small[amount]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.amount', $small?->tierPrice?->amount) }}" placeholder="0.00">
                </div>
            </div>
            <p class="text-xs text-gray-500">Provide a price &gt; 0 here if you are not adding Medium packages yet.</p>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero heading</label>
                    <input type="text" name="tier_small[page][hero_heading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.hero_heading', $smallPage?->hero_heading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero subheading</label>
                    <input type="text" name="tier_small[page][hero_subheading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.hero_subheading', $smallPage?->hero_subheading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Page body</label>
                    <textarea name="tier_small[page][body]" rows="4" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">{{ old('tier_small.page.body', $smallPage?->body) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta title</label>
                    <input type="text" name="tier_small[page][meta_title]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.meta_title', $smallPage?->meta_title) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta description</label>
                    <input type="text" name="tier_small[page][meta_description]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.meta_description', $smallPage?->meta_description) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA label</label>
                    <input type="text" name="tier_small[page][primary_cta_label]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.primary_cta_label', $smallPage?->primary_cta_label) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA URL</label>
                    <input type="text" name="tier_small[page][primary_cta_href]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_small.page.primary_cta_href', $smallPage?->primary_cta_href) }}">
                </div>
            </div>
        </div>

        {{-- Medium --}}
        <div class="rounded-xl border border-gray-200 p-4 space-y-4 bg-white">
            <h3 class="text-sm font-semibold text-gray-900">Medium — packages & add-ons</h3>
            <input type="hidden" name="tier_medium[pricing_mode]" value="packages">
            <div class="space-y-2">
                <label class="block text-xs font-medium text-gray-500">Tier label</label>
                <input type="text" name="tier_medium[label]" class="block w-full max-w-md rounded-lg border border-gray-300 px-3 py-2 text-sm"
                       value="{{ old('tier_medium.label', $medium?->label) }}" placeholder="e.g. Medium / growth">
            </div>
            <div class="space-y-2">
                <label class="block text-xs font-medium text-gray-500">Page — sections JSON (optional)</label>
                <textarea name="tier_medium[page][sections_json]" rows="2" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-xs font-mono"
                          placeholder='[{"type":"text","content":"..."}]'>{{ old('tier_medium.page.sections_json', $mediumPage?->sections ? json_encode($mediumPage->sections, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero heading</label>
                    <input type="text" name="tier_medium[page][hero_heading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.hero_heading', $mediumPage?->hero_heading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero subheading</label>
                    <input type="text" name="tier_medium[page][hero_subheading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.hero_subheading', $mediumPage?->hero_subheading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Page body</label>
                    <textarea name="tier_medium[page][body]" rows="3" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">{{ old('tier_medium.page.body', $mediumPage?->body) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta title</label>
                    <input type="text" name="tier_medium[page][meta_title]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.meta_title', $mediumPage?->meta_title) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta description</label>
                    <input type="text" name="tier_medium[page][meta_description]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.meta_description', $mediumPage?->meta_description) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA label</label>
                    <input type="text" name="tier_medium[page][primary_cta_label]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.primary_cta_label', $mediumPage?->primary_cta_label) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA URL</label>
                    <input type="text" name="tier_medium[page][primary_cta_href]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_medium.page.primary_cta_href', $mediumPage?->primary_cta_href) }}">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs font-semibold text-gray-700">Packages</p>
                    <button type="button" class="text-xs text-kb-600 hover:underline" onclick="addPackageRow()">+ Add package</button>
                </div>
                <div id="package-rows" class="space-y-3">
                    @foreach($mediumPackages as $i => $pkg)
                        @php
                            $featuresText = '';
                            if (isset($pkg->features) && $pkg->features && count($pkg->features)) {
                                $featuresText = $pkg->features->pluck('feature')->implode("\n");
                            }
                        @endphp
                        <div class="package-row rounded-lg border border-gray-100 p-3 space-y-2 bg-gray-50">
                            <div class="grid gap-2 sm:grid-cols-3">
                                <input type="text" name="tier_medium[packages][{{ $i }}][name]" placeholder="Package name" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                       value="{{ old("tier_medium.packages.$i.name", $pkg->name ?? '') }}">
                                <input type="number" step="0.01" name="tier_medium[packages][{{ $i }}][price]" placeholder="Price" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                       value="{{ old("tier_medium.packages.$i.price", $pkg->price ?? '') }}">
                                <button type="button" class="text-xs text-red-600 justify-self-end" onclick="this.closest('.package-row').remove()">Remove</button>
                            </div>
                            <input type="text" name="tier_medium[packages][{{ $i }}][description]" placeholder="Short description" class="w-full rounded border border-gray-300 px-2 py-1.5 text-sm"
                                   value="{{ old("tier_medium.packages.$i.description", $pkg->description ?? '') }}">
                            <textarea name="tier_medium[packages][{{ $i }}][features]" rows="2" placeholder="One feature per line" class="w-full rounded border border-gray-300 px-2 py-1.5 text-xs">{{ old("tier_medium.packages.$i.features", $featuresText) }}</textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs font-semibold text-gray-700">Add-ons</p>
                    <button type="button" class="text-xs text-kb-600 hover:underline" onclick="addAddonRow()">+ Add add-on</button>
                </div>
                <div id="addon-rows" class="space-y-3">
                    @foreach($mediumAddons as $j => $ad)
                        <div class="addon-row rounded-lg border border-gray-100 p-3 grid gap-2 sm:grid-cols-2 lg:grid-cols-6 bg-gray-50">
                            <input type="text" name="tier_medium[addons][{{ $j }}][name]" placeholder="Name" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                   value="{{ old("tier_medium.addons.$j.name", $ad->name ?? '') }}">
                            <input type="number" step="0.01" name="tier_medium[addons][{{ $j }}][price]" placeholder="Price" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                   value="{{ old("tier_medium.addons.$j.price", $ad->price ?? '') }}">
                            <select name="tier_medium[addons][{{ $j }}][pricing_type]" class="rounded border border-gray-300 px-2 py-1.5 text-sm">
                                <option value="fixed" @selected(old("tier_medium.addons.$j.pricing_type", $ad->pricing_type ?? 'fixed') === 'fixed')>Fixed</option>
                                <option value="quantity" @selected(old("tier_medium.addons.$j.pricing_type", $ad->pricing_type ?? '') === 'quantity')>Per unit</option>
                            </select>
                            <input type="text" name="tier_medium[addons][{{ $j }}][unit_label]" placeholder="Unit (e.g. seat)" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                   value="{{ old("tier_medium.addons.$j.unit_label", $ad->unit_label ?? '') }}">
                            <input type="number" name="tier_medium[addons][{{ $j }}][min_qty]" placeholder="Min qty" class="rounded border border-gray-300 px-2 py-1.5 text-sm"
                                   value="{{ old("tier_medium.addons.$j.min_qty", $ad->min_qty ?? '') }}">
                            <div class="flex items-center gap-2">
                                <input type="number" name="tier_medium[addons][{{ $j }}][max_qty]" placeholder="Max qty" class="flex-1 rounded border border-gray-300 px-2 py-1.5 text-sm"
                                       value="{{ old("tier_medium.addons.$j.max_qty", $ad->max_qty ?? '') }}">
                                <button type="button" class="text-xs text-red-600 shrink-0" onclick="this.closest('.addon-row').remove()">×</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Enterprise --}}
        <div class="rounded-xl border border-gray-200 p-4 space-y-4 bg-white">
            <h3 class="text-sm font-semibold text-gray-900">Enterprise — quote / tender</h3>
            <input type="hidden" name="tier_enterprise[pricing_mode]" value="quote">
            <div class="space-y-2">
                <label class="block text-xs font-medium text-gray-500">Tier label</label>
                <input type="text" name="tier_enterprise[label]" class="block w-full max-w-md rounded-lg border border-gray-300 px-3 py-2 text-sm"
                       value="{{ old('tier_enterprise.label', $enterprise?->label) }}">
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero heading</label>
                    <input type="text" name="tier_enterprise[page][hero_heading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.hero_heading', $entPage?->hero_heading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Hero subheading</label>
                    <input type="text" name="tier_enterprise[page][hero_subheading]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.hero_subheading', $entPage?->hero_subheading) }}">
                </div>
                <div class="space-y-2 sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-500">Page body</label>
                    <textarea name="tier_enterprise[page][body]" rows="4" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">{{ old('tier_enterprise.page.body', $entPage?->body) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta title</label>
                    <input type="text" name="tier_enterprise[page][meta_title]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.meta_title', $entPage?->meta_title) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">Meta description</label>
                    <input type="text" name="tier_enterprise[page][meta_description]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.meta_description', $entPage?->meta_description) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA label</label>
                    <input type="text" name="tier_enterprise[page][primary_cta_label]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.primary_cta_label', $entPage?->primary_cta_label) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500">CTA URL</label>
                    <input type="text" name="tier_enterprise[page][primary_cta_href]" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                           value="{{ old('tier_enterprise.page.primary_cta_href', $entPage?->primary_cta_href) }}">
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-kb-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-kb-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kb-600">
                {{ isset($service) && optional($service)->id ? 'Update service' : 'Save service' }}
            </button>
        </div>
    </form>
</div>

<script>
(function() {
    window._pkgIndex = {{ max($mediumPackages->count(), 1) }};
    window._addonIndex = {{ max($mediumAddons->count(), 1) }};

    window.addPackageRow = function() {
        var i = window._pkgIndex++;
        var wrap = document.getElementById('package-rows');
        var div = document.createElement('div');
        div.className = 'package-row rounded-lg border border-gray-100 p-3 space-y-2 bg-gray-50';
        div.innerHTML = '<div class="grid gap-2 sm:grid-cols-3">' +
            '<input type="text" name="tier_medium[packages]['+i+'][name]" placeholder="Package name" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<input type="number" step="0.01" name="tier_medium[packages]['+i+'][price]" placeholder="Price" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<button type="button" class="text-xs text-red-600 justify-self-end" onclick="this.closest(\'.package-row\').remove()">Remove</button></div>' +
            '<input type="text" name="tier_medium[packages]['+i+'][description]" placeholder="Short description" class="w-full rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<textarea name="tier_medium[packages]['+i+'][features]" rows="2" placeholder="One feature per line" class="w-full rounded border border-gray-300 px-2 py-1.5 text-xs"></textarea>';
        wrap.appendChild(div);
    };

    window.addAddonRow = function() {
        var j = window._addonIndex++;
        var wrap = document.getElementById('addon-rows');
        var div = document.createElement('div');
        div.className = 'addon-row rounded-lg border border-gray-100 p-3 grid gap-2 sm:grid-cols-2 lg:grid-cols-6 bg-gray-50';
        div.innerHTML = '<input type="text" name="tier_medium[addons]['+j+'][name]" placeholder="Name" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<input type="number" step="0.01" name="tier_medium[addons]['+j+'][price]" placeholder="Price" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<select name="tier_medium[addons]['+j+'][pricing_type]" class="rounded border border-gray-300 px-2 py-1.5 text-sm"><option value="fixed">Fixed</option><option value="quantity">Per unit</option></select>' +
            '<input type="text" name="tier_medium[addons]['+j+'][unit_label]" placeholder="Unit" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<input type="number" name="tier_medium[addons]['+j+'][min_qty]" placeholder="Min qty" class="rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<div class="flex items-center gap-2"><input type="number" name="tier_medium[addons]['+j+'][max_qty]" placeholder="Max qty" class="flex-1 rounded border border-gray-300 px-2 py-1.5 text-sm">' +
            '<button type="button" class="text-xs text-red-600 shrink-0" onclick="this.closest(\'.addon-row\').remove()">×</button></div>';
        wrap.appendChild(div);
    };
})();
</script>
