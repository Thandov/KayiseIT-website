<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fold leads.* and customers.* into a single clients.* permission set.
     */
    public function up(): void
    {
        if (! Schema::hasTable('permissions')) {
            return;
        }

        $now = now();
        $canonical = [
            'clients.read' => ['View clients', 'View client records and inbound inquiries'],
            'clients.create' => ['Create clients', 'Create client records'],
            'clients.update' => ['Update clients', 'Edit client records'],
            'clients.delete' => ['Delete clients', 'Delete client records'],
            'clients.upload' => ['Import clients', 'Import client / inquiry lists'],
        ];

        foreach ($canonical as $name => [$display, $description]) {
            $existing = DB::table('permissions')->where('name', $name)->first();
            if ($existing) {
                DB::table('permissions')->where('id', $existing->id)->update([
                    'display_name' => $display,
                    'description' => $description,
                    'updated_at' => $now,
                ]);
            } else {
                DB::table('permissions')->insert([
                    'name' => $name,
                    'display_name' => $display,
                    'description' => $description,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $ids = DB::table('permissions')->whereIn('name', array_keys($canonical))->pluck('id', 'name');

        $this->repoint('customers.read', $ids['clients.read'] ?? null);
        $this->repoint('leads.read', $ids['clients.read'] ?? null);
        $this->repoint('customers.create', $ids['clients.create'] ?? null);
        $this->repoint('customers.update', $ids['clients.update'] ?? null);
        $this->repoint('customers.delete', $ids['clients.delete'] ?? null);
        $this->repoint('leads.upload', $ids['clients.upload'] ?? null);

        DB::table('permissions')->whereIn('name', [
            'leads.read',
            'leads.upload',
            'customers.create',
            'customers.read',
            'customers.update',
            'customers.delete',
        ])->delete();

        if (Schema::hasTable('permission_groups')) {
            DB::table('permission_groups')
                ->where('name', 'sales')
                ->update([
                    'description' => 'Clients and inquiries',
                    'updated_at' => $now,
                ]);
        }
    }

    public function down(): void
    {
        // One-way merge; old split names are not restored.
    }

    private function repoint(string $oldName, ?int $newId): void
    {
        if (! $newId) {
            return;
        }

        $old = DB::table('permissions')->where('name', $oldName)->first();
        if (! $old || (int) $old->id === $newId) {
            return;
        }

        $oldId = (int) $old->id;

        if (Schema::hasTable('permission_user')) {
            $rows = DB::table('permission_user')->where('permission_id', $oldId)->get();
            foreach ($rows as $row) {
                $exists = DB::table('permission_user')
                    ->where('user_id', $row->user_id)
                    ->where('permission_id', $newId)
                    ->where('user_type', $row->user_type)
                    ->exists();
                if (! $exists) {
                    DB::table('permission_user')->insert([
                        'permission_id' => $newId,
                        'user_id' => $row->user_id,
                        'user_type' => $row->user_type,
                    ]);
                }
            }
            DB::table('permission_user')->where('permission_id', $oldId)->delete();
        }

        if (Schema::hasTable('permission_role')) {
            $rows = DB::table('permission_role')->where('permission_id', $oldId)->get();
            foreach ($rows as $row) {
                $exists = DB::table('permission_role')
                    ->where('role_id', $row->role_id)
                    ->where('permission_id', $newId)
                    ->exists();
                if (! $exists) {
                    DB::table('permission_role')->insert([
                        'permission_id' => $newId,
                        'role_id' => $row->role_id,
                    ]);
                }
            }
            DB::table('permission_role')->where('permission_id', $oldId)->delete();
        }

        if (Schema::hasTable('permission_group_permission')) {
            $rows = DB::table('permission_group_permission')->where('permission_id', $oldId)->get();
            foreach ($rows as $row) {
                $exists = DB::table('permission_group_permission')
                    ->where('permission_group_id', $row->permission_group_id)
                    ->where('permission_id', $newId)
                    ->exists();
                if (! $exists) {
                    DB::table('permission_group_permission')->insert([
                        'permission_group_id' => $row->permission_group_id,
                        'permission_id' => $newId,
                    ]);
                }
            }
            DB::table('permission_group_permission')->where('permission_id', $oldId)->delete();
        }
    }
};
