<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('permission_group_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_group_id');
            $table->unsignedBigInteger('permission_id');

            $table->foreign('permission_group_id')
                ->references('id')
                ->on('permission_groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->primary(['permission_group_id', 'permission_id'], 'permission_group_permission_primary');
        });

        Schema::create('job_titles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('permission_group_id')
                ->nullable()
                ->constrained('permission_groups')
                ->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('employees', function (Blueprint $table) {
            if (! Schema::hasColumn('employees', 'job_title_id')) {
                $table->foreignId('job_title_id')
                    ->nullable()
                    ->after('job_title')
                    ->constrained('job_titles')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'job_title_id')) {
                $table->dropConstrainedForeignId('job_title_id');
            }
        });

        Schema::dropIfExists('job_titles');
        Schema::dropIfExists('permission_group_permission');
        Schema::dropIfExists('permission_groups');
    }
};
