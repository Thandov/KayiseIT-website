<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('nqf_level')->nullable();
            $table->unsignedSmallInteger('duration_months')->nullable();
            $table->text('description')->nullable();
            $table->string('registration_url')->nullable();
            $table->enum('accreditation_body', ['QCTO', 'MICT_SETA', 'NONE'])->default('NONE');
            $table->enum('accreditation_status', ['accredited', 'pending', 'not_accredited'])->default('not_accredited');
            $table->string('accreditation_number')->nullable();
            $table->date('accreditation_expires_at')->nullable();
            $table->boolean('is_registration_open')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
