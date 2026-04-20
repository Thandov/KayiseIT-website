<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('tier_key', 32);
            $table->string('label')->nullable();
            $table->string('pricing_mode', 32);
            $table->timestamps();
            $table->unique(['service_id', 'tier_key']);
        });

        Schema::create('service_tier_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_tier_id')->constrained('service_tiers')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });

        Schema::create('service_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_tier_id')->constrained('service_tiers')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_package_id')->constrained('service_packages')->cascadeOnDelete();
            $table->text('feature');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_tier_id')->constrained('service_tiers')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('pricing_type', 16)->default('fixed');
            $table->string('unit_label')->nullable();
            $table->unsignedInteger('min_qty')->nullable();
            $table->unsignedInteger('max_qty')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_tier_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_tier_id')->constrained('service_tiers')->cascadeOnDelete();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_subheading')->nullable();
            $table->longText('body')->nullable();
            $table->json('sections')->nullable();
            $table->string('primary_cta_label')->nullable();
            $table->string('primary_cta_href')->nullable();
            $table->timestamps();
            $table->unique('service_tier_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_tier_pages');
        Schema::dropIfExists('service_addons');
        Schema::dropIfExists('service_package_features');
        Schema::dropIfExists('service_packages');
        Schema::dropIfExists('service_tier_prices');
        Schema::dropIfExists('service_tiers');
    }
};
