<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('lmis_enabled')->default(false)->after('show_chatbot_floating');
            $table->string('lmis_base_url')->nullable()->after('lmis_enabled');
            $table->text('lmis_api_token')->nullable()->after('lmis_base_url');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['lmis_enabled', 'lmis_base_url', 'lmis_api_token']);
        });
    }
};
