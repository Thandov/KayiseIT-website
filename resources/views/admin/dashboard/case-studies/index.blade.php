@php
    use App\Support\CaseStudyTypes;
    $typeOptions = $typeOptions ?? CaseStudyTypes::options();
    $initial = $caseStudies->getCollection()->map(function ($study) {
        return [
            'id' => $study->id,
            'title' => $study->title,
            'client_name' => $study->client_name,
            'year' => $study->year,
            'type' => $study->resolvedType(),
            'type_label' => $study->typeLabel(),
            'is_active' => (bool) $study->is_active,
            'is_featured' => (bool) $study->is_featured,
            'image' => $study->coverImageUrl(),
            'slug' => $study->slug,
            'site_url' => ($study->slug && $study->is_active) ? route('case-studies.show', $study->slug) : null,
            'show_url' => route('dashboard.case-studies.show', $study->id),
            'edit_url' => route('dashboard.case-studies.edit', $study->id),
            'destroy_url' => route('dashboard.case-studies.destroy', $study->id),
            'toggle_active_url' => route('dashboard.case-studies.toggle-active', $study->id),
            'toggle_featured_url' => route('dashboard.case-studies.toggle-featured', $study->id),
        ];
    })->values();
@endphp

<div
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
    x-data="caseStudiesAdmin({
        endpoint: @js(route('dashboard.case-studies.index')),
        csrf: @js(csrf_token()),
        items: @js($initial),
        meta: {
            current_page: {{ $caseStudies->currentPage() }},
            last_page: {{ $caseStudies->lastPage() }},
            per_page: {{ $caseStudies->perPage() }},
            total: {{ $caseStudies->total() }},
            from: {{ $caseStudies->firstItem() ?? 0 }},
            to: {{ $caseStudies->lastItem() ?? 0 }}
        }
    })"
>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex flex-col gap-4 md:flex-row md:items-center mb-6">
            <div class="flex items-center flex-1 min-w-0">
                <div class="flex-shrink-0 bg-green-600 rounded-md p-3">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                <div class="ml-5 min-w-0">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Case Studies Management</h3>
                    <p class="mt-1 text-sm text-gray-500">Search, filter, publish, and delete without leaving the page.</p>
                </div>
            </div>
            <a href="{{ route('dashboard.case-studies.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                <i class="fas fa-plus mr-2"></i>
                Add Case Study
            </a>
        </div>

        <div x-show="flash" x-cloak x-text="flash" class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded"></div>
        <div x-show="error" x-cloak x-text="error" class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded"></div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-3">
            <div class="md:col-span-2">
                <label class="sr-only" for="cs-search">Search</label>
                <input id="cs-search" type="search" x-model="q" @input.debounce.350ms="load(1)"
                       placeholder="Search title, client, headline…"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <label class="sr-only" for="cs-type">Type</label>
                <select id="cs-type" x-model="type" @change="load(1)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">All types</option>
                    @foreach($typeOptions as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="sr-only" for="cs-status">Status</label>
                <select id="cs-status" x-model="status" @change="load(1)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">All statuses</option>
                    <option value="active">Published</option>
                    <option value="inactive">Unpublished</option>
                </select>
            </div>
        </div>

        <div class="mb-4 flex flex-wrap items-center gap-3">
            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" x-model="featured" @change="load(1)" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                Featured only
            </label>
            <span class="text-sm text-gray-500" x-show="!loading">
                <span x-text="meta.total"></span> result<span x-text="meta.total === 1 ? '' : 's'"></span>
            </span>
            <span class="text-sm text-gray-400" x-show="loading" x-cloak>Loading…</span>
        </div>

        <div class="overflow-x-auto relative">
            <div x-show="loading" x-cloak class="absolute inset-0 bg-white/60 z-10 flex items-center justify-center">
                <i class="fas fa-spinner fa-spin text-green-600 text-2xl"></i>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="item in items" :key="item.id">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img :src="item.image" :alt="item.title" class="w-16 h-16 object-cover rounded border border-gray-200">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900" x-text="item.title"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-800" x-text="item.type_label"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500" x-text="item.client_name || 'N/A'"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500" x-text="item.year || 'N/A'"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button"
                                        @click="toggleActive(item)"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="item.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                        x-text="item.is_active ? 'Published' : 'Draft'">
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button"
                                        @click="toggleFeatured(item)"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="item.is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'"
                                        x-text="item.is_featured ? 'Featured' : '—'">
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="ki-table-actions">
                                    <a x-show="item.site_url" :href="item.site_url" target="_blank" rel="noopener" class="text-green-700 hover:text-green-900">Site</a>
                                    <a :href="item.show_url" class="text-blue-600 hover:text-blue-900">View</a>
                                    <a :href="item.edit_url" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button type="button" @click="destroyItem(item)" class="text-red-600 hover:text-red-900">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="!loading && items.length === 0" x-cloak>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            No case studies match these filters.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-3" x-show="meta.last_page > 1" x-cloak>
            <p class="text-sm text-gray-500">
                Showing <span x-text="meta.from || 0"></span>–<span x-text="meta.to || 0"></span>
                of <span x-text="meta.total"></span>
            </p>
            <div class="ki-table-actions">
                <button type="button"
                        class="px-3 py-2 text-sm border border-gray-300 rounded-md disabled:opacity-40"
                        :disabled="meta.current_page <= 1 || loading"
                        @click="load(meta.current_page - 1)">Previous</button>
                <span class="text-sm text-gray-600">
                    Page <span x-text="meta.current_page"></span> / <span x-text="meta.last_page"></span>
                </span>
                <button type="button"
                        class="px-3 py-2 text-sm border border-gray-300 rounded-md disabled:opacity-40"
                        :disabled="meta.current_page >= meta.last_page || loading"
                        @click="load(meta.current_page + 1)">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
window.caseStudiesAdmin = function caseStudiesAdmin(config) {
    return {
        endpoint: config.endpoint,
        csrf: config.csrf,
        items: config.items || [],
        meta: config.meta || { current_page: 1, last_page: 1, total: 0, from: 0, to: 0 },
        q: '',
        type: '',
        status: '',
        featured: false,
        loading: false,
        flash: '',
        error: '',
        flashTimer: null,

        setFlash(message) {
            this.flash = message;
            this.error = '';
            clearTimeout(this.flashTimer);
            this.flashTimer = setTimeout(() => { this.flash = ''; }, 2800);
        },

        queryParams(page) {
            const params = new URLSearchParams();
            params.set('page', String(page || 1));
            if (this.q.trim()) params.set('q', this.q.trim());
            if (this.type) params.set('type', this.type);
            if (this.status) params.set('status', this.status);
            if (this.featured) params.set('featured', '1');
            return params;
        },

        async load(page) {
            this.loading = true;
            this.error = '';
            try {
                const res = await fetch(this.endpoint + '?' + this.queryParams(page).toString(), {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });
                const json = await res.json();
                if (!res.ok || !json.success) throw new Error(json.message || 'Failed to load');
                this.items = json.data || [];
                this.meta = json.meta || this.meta;
            } catch (e) {
                this.error = e.message || 'Could not load case studies.';
            } finally {
                this.loading = false;
            }
        },

        async postJson(url) {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({}),
            });
            const json = await res.json().catch(() => ({}));
            if (!res.ok || !json.success) throw new Error(json.message || 'Request failed');
            return json;
        },

        async toggleActive(item) {
            try {
                const json = await this.postJson(item.toggle_active_url);
                item.is_active = json.is_active;
                item.site_url = (item.slug && item.is_active)
                    ? ('{{ url('/case-studies') }}/' + item.slug)
                    : null;
                this.setFlash(json.message || 'Updated.');
            } catch (e) {
                this.error = e.message || 'Could not update publish status.';
            }
        },

        async toggleFeatured(item) {
            try {
                const json = await this.postJson(item.toggle_featured_url);
                item.is_featured = json.is_featured;
                this.setFlash(json.message || 'Updated.');
            } catch (e) {
                this.error = e.message || 'Could not update featured status.';
            }
        },

        async destroyItem(item) {
            const confirmed = window.Swal
                ? (await Swal.fire({
                    title: 'Delete case study?',
                    text: item.title,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Delete',
                })).isConfirmed
                : window.confirm('Delete “' + item.title + '”?');

            if (!confirmed) return;

            try {
                const form = new FormData();
                form.append('_token', this.csrf);
                form.append('_method', 'DELETE');
                const res = await fetch(item.destroy_url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: form,
                });
                const json = await res.json().catch(() => ({}));
                if (!res.ok || !json.success) throw new Error(json.message || 'Delete failed');
                this.setFlash(json.message || 'Deleted.');
                const page = (this.items.length <= 1 && this.meta.current_page > 1)
                    ? this.meta.current_page - 1
                    : this.meta.current_page;
                await this.load(page);
            } catch (e) {
                this.error = e.message || 'Could not delete case study.';
            }
        },
    };
};
</script>
<style>[x-cloak]{display:none!important}</style>
