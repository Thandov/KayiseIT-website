<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('id_copy_path')->nullable()->after('profile_picture');
            $table->string('bank_confirmation_path')->nullable()->after('id_copy_path');
            $table->string('cv_path')->nullable()->after('bank_confirmation_path');
            $table->string('sars_income_tax_path')->nullable()->after('cv_path');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'id_copy_path',
                'bank_confirmation_path',
                'cv_path',
                'sars_income_tax_path',
            ]);
        });
    }
};
