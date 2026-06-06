<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_step_module', function (Blueprint $table) {
            $table->unsignedInteger('steps_id');
            $table->unsignedBigInteger('module_id');
            $table->primary(['steps_id', 'module_id']);

            $table->foreign('steps_id')
                ->references('steps_id')
                ->on('career_steps')
                ->onDelete('cascade');

            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_step_module');
    }
};
