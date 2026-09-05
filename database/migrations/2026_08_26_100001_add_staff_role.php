<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('roles')) {
            return;
        }

        $exists = DB::table('roles')->where('name', 'staff')->exists();
        if ($exists) {
            return;
        }

        DB::table('roles')->insert([
            'name' => 'staff',
            'display_name' => 'Staff',
            'description' => 'Internal staff member with tailored dashboard access',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('roles')) {
            return;
        }

        $roleId = DB::table('roles')->where('name', 'staff')->value('id');
        if (! $roleId) {
            return;
        }

        if (Schema::hasTable('role_user')) {
            DB::table('role_user')->where('role_id', $roleId)->delete();
        }

        DB::table('roles')->where('id', $roleId)->delete();
    }
};
