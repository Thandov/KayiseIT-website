<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_title_permission_group', function (Blueprint $table) {
            $table->unsignedBigInteger('job_title_id');
            $table->unsignedBigInteger('permission_group_id');

            $table->foreign('job_title_id')
                ->references('id')
                ->on('job_titles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('permission_group_id')
                ->references('id')
                ->on('permission_groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->primary(['job_title_id', 'permission_group_id'], 'job_title_permission_group_primary');
        });

        if (Schema::hasColumn('job_titles', 'permission_group_id')) {
            $rows = DB::table('job_titles')
                ->whereNotNull('permission_group_id')
                ->get(['id', 'permission_group_id']);

            foreach ($rows as $row) {
                DB::table('job_title_permission_group')->insertOrIgnore([
                    'job_title_id' => $row->id,
                    'permission_group_id' => $row->permission_group_id,
                ]);
            }

            Schema::table('job_titles', function (Blueprint $table) {
                $table->dropConstrainedForeignId('permission_group_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('job_titles', function (Blueprint $table) {
            if (! Schema::hasColumn('job_titles', 'permission_group_id')) {
                $table->foreignId('permission_group_id')
                    ->nullable()
                    ->after('slug')
                    ->constrained('permission_groups')
                    ->nullOnDelete();
            }
        });

        if (Schema::hasTable('job_title_permission_group')) {
            $rows = DB::table('job_title_permission_group')
                ->orderBy('job_title_id')
                ->get()
                ->groupBy('job_title_id');

            foreach ($rows as $titleId => $pivots) {
                $first = $pivots->first();
                DB::table('job_titles')
                    ->where('id', $titleId)
                    ->update(['permission_group_id' => $first->permission_group_id]);
            }
        }

        Schema::dropIfExists('job_title_permission_group');
    }
};
