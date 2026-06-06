<?php

namespace App\Services;

use App\Models\NavMenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NavMenuService
{
    /**
     * Public pages that can be added to the menu from the admin builder.
     *
     * @return array<int, array<string, mixed>>
     */
    public function availablePages(): array
    {
        $pages = [
            ['route_name' => 'home', 'label' => 'Home', 'active_key' => 'home', 'active_patterns' => 'home', 'url_hash' => '#starfield'],
            ['route_name' => 'about', 'label' => 'About', 'active_key' => 'about', 'active_patterns' => 'about'],
            ['route_name' => 'programs', 'label' => 'Programs', 'active_key' => 'programs', 'active_patterns' => 'programs'],
            ['route_name' => 'opportunities', 'label' => 'Opportunities', 'active_key' => 'opportunities', 'active_patterns' => 'opportunities'],
            ['route_name' => 'training-skills', 'label' => 'Training & Skills', 'active_key' => 'training-skills', 'active_patterns' => 'training-skills'],
            ['route_name' => 'career-mapping', 'label' => 'Career Mapping', 'active_key' => 'career-mapping', 'active_patterns' => 'career-mapping,careers.show,viewoccupations'],
            ['route_name' => 'certification.form', 'label' => 'Certification', 'active_key' => 'certification', 'active_patterns' => 'certification.*', 'type' => 'certification', 'badge_label' => 'Urgent', 'title_attr' => 'UNISA Enterprise & NYDA — download your certificate'],
            ['route_name' => 'gallery', 'label' => 'Gallery', 'active_key' => 'gallery', 'active_patterns' => 'gallery'],
            ['route_name' => 'contact', 'label' => 'Contact', 'active_key' => 'contact', 'active_patterns' => 'contact'],
            ['route_name' => 'services', 'label' => 'Services', 'active_key' => 'services', 'active_patterns' => 'services,services.*'],
            ['route_name' => 'announcements', 'label' => 'Announcements', 'active_key' => 'announcements', 'active_patterns' => 'announcements'],
            ['route_name' => 'internship', 'label' => 'Internship', 'active_key' => 'internship', 'active_patterns' => 'internship'],
            ['route_name' => 'terms', 'label' => 'Terms', 'active_key' => 'terms', 'active_patterns' => 'terms'],
        ];

        return array_values(array_filter($pages, function (array $page) {
            if (! empty($page['route_name']) && ! Route::has($page['route_name'])) {
                return false;
            }

            return true;
        }));
    }

    public function ensureDefaults(): void
    {
        if (! Schema::hasTable('nav_menu_items')) {
            return;
        }

        if (NavMenuItem::query()->exists()) {
            return;
        }

        $this->saveTree($this->defaultTree());
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function defaultTree(): array
    {
        $tree = [
            [
                'label' => __('Home'),
                'type' => 'link',
                'route_name' => 'home',
                'url_hash' => '#starfield',
                'active_key' => 'home',
                'active_patterns' => 'home',
                'children' => [],
            ],
            [
                'label' => __('About'),
                'type' => 'link',
                'route_name' => 'about',
                'active_key' => 'about',
                'active_patterns' => 'about',
                'children' => [],
            ],
            [
                'label' => __('Explore'),
                'type' => 'dropdown',
                'active_key' => 'explore',
                'active_patterns' => 'programs,opportunities,training-skills,career-mapping,careers.show,viewoccupations',
                'children' => [
                    [
                        'label' => __('Programs'),
                        'type' => 'link',
                        'route_name' => 'programs',
                        'active_key' => 'programs',
                        'active_patterns' => 'programs',
                        'children' => [],
                    ],
                    [
                        'label' => __('Opportunities'),
                        'type' => 'link',
                        'route_name' => 'opportunities',
                        'active_key' => 'opportunities',
                        'active_patterns' => 'opportunities',
                        'children' => [],
                    ],
                    [
                        'label' => __('Training & Skills'),
                        'type' => 'link',
                        'route_name' => 'training-skills',
                        'active_key' => 'training-skills',
                        'active_patterns' => 'training-skills',
                        'children' => [],
                    ],
                    [
                        'label' => __('Career Mapping'),
                        'type' => 'link',
                        'route_name' => 'career-mapping',
                        'active_key' => 'career-mapping',
                        'active_patterns' => 'career-mapping,careers.show,viewoccupations',
                        'children' => [],
                    ],
                ],
            ],
            [
                'label' => __('Certification'),
                'type' => 'certification',
                'route_name' => 'certification.form',
                'active_key' => 'certification',
                'active_patterns' => 'certification.*',
                'badge_label' => __('Urgent'),
                'title_attr' => __('UNISA Enterprise & NYDA — download your certificate'),
                'children' => [],
            ],
            [
                'label' => __('Gallery'),
                'type' => 'link',
                'route_name' => 'gallery',
                'active_key' => 'gallery',
                'active_patterns' => 'gallery',
                'children' => [],
            ],
            [
                'label' => __('Contact'),
                'type' => 'link',
                'route_name' => 'contact',
                'active_key' => 'contact',
                'active_patterns' => 'contact',
                'children' => [],
            ],
        ];

        return array_values(array_filter($tree, function (array $item) {
            if ($item['type'] === 'certification' && ! empty($item['route_name']) && ! Route::has($item['route_name'])) {
                return false;
            }

            return true;
        }));
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAdminTree(): array
    {
        $this->ensureDefaults();

        $items = NavMenuItem::query()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->with(['children' => fn ($q) => $q->orderBy('sort_order')])
            ->get();

        return $items->map(fn (NavMenuItem $item) => $this->itemToAdminArray($item))->values()->all();
    }

    /**
     * @param  array<int, array<string, mixed>>  $tree
     */
    public function saveTree(array $tree): void
    {
        NavMenuItem::query()->delete();

        foreach ($tree as $index => $node) {
            $this->createFromNode($node, null, $index);
        }
    }

    /**
     * Build menu payload for the Vue navbar.
     *
     * @return array{menuItems: array<int, array<string, mixed>>, activeRoutes: array<string, bool>, hasCertification: bool}
     */
    public function buildFrontendConfig(Request $request): array
    {
        if (! Schema::hasTable('nav_menu_items')) {
            return $this->buildFallbackFrontendConfig($request);
        }

        $this->ensureDefaults();

        $roots = NavMenuItem::query()
            ->whereNull('parent_id')
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->with(['children' => fn ($q) => $q->where('is_visible', true)->orderBy('sort_order')])
            ->get();

        $activeRoutes = [];
        $menuItems = [];
        $hasCertification = false;

        foreach ($roots as $item) {
            $built = $this->buildFrontendItem($item, $request, $activeRoutes);
            if ($built === null) {
                continue;
            }
            if ($built['type'] === 'certification') {
                $hasCertification = true;
            }
            $menuItems[] = $built;
        }

        if ($menuItems === []) {
            return $this->buildFallbackFrontendConfig($request);
        }

        return [
            'menuItems' => $menuItems,
            'activeRoutes' => $activeRoutes,
            'hasCertification' => $hasCertification,
        ];
    }

    /**
     * @return array{menuItems: array<int, array<string, mixed>>, activeRoutes: array<string, bool>, hasCertification: bool}
     */
    private function buildFallbackFrontendConfig(Request $request): array
    {
        $activeRoutes = [];
        $menuItems = [];
        $hasCertification = false;

        foreach ($this->defaultTree() as $node) {
            $built = $this->buildFallbackNode($node, $request, $activeRoutes);
            if ($built !== null) {
                if ($built['type'] === 'certification') {
                    $hasCertification = true;
                }
                $menuItems[] = $built;
            }
        }

        return [
            'menuItems' => $menuItems,
            'activeRoutes' => $activeRoutes,
            'hasCertification' => $hasCertification,
        ];
    }

    /**
     * @param  array<string, mixed>  $node
     * @return array<string, mixed>|null
     */
    private function buildFallbackNode(array $node, Request $request, array &$activeRoutes): ?array
    {
        $activeKey = $node['active_key'] ?? Str::slug($node['label'] ?? 'item');
        $patterns = $node['active_patterns'] ?? '';
        $activeRoutes[$activeKey] = $this->matchesActivePatterns($request, $patterns);

        if (($node['type'] ?? 'link') === 'dropdown') {
            $children = [];
            foreach ($node['children'] ?? [] as $child) {
                $built = $this->buildFallbackNode($child, $request, $activeRoutes);
                if ($built !== null) {
                    $children[] = $built;
                }
            }
            if ($children === []) {
                return null;
            }
            if (! $activeRoutes[$activeKey]) {
                foreach ($children as $child) {
                    if (! empty($activeRoutes[$child['activeKey'] ?? ''])) {
                        $activeRoutes[$activeKey] = true;
                        break;
                    }
                }
            }

            return [
                'type' => 'dropdown',
                'label' => $node['label'],
                'activeKey' => $activeKey,
                'children' => $children,
            ];
        }

        $href = null;
        if (! empty($node['url'])) {
            $href = $node['url'] . ($node['url_hash'] ?? '');
        } elseif (! empty($node['route_name']) && Route::has($node['route_name'])) {
            $href = route($node['route_name']) . ($node['url_hash'] ?? '');
        }

        if ($href === null) {
            return null;
        }

        $payload = [
            'type' => $node['type'] ?? 'link',
            'label' => $node['label'],
            'href' => $href,
            'activeKey' => $activeKey,
            'openInNewTab' => false,
        ];

        if ($payload['type'] === 'certification') {
            $payload['badge'] = $node['badge_label'] ?? null;
            $payload['title'] = $node['title_attr'] ?? null;
        }

        return $payload;
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function createFromNode(array $node, ?int $parentId, int $sortOrder): void
    {
        $type = $node['type'] ?? 'link';
        if ($type === 'certification' && ! empty($node['route_name']) && ! Route::has($node['route_name'])) {
            return;
        }

        $item = NavMenuItem::query()->create([
            'parent_id' => $parentId,
            'label' => $node['label'] ?? 'Menu item',
            'type' => $type,
            'route_name' => $node['route_name'] ?? null,
            'url' => $node['url'] ?? null,
            'url_hash' => $node['url_hash'] ?? null,
            'active_key' => $node['active_key'] ?? null,
            'active_patterns' => $node['active_patterns'] ?? null,
            'badge_label' => $node['badge_label'] ?? null,
            'title_attr' => $node['title_attr'] ?? null,
            'sort_order' => $sortOrder,
            'is_visible' => $node['is_visible'] ?? true,
            'open_in_new_tab' => (bool) ($node['open_in_new_tab'] ?? false),
        ]);

        $children = $node['children'] ?? [];
        foreach ($children as $childIndex => $child) {
            $this->createFromNode($child, $item->id, $childIndex);
        }
    }

    /**
     * @return array<string, mixed>|null
     */
    private function buildFrontendItem(NavMenuItem $item, Request $request, array &$activeRoutes): ?array
    {
        $activeKey = $item->active_key ?? Str::slug($item->label);
        $isActive = $this->matchesActivePatterns($request, $item->active_patterns);
        $activeRoutes[$activeKey] = $isActive;

        if ($item->type === 'dropdown') {
            $children = [];
            foreach ($item->children as $child) {
                $childBuilt = $this->buildFrontendItem($child, $request, $activeRoutes);
                if ($childBuilt !== null) {
                    $children[] = $childBuilt;
                }
            }

            if ($children === []) {
                return null;
            }

            if (! $isActive) {
                foreach ($children as $child) {
                    if (! empty($activeRoutes[$child['activeKey'] ?? ''])) {
                        $activeRoutes[$activeKey] = true;
                        break;
                    }
                }
            }

            return [
                'type' => 'dropdown',
                'label' => $item->label,
                'activeKey' => $activeKey,
                'children' => $children,
            ];
        }

        $href = $this->resolveHref($item);
        if ($href === null && $item->type !== 'dropdown') {
            return null;
        }

        $payload = [
            'type' => $item->type,
            'label' => $item->label,
            'href' => $href,
            'activeKey' => $activeKey,
            'openInNewTab' => $item->open_in_new_tab,
        ];

        if ($item->type === 'certification') {
            $payload['badge'] = $item->badge_label;
            $payload['title'] = $item->title_attr;
        }

        return $payload;
    }

    private function resolveHref(NavMenuItem $item): ?string
    {
        if (! empty($item->url)) {
            $url = $item->url;
            if (! empty($item->url_hash)) {
                $url .= $item->url_hash;
            }

            return $url;
        }

        if (! empty($item->route_name) && Route::has($item->route_name)) {
            $url = route($item->route_name);
            if (! empty($item->url_hash)) {
                $url .= $item->url_hash;
            }

            return $url;
        }

        return null;
    }

    private function matchesActivePatterns(Request $request, ?string $patterns): bool
    {
        if ($patterns === null || $patterns === '') {
            return false;
        }

        foreach (explode(',', $patterns) as $pattern) {
            $pattern = trim($pattern);
            if ($pattern !== '' && $request->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<string, mixed>
     */
    private function itemToAdminArray(NavMenuItem $item): array
    {
        return [
            'id' => $item->id,
            'label' => $item->label,
            'type' => $item->type,
            'route_name' => $item->route_name,
            'url' => $item->url,
            'url_hash' => $item->url_hash,
            'active_key' => $item->active_key,
            'active_patterns' => $item->active_patterns,
            'badge_label' => $item->badge_label,
            'title_attr' => $item->title_attr,
            'open_in_new_tab' => $item->open_in_new_tab,
            'href_preview' => $this->resolveHref($item),
            'children' => $item->children->map(fn (NavMenuItem $child) => $this->itemToAdminArray($child))->values()->all(),
        ];
    }
}
