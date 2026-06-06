<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('id_number');
            $table->string('email');
            $table->string('cellphone');
            $table->string('country')->default('South Africa');
            $table->string('province');
            $table->enum('location_type', ['town', 'township']);
            $table->string('location_name');
            $table->foreignId('internship_program_id')->nullable()->constrained('internship_programs')->nullOnDelete();
            $table->string('source')->default('admin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
