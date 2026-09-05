<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            if (! Schema::hasColumn('internship_programs', 'application_form_schema')) {
                $table->json('application_form_schema')->nullable()->after('allows_enquiry');
            }
        });

        if (Schema::hasTable('people') && ! Schema::hasColumn('people', 'custom_fields')) {
            Schema::table('people', function (Blueprint $table) {
                $table->json('custom_fields')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            if (Schema::hasColumn('internship_programs', 'application_form_schema')) {
                $table->dropColumn('application_form_schema');
            }
        });

        if (Schema::hasTable('people') && Schema::hasColumn('people', 'custom_fields')) {
            Schema::table('people', function (Blueprint $table) {
                $table->dropColumn('custom_fields');
            });
        }
    }
};
