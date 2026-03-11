<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Business;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin 1
        $user = User::create([
            'name' => 'Thando',
            'email' => 'thando@kayiseit.co.za',
            'password' => Hash::make('thando@kayiseit.co.za'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->attachRole(1);

        // Admin 2
        $user = User::create([
            'name' => 'Thapelo Maluka',
            'email' => 'thapelo@kayiseit.com',
            'password' => Hash::make('thapelo@kayiseit.com'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->attachRole(1);

        // Admin 3 (Mandla)
        $user = User::create([
            'name' => 'Mandla',
            'email' => 'mandla@kayiseit.co.za',
            'password' => Hash::make('Mandla@02'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->attachRole(1);
    }
}