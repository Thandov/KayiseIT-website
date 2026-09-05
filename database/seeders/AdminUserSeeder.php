<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        if (! $adminRole) {
            $this->command?->warn('Admin role not found. Skipping AdminUserSeeder role assignment.');
            return;
        }

        // Admin 1
        $user = User::firstOrCreate(
            ['email' => 'thando@kayiseit.co.za'],
            [
                'name' => 'Thando',
                'password' => Hash::make('thando@kayiseit.co.za'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->attachRole($adminRole->name);

        // Admin 2
        $user = User::firstOrCreate(
            ['email' => 'thapelo@kayiseit.com'],
            [
                'name' => 'Thapelo Maluka',
                'password' => Hash::make('thapelo@kayiseit.com'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->attachRole($adminRole->name);

        // Admin 3 (Mandla)
        $user = User::firstOrCreate(
            ['email' => 'mandla@kayiseit.co.za'],
            [
                'name' => 'Mandla',
                'password' => Hash::make('Mandla@02'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->attachRole($adminRole->name);

        // Admin 4 (Fana)
        $user = User::firstOrCreate(
            ['email' => 'fana@kayiseit.com'],
            [
                'name' => 'Fana',
                'password' => Hash::make('F@n@'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->attachRole($adminRole->name);
    }
}
