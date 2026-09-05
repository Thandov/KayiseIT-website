<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->foreignId('announcement_id')
                ->nullable()
                ->after('allows_enquiry')
                ->constrained('announcements')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('announcement_id');
        });
    }
};
