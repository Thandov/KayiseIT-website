<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $exists = DB::table('roles')->where('name', 'student')->exists();
        if (!$exists) {
            DB::table('roles')->insert([
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Student portal user - enrolled in training programs',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleId = DB::table('roles')->where('name', 'student')->value('id');
        if ($roleId) {
            DB::table('role_user')->where('role_id', $roleId)->delete();
            DB::table('roles')->where('name', 'student')->delete();
        }
    }
};
