<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('occupations', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('occupation_name');
            $table->text('description')->nullable()->after('slug');
            $table->string('day_in_life')->nullable()->after('description');
            $table->unsignedInteger('entry_salary_min')->nullable()->after('day_in_life');
            $table->unsignedInteger('entry_salary_max')->nullable()->after('entry_salary_min');
            $table->boolean('is_published')->default(true)->after('entry_salary_max');
            $table->unsignedInteger('display_order')->default(0)->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::table('occupations', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'description',
                'day_in_life',
                'entry_salary_min',
                'entry_salary_max',
                'is_published',
                'display_order',
            ]);
        });
    }
};
