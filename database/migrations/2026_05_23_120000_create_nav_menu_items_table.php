<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nav_menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('nav_menu_items')->cascadeOnDelete();
            $table->string('label');
            $table->string('type', 32)->default('link'); // link, dropdown, certification
            $table->string('route_name')->nullable();
            $table->string('url')->nullable();
            $table->string('url_hash', 64)->nullable();
            $table->string('active_key', 64)->nullable();
            $table->text('active_patterns')->nullable();
            $table->string('badge_label', 64)->nullable();
            $table->string('title_attr')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->boolean('open_in_new_tab')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nav_menu_items');
    }
};
