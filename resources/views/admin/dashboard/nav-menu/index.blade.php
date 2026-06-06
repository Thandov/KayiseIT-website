@extends('admin.dashboard.layout')

@section('page-title', 'Navigation Menu')

@section('content')
    <div class="p-6" x-data="navMenuBuilder()" x-init="init()">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Navigation Menu</h1>
                <p class="mt-1 text-sm text-gray-600">Build the public site navbar — add pages, reorder, and nest links under dropdown groups.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <form method="POST" action="{{ route('dashboard.nav-menu.reset') }}" onsubmit="return confirm('Reset menu to default links?');">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-xs font-semibold uppercase tracking-widest text-gray-700 bg-white hover:bg-gray-50">
                        Reset to defaults
                    </button>
                </form>
                <button type="button" @click="saveMenu()" :disabled="saving"
                    class="inline-flex items-center px-4 py-2 bg-kb-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-kb-600 disabled:opacity-50">
                    <span x-text="saving ? 'Saving…' : 'Save menu'"></span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg text-sm" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Pages</h2>
                    <p class="mt-1 text-sm text-gray-600">Check pages, then add them to the menu.</p>
                    <div class="mt-4 max-h-64 overflow-y-auto space-y-2 border border-gray-100 rounded-lg p-3">
                        <template x-for="page in availablePages" :key="page.route_name">
                            <label class="flex items-start gap-2 text-sm cursor-pointer">
                                <input type="checkbox" class="mt-0.5 rounded border-gray-300" :value="page.route_name" x-model="selectedPages">
                                <span>
                                    <span class="font-medium text-gray-900" x-text="page.label"></span>
                                    <span class="block text-xs text-gray-500" x-text="page.route_name"></span>
                                </span>
                            </label>
                        </template>
                    </div>
                    <button type="button" @click="addSelectedPages()"
                        class="mt-4 w-full inline-flex justify-center px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-md hover:bg-gray-800">
                        Add to menu
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Custom link</h2>
                    <div class="mt-4 space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase">Label</label>
                            <input type="text" x-model="customLink.label" class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase">URL</label>
                            <input type="text" x-model="customLink.url" placeholder="https://example.com or /path" class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm">
                        </div>
                    </div>
                    <button type="button" @click="addCustomLink()"
                        class="mt-4 w-full inline-flex justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md hover:bg-gray-50">
                        Add custom link
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Dropdown group</h2>
                    <div class="mt-4">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Label</label>
                        <input type="text" x-model="dropdownLabel" placeholder="Explore" class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm">
                    </div>
                    <button type="button" @click="addDropdown()"
                        class="mt-4 w-full inline-flex justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md hover:bg-gray-50">
                        Add dropdown
                    </button>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Menu structure</h2>
                    <p class="mt-1 text-sm text-gray-600">Drag to reorder. Drop a link onto a dropdown to nest it. Use ↑↓ when drag is unavailable.</p>

                    <p x-show="items.length === 0" class="mt-6 text-sm text-gray-500 italic">No menu items yet.</p>

                    <div id="nav-menu-root" class="mt-4 space-y-2 min-h-[80px]">
                        <template x-for="(item, index) in items" :key="item._key">
                            <div class="nav-menu-root-item" :data-key="item._key">
                                <div class="border border-gray-200 rounded-lg bg-gray-50 overflow-hidden">
                                    <div class="flex items-center gap-2 p-3 border-b border-gray-100 bg-white">
                                        <span class="drag-handle cursor-grab text-gray-400 px-1" title="Drag">⠿</span>
                                        <span class="flex-1 font-medium text-gray-900" x-text="item.label"></span>
                                        <span class="text-xs uppercase text-gray-400" x-text="item.type"></span>
                                        <button type="button" @click="moveItem(items, index, -1)" :disabled="index === 0" class="text-xs text-gray-500 disabled:opacity-30">↑</button>
                                        <button type="button" @click="moveItem(items, index, 1)" :disabled="index === items.length - 1" class="text-xs text-gray-500 disabled:opacity-30">↓</button>
                                        <button type="button" @click="items.splice(index, 1)" class="text-xs text-red-600">Remove</button>
                                    </div>
                                    <div class="p-3 grid sm:grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <label class="text-xs text-gray-500">Label</label>
                                            <input type="text" x-model="item.label" class="mt-1 w-full rounded border-gray-300 text-sm">
                                        </div>
                                        <div x-show="item.type !== 'dropdown'">
                                            <label class="text-xs text-gray-500">Custom URL (optional)</label>
                                            <input type="text" x-model="item.url" class="mt-1 w-full rounded border-gray-300 text-sm" placeholder="Uses route if empty">
                                        </div>
                                        <div x-show="item.type === 'certification'" class="sm:col-span-2 grid sm:grid-cols-2 gap-3">
                                            <div>
                                                <label class="text-xs text-gray-500">Badge</label>
                                                <input type="text" x-model="item.badge_label" class="mt-1 w-full rounded border-gray-300 text-sm">
                                            </div>
                                            <div>
                                                <label class="text-xs text-gray-500">Tooltip</label>
                                                <input type="text" x-model="item.title_attr" class="mt-1 w-full rounded border-gray-300 text-sm">
                                            </div>
                                        </div>
                                        <div x-show="item.route_name" class="sm:col-span-2 text-xs text-gray-500">
                                            Route: <code x-text="item.route_name"></code>
                                            <span x-show="item.href_preview"> · <span x-text="item.href_preview"></span></span>
                                        </div>
                                    </div>

                                    <div x-show="item.type === 'dropdown'" class="px-3 pb-3">
                                        <p class="text-xs text-gray-500 mb-2">Submenu items (drag links here or use “Nest under” on top-level links)</p>
                                        <div class="nav-menu-children min-h-[40px] space-y-2 pl-4 border-l-2 border-kg-200" :data-parent-key="item._key">
                                            <template x-for="(child, cIndex) in item.children" :key="child._key">
                                                <div class="nav-menu-child-item border border-gray-200 rounded-lg bg-white" :data-key="child._key">
                                                    <div class="flex items-center gap-2 p-2">
                                                        <span class="drag-handle cursor-grab text-gray-400 px-1">⠿</span>
                                                        <span class="flex-1 text-sm font-medium" x-text="child.label"></span>
                                                        <button type="button" @click="moveItem(item.children, cIndex, -1)" :disabled="cIndex === 0" class="text-xs text-gray-500">↑</button>
                                                        <button type="button" @click="moveItem(item.children, cIndex, 1)" :disabled="cIndex === item.children.length - 1" class="text-xs text-gray-500">↓</button>
                                                        <button type="button" @click="item.children.splice(cIndex, 1)" class="text-xs text-red-600">Remove</button>
                                                    </div>
                                                    <div class="px-2 pb-2 grid sm:grid-cols-2 gap-2">
                                                        <input type="text" x-model="child.label" class="rounded border-gray-300 text-sm" placeholder="Label">
                                                        <input type="text" x-model="child.url" class="rounded border-gray-300 text-sm" placeholder="Custom URL">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="item.type === 'link' || item.type === 'certification'" class="mt-1 flex justify-end">
                                    <label class="text-xs text-gray-500 flex items-center gap-2">
                                        Nest under:
                                        <select @change="nestUnder($event, index); $event.target.value = ''" class="rounded border-gray-300 text-xs py-1">
                                            <option value="">—</option>
                                            <template x-for="(dd, di) in items" :key="'nest-' + dd._key">
                                                <option x-show="dd.type === 'dropdown'" :value="di" x-text="dd.label"></option>
                                            </template>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        function navMenuBuilder() {
            return {
                items: (@json($menuTree)).map(normalizeItem),
                availablePages: @json($availablePages),
                selectedPages: [],
                customLink: { label: '', url: '' },
                dropdownLabel: 'Explore',
                saving: false,

                init() {
                    this.$nextTick(() => this.setupSortable());
                },

                setupSortable() {
                    const root = document.getElementById('nav-menu-root');
                    if (!root || typeof Sortable === 'undefined') return;

                    if (root._sortable) root._sortable.destroy();
                    root._sortable = new Sortable(root, {
                        group: { name: 'nav-root', pull: true, put: true },
                        animation: 150,
                        handle: '.drag-handle',
                        draggable: '.nav-menu-root-item',
                        onEnd: (evt) => this.onRootSort(evt),
                    });

                    root.querySelectorAll('.nav-menu-children').forEach(el => {
                        if (el._sortable) el._sortable.destroy();
                        el._sortable = new Sortable(el, {
                            group: { name: 'nav-children', pull: true, put: true },
                            animation: 150,
                            handle: '.drag-handle',
                            draggable: '.nav-menu-child-item',
                            onAdd: (evt) => this.onChildAdd(evt),
                            onEnd: (evt) => this.onChildSort(evt),
                        });
                    });
                },

                onRootSort(evt) {
                    const keys = [...evt.to.querySelectorAll(':scope > .nav-menu-root-item')].map(el => el.dataset.key);
                    this.items = keys.map(k => this.items.find(i => i._key === k)).filter(Boolean);
                },

                onChildSort(evt) {
                    const parentKey = evt.to.dataset.parentKey;
                    const parent = this.items.find(i => i._key === parentKey);
                    if (!parent) return;
                    const keys = [...evt.to.querySelectorAll(':scope > .nav-menu-child-item')].map(el => el.dataset.key);
                    parent.children = keys.map(k => parent.children.find(c => c._key === k) || this.findItemByKey(k)).filter(Boolean);
                },

                onChildAdd(evt) {
                    const parentKey = evt.to.dataset.parentKey;
                    const parent = this.items.find(i => i._key === parentKey);
                    if (!parent) return;

                    const draggedKey = evt.item.dataset.key;
                    let moved = this.extractItem(draggedKey);
                    if (!moved) return;

                    moved = normalizeItem({ ...moved, type: moved.type === 'dropdown' ? 'link' : moved.type });
                    if (!parent.children.some(c => c._key === moved._key)) {
                        parent.children.push(moved);
                    }
                    evt.item.remove();
                    this.$nextTick(() => this.setupSortable());
                },

                extractItem(key) {
                    for (let i = 0; i < this.items.length; i++) {
                        if (this.items[i]._key === key) {
                            return this.items.splice(i, 1)[0];
                        }
                        const ch = this.items[i].children || [];
                        for (let j = 0; j < ch.length; j++) {
                            if (ch[j]._key === key) {
                                return ch.splice(j, 1)[0];
                            }
                        }
                    }
                    return null;
                },

                findItemByKey(key) {
                    for (const item of this.items) {
                        if (item._key === key) return item;
                        const child = (item.children || []).find(c => c._key === key);
                        if (child) return child;
                    }
                    return null;
                },

                moveItem(list, index, dir) {
                    const next = index + dir;
                    if (next < 0 || next >= list.length) return;
                    const copy = [...list];
                    [copy[index], copy[next]] = [copy[next], copy[index]];
                    if (list === this.items) {
                        this.items = copy;
                    } else {
                        list.splice(0, list.length, ...copy);
                    }
                },

                nestUnder(event, fromIndex) {
                    const val = event.target.value;
                    if (val === '') return;
                    const dropdownIndex = parseInt(val, 10);
                    const dropdown = this.items[dropdownIndex];
                    if (!dropdown || dropdown.type !== 'dropdown') return;
                    const [moved] = this.items.splice(fromIndex, 1);
                    if (!moved || moved.type === 'dropdown') return;
                    dropdown.children.push(moved);
                },

                addSelectedPages() {
                    this.selectedPages.forEach(routeName => {
                        const page = this.availablePages.find(p => p.route_name === routeName);
                        if (!page || this.items.some(i => i.route_name === routeName)) return;
                        this.items.push(normalizeItem({
                            label: page.label,
                            type: page.type || 'link',
                            route_name: page.route_name,
                            active_key: page.active_key,
                            active_patterns: page.active_patterns,
                            url_hash: page.url_hash || null,
                            badge_label: page.badge_label || null,
                            title_attr: page.title_attr || null,
                            children: [],
                        }));
                    });
                    this.selectedPages = [];
                    this.$nextTick(() => this.setupSortable());
                },

                addCustomLink() {
                    if (!this.customLink.label || !this.customLink.url) {
                        Swal.fire({ icon: 'warning', title: 'Label and URL required' });
                        return;
                    }
                    this.items.push(normalizeItem({
                        label: this.customLink.label,
                        type: 'link',
                        url: this.customLink.url,
                        active_key: 'custom-' + Date.now(),
                        children: [],
                    }));
                    this.customLink = { label: '', url: '' };
                    this.$nextTick(() => this.setupSortable());
                },

                addDropdown() {
                    this.items.push(normalizeItem({
                        label: this.dropdownLabel || 'Dropdown',
                        type: 'dropdown',
                        active_key: (this.dropdownLabel || 'dropdown').toLowerCase().replace(/\s+/g, '-'),
                        children: [],
                    }));
                    this.$nextTick(() => this.setupSortable());
                },

                async saveMenu() {
                    this.saving = true;
                    try {
                        const res = await fetch(@json(route('dashboard.nav-menu.store')), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ items: this.items.map(stripInternal) }),
                        });
                        const data = await res.json();
                        if (!res.ok) {
                            const msg = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Save failed');
                            throw new Error(msg);
                        }
                        Swal.fire({ icon: 'success', title: 'Saved', text: data.message || 'Menu updated.' });
                    } catch (e) {
                        Swal.fire({ icon: 'error', title: 'Error', text: e.message });
                    } finally {
                        this.saving = false;
                    }
                },
            };
        }

        function normalizeItem(item) {
            return {
                ...item,
                _key: 'item-' + (item.id || Math.random().toString(36).slice(2, 11)),
                children: (item.children || []).map(normalizeItem),
            };
        }

        function stripInternal(item) {
            return {
                label: item.label,
                type: item.type,
                route_name: item.route_name || null,
                url: item.url || null,
                url_hash: item.url_hash || null,
                active_key: item.active_key || null,
                active_patterns: item.active_patterns || null,
                badge_label: item.badge_label || null,
                title_attr: item.title_attr || null,
                open_in_new_tab: Boolean(item.open_in_new_tab),
                children: (item.children || []).map(stripInternal),
            };
        }
    </script>
@endsection
