<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Services\StaffPermissionSyncService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class JobTitleSeeder extends Seeder
{
    public function run(): void
    {
        $this->ensureLeadershipGroup();

        $path = database_path('data/job_titles.json');
        if (! File::exists($path)) {
            $this->command?->error('Missing database/data/job_titles.json');

            return;
        }

        $rows = json_decode(File::get($path), true);
        if (! is_array($rows)) {
            $this->command?->error('Invalid job_titles.json');

            return;
        }

        $groups = PermissionGroup::query()->pluck('id', 'name');

        foreach ($rows as $row) {
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }

            $slug = (string) ($row['slug'] ?? Str::slug($name));

            $title = JobTitle::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'is_active' => (bool) ($row['is_active'] ?? true),
                ]
            );

            $groupKeys = $row['permission_groups'] ?? [];
            if (isset($row['permission_group']) && ! in_array($row['permission_group'], $groupKeys, true)) {
                $groupKeys[] = $row['permission_group'];
            }

            $groupIds = collect($groupKeys)
                ->map(fn ($key) => $groups[$key] ?? null)
                ->filter()
                ->values()
                ->all();

            $title->permissionGroups()->sync($groupIds);
        }

        $this->linkExistingEmployees();
    }

    private function ensureLeadershipGroup(): void
    {
        $group = PermissionGroup::firstOrCreate(
            ['name' => 'leadership'],
            [
                'display_name' => 'Leadership',
                'description' => 'Leadership / ops with approval rights',
            ]
        );

        $names = [
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
            'profile.own',
        ];

        $ids = Permission::whereIn('name', $names)->pluck('id');
        if ($ids->isNotEmpty()) {
            $group->permissions()->sync($ids);
        }
    }

    private function linkExistingEmployees(): void
    {
        $titles = JobTitle::query()->get()->keyBy(fn (JobTitle $t) => Str::lower(trim($t->name)));
        $sync = app(StaffPermissionSyncService::class);

        Employee::query()->orderBy('id')->each(function (Employee $employee) use ($titles, $sync) {
            $raw = trim((string) $employee->job_title);
            if ($raw === '') {
                return;
            }

            $title = $titles->get(Str::lower($raw));
            if (! $title) {
                return;
            }

            $employee->job_title_id = $title->id;
            $employee->job_title = $title->name;
            $employee->save();
            $sync->syncEmployee($employee->fresh(['user', 'assignedTitle']));
        });
    }
}
