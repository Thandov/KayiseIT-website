<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('job_title')->nullable()->after('last_name');
            $table->unsignedInteger('manager_id')->nullable()->after('user_id');
            $table->unsignedInteger('sort_order')->default(0)->after('manager_id');

            $table->foreign('manager_id')
                ->references('id')
                ->on('employees')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn(['job_title', 'manager_id', 'sort_order']);
        });
    }
};
