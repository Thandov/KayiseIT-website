<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('occupations', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('occupation_banner');
            $table->string('quiz_tags')->nullable()->after('display_order');
            $table->json('school_subjects')->nullable()->after('quiz_tags');
        });
    }

    public function down(): void
    {
        Schema::table('occupations', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'quiz_tags', 'school_subjects']);
        });
    }
};
