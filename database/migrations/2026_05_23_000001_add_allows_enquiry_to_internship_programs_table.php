<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->boolean('allows_enquiry')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->dropColumn('allows_enquiry');
        });
    }
};
