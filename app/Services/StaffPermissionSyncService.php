<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\PermissionGroup;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StaffPermissionSyncService
{
    /**
     * Sync Laratrust direct permissions for a user from their employee's job title groups.
     * Admins keep existing permissions untouched (full access via role).
     */
    public function syncUser(?User $user): void
    {
        if (! $user) {
            return;
        }

        if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
            return;
        }

        $employee = $user->employee;
        if (! $employee) {
            $this->syncPermissionNames($user, []);

            return;
        }

        $employee->loadMissing('assignedTitle.permissionGroups.permissions');
        $names = $employee->assignedTitle?->permissionGroups
            ?->flatMap(fn (PermissionGroup $group) => $group->permissions->pluck('name'))
            ->filter()
            ->unique()
            ->values()
            ->all() ?? [];

        $this->syncPermissionNames($user, $names);
    }

    public function syncEmployee(Employee $employee): void
    {
        $employee->loadMissing('user');
        $this->syncUser($employee->user);
    }

    public function syncGroup(PermissionGroup $group): void
    {
        $group->loadMissing('jobTitles.employees.user');

        foreach ($group->jobTitles as $title) {
            foreach ($title->employees as $employee) {
                $this->syncEmployee($employee);
            }
        }
    }

    public function syncJobTitle(JobTitle $title): void
    {
        $title->loadMissing('employees.user');

        foreach ($title->employees as $employee) {
            $this->syncEmployee($employee);
        }
    }

    /**
     * @param  list<string>  $names
     */
    private function syncPermissionNames(User $user, array $names): void
    {
        try {
            if (method_exists($user, 'syncPermissions')) {
                $user->syncPermissions($names);

                return;
            }
        } catch (\Throwable $e) {
            Log::warning('Staff permission sync failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
