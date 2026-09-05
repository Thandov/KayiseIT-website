<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StaffPermissionSeeder extends Seeder
{
    /**
     * @var array<string, array{display_name: string, description: string}>
     */
    private array $permissions = [
        'clients.read' => [
            'display_name' => 'View clients',
            'description' => 'View client records and inbound inquiries',
        ],
        'clients.create' => [
            'display_name' => 'Create clients',
            'description' => 'Create client records',
        ],
        'clients.update' => [
            'display_name' => 'Update clients',
            'description' => 'Edit client records',
        ],
        'clients.delete' => [
            'display_name' => 'Delete clients',
            'description' => 'Delete client records',
        ],
        'clients.upload' => [
            'display_name' => 'Import clients',
            'description' => 'Import client / inquiry lists',
        ],
        'programs.create' => [
            'display_name' => 'Create programs',
            'description' => 'Create internship / training programs (draft until approved)',
        ],
        'programs.read' => [
            'display_name' => 'View programs',
            'description' => 'View programs in the dashboard',
        ],
        'programs.update' => [
            'display_name' => 'Update programs',
            'description' => 'Edit program details (not publish)',
        ],
        'programs.delete' => [
            'display_name' => 'Delete programs',
            'description' => 'Delete programs',
        ],
        'programs.approve' => [
            'display_name' => 'Approve programs',
            'description' => 'Publish programs for public display',
        ],
        'settings.own' => [
            'display_name' => 'Own settings',
            'description' => 'Edit personal dashboard settings',
        ],
        'site-settings.manage' => [
            'display_name' => 'Site settings',
            'description' => 'Manage website / LMIS settings',
        ],
        'profile.own' => [
            'display_name' => 'Own profile',
            'description' => 'View and edit own staff profile',
        ],
    ];

    public function run(): void
    {
        foreach ($this->permissions as $name => $meta) {
            Permission::updateOrCreate(
                ['name' => $name],
                [
                    'display_name' => $meta['display_name'],
                    'description' => $meta['description'],
                ]
            );
        }

        Permission::whereIn('name', [
            'leads.read',
            'leads.upload',
            'customers.create',
            'customers.read',
            'customers.update',
            'customers.delete',
        ])->delete();

        $sales = PermissionGroup::updateOrCreate(
            ['name' => 'sales'],
            [
                'display_name' => 'Sales',
                'description' => 'Clients and inquiries',
            ]
        );
        $sales->permissions()->sync(
            Permission::whereIn('name', [
                'clients.read',
                'clients.create',
                'clients.update',
                'clients.delete',
                'clients.upload',
                'profile.own',
                'settings.own',
            ])->pluck('id')
        );

        $programmes = PermissionGroup::firstOrCreate(
            ['name' => 'programme_officer'],
            [
                'display_name' => 'Programme officer',
                'description' => 'Draft and manage programmes pending approval',
            ]
        );
        $programmes->permissions()->sync(
            Permission::whereIn('name', [
                'programs.create',
                'programs.read',
                'programs.update',
                'profile.own',
                'settings.own',
            ])->pluck('id')
        );

        // Ensure slug uniqueness helper available for titles created later in UI.
        unset($sales, $programmes, $name);
        Str::slug('noop');
    }
}
