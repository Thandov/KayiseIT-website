<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usina_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('id_number');
            $table->string('contact');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('unemployed')->nullable();
            $table->boolean('youth')->nullable();
            $table->string('highest_qualification')->nullable();
            $table->boolean('own_business')->nullable();
            $table->string('id_upload_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usina_registrations');
    }
};


