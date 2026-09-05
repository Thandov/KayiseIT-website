<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Services\StaffPermissionSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user || ! $user->isDashboardAdmin()) {
                abort(403, 'Only admins can manage permission groups and titles.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $groups = PermissionGroup::query()
            ->withCount(['permissions', 'jobTitles'])
            ->orderBy('display_name')
            ->get();

        $titles = JobTitle::query()
            ->with('permissionGroups')
            ->withCount('employees')
            ->orderBy('name')
            ->get();

        $permissions = Permission::query()
            ->whereIn('name', $this->managedPermissionNames())
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Permission $p) => Str::before($p->name, '.'));

        $moduleLabels = [
            'clients' => 'Clients',
            'programs' => 'Programs',
            'settings' => 'Settings',
            'site-settings' => 'Site settings',
            'profile' => 'Profile',
        ];

        return view('admin.dashboard.access.index', compact('groups', 'titles', 'permissions', 'moduleLabels'));
    }

    public function storeGroup(Request $request, StaffPermissionSyncService $sync)
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $name = Str::slug($validated['display_name'], '_');
        $base = $name !== '' ? $name : 'group';
        $candidate = $base;
        $i = 1;
        while (PermissionGroup::where('name', $candidate)->exists()) {
            $candidate = $base.'_'.$i++;
        }

        $group = PermissionGroup::create([
            'name' => $candidate,
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
        ]);

        $permissionIds = Permission::whereIn('name', $validated['permissions'] ?? [])->pluck('id');
        $group->permissions()->sync($permissionIds);
        $sync->syncGroup($group->fresh());

        return redirect()
            ->route('dashboard.access', ['tab' => 'groups', 'group' => $group->id])
            ->with('success', 'Permission group created.');
    }

    public function updateGroup(Request $request, PermissionGroup $group, StaffPermissionSyncService $sync)
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $group->update([
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
        ]);

        $permissionIds = Permission::whereIn('name', $validated['permissions'] ?? [])->pluck('id');
        $group->permissions()->sync($permissionIds);
        $sync->syncGroup($group->fresh());

        return redirect()
            ->route('dashboard.access', ['tab' => 'groups', 'group' => $group->id])
            ->with('success', 'Permission group updated. Staff with titles in this group were re-synced.');
    }

    public function destroyGroup(PermissionGroup $group, StaffPermissionSyncService $sync)
    {
        $titles = $group->jobTitles()->with('employees.user')->get();
        $group->permissions()->detach();
        $group->delete();

        foreach ($titles as $title) {
            foreach ($title->employees as $employee) {
                $sync->syncEmployee($employee);
            }
        }

        return redirect()
            ->route('dashboard.access', ['tab' => 'groups'])
            ->with('success', 'Permission group deleted.');
    }

    public function storeTitle(Request $request, StaffPermissionSyncService $sync)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permission_group_ids' => 'nullable|array',
            'permission_group_ids.*' => 'integer|exists:permission_groups,id',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $this->uniqueTitleSlug($validated['name']);

        $title = JobTitle::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $title->permissionGroups()->sync($validated['permission_group_ids'] ?? []);
        $sync->syncJobTitle($title->fresh());

        return redirect()
            ->route('dashboard.access', ['tab' => 'titles'])
            ->with('success', 'Job title created.');
    }

    public function updateTitle(Request $request, JobTitle $title, StaffPermissionSyncService $sync)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permission_group_ids' => 'nullable|array',
            'permission_group_ids.*' => 'integer|exists:permission_groups,id',
            'is_active' => 'nullable|boolean',
        ]);

        $title->name = $validated['name'];
        if ($title->isDirty('name')) {
            $title->slug = $this->uniqueTitleSlug($validated['name'], $title->id);
        }
        $title->is_active = $request->boolean('is_active', true);
        $title->save();

        $title->permissionGroups()->sync($validated['permission_group_ids'] ?? []);
        $sync->syncJobTitle($title->fresh());

        return redirect()
            ->route('dashboard.access', ['tab' => 'titles'])
            ->with('success', 'Job title updated. Staff with this title were re-synced.');
    }

    public function destroyTitle(JobTitle $title, StaffPermissionSyncService $sync)
    {
        $employees = $title->employees()->with('user')->get();
        $title->permissionGroups()->detach();
        $title->delete();

        foreach ($employees as $employee) {
            $sync->syncEmployee($employee->fresh());
        }

        return redirect()
            ->route('dashboard.access', ['tab' => 'titles'])
            ->with('success', 'Job title deleted.');
    }

    /**
     * @return list<string>
     */
    private function managedPermissionNames(): array
    {
        return [
            'clients.read',
            'clients.create',
            'clients.update',
            'clients.delete',
            'clients.upload',
            'programs.create',
            'programs.read',
            'programs.update',
            'programs.delete',
            'programs.approve',
            'settings.own',
            'site-settings.manage',
            'profile.own',
        ];
    }

    private function uniqueTitleSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'title';
        $slug = $base;
        $i = 1;
        while (
            JobTitle::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
