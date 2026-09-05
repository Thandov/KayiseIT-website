<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['published', 'in_progress'])->default('in_progress');
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('gitlab_url')->nullable();
            $table->string('bitbucket_url')->nullable();
            $table->string('other_platform_label')->nullable();
            $table->string('other_platform_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_projects');
    }
};
