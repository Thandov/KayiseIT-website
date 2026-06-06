<?php

namespace App\Http\Controllers;

use App\Services\NavMenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavMenuController extends Controller
{
    public function __construct(private NavMenuService $navMenu)
    {
    }

    public function index(): View
    {
        $pageTitle = 'Navigation Menu';
        $menuTree = $this->navMenu->getAdminTree();
        $availablePages = $this->navMenu->availablePages();

        return view('admin.dashboard.nav-menu.index', compact('pageTitle', 'menuTree', 'availablePages'));
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.label' => ['required', 'string', 'max:120'],
            'items.*.type' => ['required', 'in:link,dropdown,certification'],
            'items.*.route_name' => ['nullable', 'string', 'max:120'],
            'items.*.url' => ['nullable', 'string', 'max:500'],
            'items.*.url_hash' => ['nullable', 'string', 'max:64'],
            'items.*.active_key' => ['nullable', 'string', 'max:64'],
            'items.*.active_patterns' => ['nullable', 'string', 'max:255'],
            'items.*.badge_label' => ['nullable', 'string', 'max:64'],
            'items.*.title_attr' => ['nullable', 'string', 'max:255'],
            'items.*.open_in_new_tab' => ['sometimes', 'boolean'],
            'items.*.children' => ['sometimes', 'array'],
            'items.*.children.*.label' => ['required_with:items.*.children', 'string', 'max:120'],
            'items.*.children.*.type' => ['required_with:items.*.children', 'in:link,dropdown,certification'],
            'items.*.children.*.route_name' => ['nullable', 'string', 'max:120'],
            'items.*.children.*.url' => ['nullable', 'string', 'max:500'],
            'items.*.children.*.url_hash' => ['nullable', 'string', 'max:64'],
            'items.*.children.*.active_key' => ['nullable', 'string', 'max:64'],
            'items.*.children.*.active_patterns' => ['nullable', 'string', 'max:255'],
            'items.*.children.*.badge_label' => ['nullable', 'string', 'max:64'],
            'items.*.children.*.title_attr' => ['nullable', 'string', 'max:255'],
            'items.*.children.*.open_in_new_tab' => ['sometimes', 'boolean'],
        ]);

        $tree = $this->filterTree($validated['items']);
        $this->navMenu->saveTree($tree);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Navigation menu saved.']);
        }

        return redirect()->route('dashboard.nav-menu')->with('success', 'Navigation menu saved.');
    }

    public function reset(): RedirectResponse
    {
        $this->navMenu->saveTree($this->navMenu->defaultTree());

        return redirect()->route('dashboard.nav-menu')->with('success', 'Navigation menu reset to defaults.');
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, array<string, mixed>>
     */
    private function filterTree(array $items): array
    {
        $filtered = [];

        foreach ($items as $item) {
            $type = $item['type'] ?? 'link';

            if ($type === 'certification' && ! empty($item['route_name']) && ! \Illuminate\Support\Facades\Route::has($item['route_name'])) {
                continue;
            }

            $children = [];
            if (! empty($item['children']) && is_array($item['children'])) {
                $children = $this->filterTree($item['children']);
            }

            if ($type === 'link' || $type === 'certification') {
                $hasRoute = ! empty($item['route_name']);
                $hasUrl = ! empty($item['url']);
                if (! $hasRoute && ! $hasUrl) {
                    continue;
                }
            }

            if ($type === 'dropdown' && $children === []) {
                continue;
            }

            $item['children'] = $children;
            $filtered[] = $item;
        }

        return $filtered;
    }
}
