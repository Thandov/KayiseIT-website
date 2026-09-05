<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internship_applications', function (Blueprint $table) {
            if (! Schema::hasColumn('internship_applications', 'proof_of_payment_path')) {
                $table->string('proof_of_payment_path')->nullable()->after('qualification_copy_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('internship_applications', function (Blueprint $table) {
            if (Schema::hasColumn('internship_applications', 'proof_of_payment_path')) {
                $table->dropColumn('proof_of_payment_path');
            }
        });
    }
};
