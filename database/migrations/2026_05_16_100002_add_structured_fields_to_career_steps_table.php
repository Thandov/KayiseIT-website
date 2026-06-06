<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_steps', function (Blueprint $table) {
            $table->string('title')->nullable()->after('qualification');
            $table->text('summary')->nullable()->after('title');
            $table->unsignedTinyInteger('nqf_level')->nullable()->after('summary');
            $table->string('duration')->nullable()->after('nqf_level');
            $table->string('typical_cost')->nullable()->after('duration');
            $table->json('prerequisites')->nullable()->after('typical_cost');
            $table->json('providers')->nullable()->after('prerequisites');
            $table->string('next_action')->nullable()->after('providers');
        });
    }

    public function down(): void
    {
        Schema::table('career_steps', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'summary',
                'nqf_level',
                'duration',
                'typical_cost',
                'prerequisites',
                'providers',
                'next_action',
            ]);
        });
    }
};
