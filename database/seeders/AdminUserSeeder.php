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
        // Create a user with the specified attributes
        $user = User::create([
            'name' => 'Thando',
            'email' => 'thando@kayiseit.co.za',
            'password' => Hash::make('thando@kayiseit.co.za'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Attach the role with ID 1 to the user using Laratrust's attachRole method
        $user->attachRole(1);
        // Create a user with the specified attributes
        $user = User::create([
            'name' => 'Thapelo Maluka',
            'email' => 'thapelo@kayiseit.com',
            'password' => Hash::make('thapelo@kayiseit.com'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Attach the role with ID 1 to the user using Laratrust's attachRole method
        $user->attachRole(1);
    }
}
