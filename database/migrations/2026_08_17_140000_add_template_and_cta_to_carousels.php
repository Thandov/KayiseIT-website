<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            if (! Schema::hasColumn('carousels', 'template')) {
                $table->string('template', 32)->default('classic')->after('image');
            }
            if (! Schema::hasColumn('carousels', 'link_type')) {
                $table->string('link_type', 32)->default('services')->after('template');
            }
            if (! Schema::hasColumn('carousels', 'blog_id')) {
                $table->unsignedBigInteger('blog_id')->nullable()->after('link_type');
            }
            if (! Schema::hasColumn('carousels', 'cta_url')) {
                $table->string('cta_url', 500)->nullable()->after('blog_id');
            }
            if (! Schema::hasColumn('carousels', 'cta_label')) {
                $table->string('cta_label', 80)->nullable()->after('cta_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            foreach (['cta_label', 'cta_url', 'blog_id', 'link_type', 'template'] as $column) {
                if (Schema::hasColumn('carousels', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
